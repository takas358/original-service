<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    //一括で保存可能なカラム
    protected $fillable=['title','question1','question2','question3','user_id'];
    
    //アンケートはユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //多重度の定義（アンケート：選択肢＝1：多）
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    //多重度の定義（アンケート：回答＝1：多）
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    //多重度の定義（アンケート：ユーザー＝多：多）
    public function favorite_users(){
        return $this->belongsToMany(User::class, 'favorites','enquete_id','user_id');
    }
}
