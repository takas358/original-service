<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Answer;
use \App\Enquete;

class AnswersController extends Controller
{
    public function create($enquete_id)
    {
        //回答済みチェック（しばらく凍結）
        /*$answerd = null;
        $answerd = Answer::where('enquete_id',$enquete_id)::where('user_id',$user->id);
        
        if ($answerd !==null){
            return redirect('/')->with('flash_message', 'このアンケートには、すでに回答しています。');
        }*/
        
        $enquete = Enquete::find($enquete_id);
        
        $answer = new Answer;

        return view('answers.create',[
            'answer' => $answer,
            'enquete' => $enquete,
        ]);
    }
    
    public function store(Request $request, $enquete_id)
    {
        $this->validate($request,[
            'answer1' => 'required|max:191',
            'answer2' => 'max:191',
            'answer3' => 'max:191',
        ]);
        
        $request->user()->answers()->create([
            'enquete_id' => $enquete_id,
            'answer1' => $request->answer1,
            'answer2' => $request->answer2,
            'answer3' => $request->answer3,
        ]);
        
        return redirect('/');
    }
}