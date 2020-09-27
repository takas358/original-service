<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //一括で保存可能なカラム
    protected $fillable = ['enquete_id','user_id','answer1','answer2','answer3'];
    
    //回答はユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //回答はアンケートに属する
    public function enquete()
    {
        return $this->belongsTo(Enquete::class);
    }
    
}
