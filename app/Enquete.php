<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    protected $fillable=['title','question1','question2','question3','user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function favorite_users(){
        return $this->belongsToMany(User::class, 'favorites','enquete_id','user_id');
    }
}
