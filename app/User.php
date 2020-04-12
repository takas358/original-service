<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sex', 'age', 'address', 'job', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function enquetes()
    {
        return $this->hasMany(Enquete::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Enquete::class, 'favorites','user_id','enquete_id')->withTimestamps();
    }
    
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
    
    public function is_favorite($enquete_id){
        return $this->favorites()->where('enquete_id',$enquete_id)->exists();
    }
}
