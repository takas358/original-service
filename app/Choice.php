<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    //一括で保存可能なカラム
    protected $fillable =
    [
        'enquete_id','question_number','min_select','max_select','choice1','choice2','choice3','choice4','choice5'
    ];
    
    //選択肢はアンケートに属する
    public function enquete()
    {
        return $this->belongsTo(Enquete::class);
    }
}
