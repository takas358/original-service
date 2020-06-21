<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable =
    [
        'enquete_id','question_number','min_select','max_select','choice1','choice2','choice3','choice4','choice5'
    ];
    
    public function enquete()
    {
        return $this->belongsTo(Enquete::class);
    }
}
