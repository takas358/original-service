<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Answer;
use \App\Enquete;
use \App\Choice;
use Validator;

class AnswersController extends Controller
{
    public function create($enquete_id)
    {
        //回答済みチェック
        $user=\Auth::user();
        $valid_mes = 'user-id:'.$user->id.'（'.$user->name.'） has already answerd this enquete！/answers table';
        $data[$valid_mes] = null;
        $data[$valid_mes] = Answer::where('enquete_id',$enquete_id)->where('user_id',$user->id)->first();
        Validator::make($data,[
            $valid_mes => 'same:null',
        ])->validate();
        
        $enquete = Enquete::find($enquete_id);

        $choices_display = [[]];
        for($i = 1;$i <= 3;$i++){
            $question_name = 'question'.$i;
            if(! is_null($enquete->$question_name)){
                
                $choices = $enquete->choices()->where('question_number','=',$i)->first();
                
                if(isset($choices)){
                    $choices_exist = 1;
                }else{
                    $choices_exist = 0;
                }
                if($choices_exist == 0){
                    break;;
                }

                if($choices->min_select == $choices->max_select){
                    $select_message[$i-1] = '次の選択肢の中から、'.$choices->max_select.'つ選んでください。';
                }else{
                    $select_message[$i-1] = '次の選択肢の中から、最小：'.$choices->min_select.'つ／最大：'.$choices->max_select.'つ選んでください。';
                }
            
                for($j = 1; $j <= 5;$j++){
                    $choice_name = 'choice'.$j;
                    $choices_display[$i-1][$j-1] = $choices->$choice_name;
                }
            }
        }
        if($choices_exist == 0){
            $valid_mes = 'Choice is nothing！you can not answer this enquete./choices';
            $data[$valid_mes] = $choices_exist;
            Validator::make($data,[
                $valid_mes => 'accepted',
            ])->validate();
        }
        
        return view('answers.create',[
            'enquete' => $enquete,
            'select_message' => $select_message,
            'choices_display' => $choices_display,
        ]);
    }
    
    public function store(Request $request, $enquete_id)
    {
        //アンケートの抽出
        $enquete = Enquete::where('id',$enquete_id)->first();
        
        for($i = 1;$i <=3;$i++){
            $question_name = 'question'.$i;
            if($enquete->$question_name){
                $this->validate($request,[
                    'choices_question'.$i => 'required',
                ]);
            }
        }
        
        //暫定的に回答を初期化
        $temp_answer1 = '00000';
        $temp_answer2 = '00000';
        $temp_answer3 = '00000';
        
        $answer1 = $request->choices_question1;
        $answer2 = $request->choices_question2;
        $answer3 = $request->choices_question3;
        
        for($i = 1;$i <= 3;$i++){
            $answer_name = 'answer'.$i;
            $temp_answer_name = 'temp_answer'.$i;
            $valid_mes = 'number of selections for question'.$i;
            $data[$valid_mes] = 0;
            if(! is_null($$answer_name)){
                foreach($$answer_name as $key => $value){
                    $data[$valid_mes]++;
                    for($j = 0;$j <= 4;$j++){
                        if($key == $j){
                            if($j == 0){
                                $$temp_answer_name = '1'.substr($$temp_answer_name,$j + 1,4);
                            }elseif($j == 4){
                                $$temp_answer_name = substr($$temp_answer_name,0,4).'1';
                            }else{
                                $$temp_answer_name = substr($$temp_answer_name,0,$j).'1'.substr($$temp_answer_name,$j + 1,4 - $j);
                            }
                        }
                    }
                }   
                $choice = Choice::where('enquete_id','=',$enquete_id)->where('question_number','=',$i)->first();
                Validator::make($data,[
                    $valid_mes => 'Integer|between:'.$choice->min_select.','.$choice->max_select,
                ])->validate();
            }
        }
        $request->user()->answers()->create([
            'enquete_id' => $enquete_id,
            'answer1' => $temp_answer1,
            'answer2' => $temp_answer2,
            'answer3' => $temp_answer3,
        ]);

        return redirect('/');
    }
    public function destroy($id)
    {
        //ログインユーザーが回答したものを抽出
        $user=\Auth::user();
        $answer = Answer::where('user_id',$user->id)->where('enquete_id',$id)->first();
        
        //回答有無のチェック
        $valid_mes = 'your answer is nothing！/ answer';
        $data[$valid_mes] = null;
        $data[$valid_mes] = $answer;
        Validator::make($data,[
            $valid_mes => 'required',
        ])->validate();
        
        //回答の削除
        $answer->delete();
        
        return redirect('/');
    }
}