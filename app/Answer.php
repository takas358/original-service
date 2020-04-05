<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['enquete_id','user_id','answer1','answer2','answer3'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function enquete()
    {
        return $this->belongsTo(Enquete::class);
    }
    
}
