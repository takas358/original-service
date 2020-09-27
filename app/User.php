<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //一括で保存可能なカラム
    protected $fillable = [
        'name', 'sex', 'age', 'address', 'job', 'email', 'password',
    ];

    //非表示にする必要があるカラム
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //多重度の定義（ユーザー：アンケート＝1：多）
    public function enquetes()
    {
        return $this->hasMany(Enquete::class);
    }

    //多重度の定義（ユーザー：回答＝1：多）
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    //多重度の定義（ユーザー：アンケート＝多：多）
    public function favorites()
    {
        return $this->belongsToMany(Enquete::class, 'favorites','user_id','enquete_id')->withTimestamps();
    }
    
    //お気に入り登録
    public function favorite($enquete_id)
    {
        //すでにお気に入り登録しているかの確認
        $exist = $this->is_favorite($enquete_id);
        
        if($exist){
            //すでにお気に入り登録していれば何もしない
            return false;
        }else{
            //お気に入り登録がまだなら登録する
            $this->favorites()->attach($enquete_id);
            return true;
        }
    }
    
    //お気に入り解除
    public function unfavorite($enquete_id)
    {
        //すでにお気に入り登録しているかの確認
        $exist = $this->is_favorite($enquete_id);
        
        if($exist){
            //すでにお気に入り登録しているなら登録を外す
            $this->favorites()->detach($enquete_id);
            return true;
        }else{
            //未フォローであれば何もしない
            return false;
        }
    }
    
    //すでにお気に入り登録しているかの確認
    public function is_favorite($enquete_id){
        return $this->favorites()->where('enquete_id',$enquete_id)->exists();
    }
}
