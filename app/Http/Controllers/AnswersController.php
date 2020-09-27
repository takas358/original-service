<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Answer;
use \App\Enquete;
use \App\Choice;
use Validator;

class AnswersController extends Controller
{
    
/*
-------------------------------------------------------------------------------------------- 
   アンケートの回答（入力画面遷移）
--------------------------------------------------------------------------------------------
*/
    public function create($enquete_id)
    {
        //既に回答済みかをチェック
        //ログインユーザーの取得
        $user=\Auth::user();
        //エラーメッセージの定義
        $valid_mes = 'user-id:'.$user->id.'（'.$user->name.'） has already answerd this enquete！/answers table';
        //チェック用の配列を初期化
        $data[$valid_mes] = null;
        //チェック用の配列にログインユーザーが選択したアンケートに回答したクエリ結果を格納する
        $data[$valid_mes] = Answer::where('enquete_id',$enquete_id)->where('user_id',$user->id)->first();
        //チェック・・・nullであれば通過、nullでなっければエラー
        Validator::make($data,[
            $valid_mes => 'same:null',
        ])->validate();
        
        //選択肢未設定のチェックと回答画面表示用のメッセージの設定
        //ログインユーザーが選択したアンケートを取得
        $enquete = Enquete::find($enquete_id);
        for($i = 1;$i <= 3;$i++){
            $question_name = 'question'.$i;
            if(! is_null($enquete->$question_name)){
                
                //選択肢が設定されていることのチェック
                //ユーザーが選択したアンケートの選択肢を取得
                $choices = $enquete->choices()->where('question_number','=',$i)->first();
                //選択肢の存在フラグ。暫定的に1で初期化（1・・・設定されている、0・・・設定されていない）
                $choices_exist = 1;
                //選択肢が設定されていなかったら
                if(! isset($choices)){
                    //選択肢の存在フラグを0で更新
                    $choices_exist = 0;
                    //エラーメッセージの定義
                    $valid_mes = 'choice is nothing！you can not answer this enquete./choices';
                    //選択肢未設定エラーの発生
                    $data[$valid_mes] = $choices_exist;
                    Validator::make($data,[
                        $valid_mes => 'accepted',
                    ])->validate();
                }

                //回答画面表示用のメッセージを設定する（～つ選んでください）
                if($choices->min_select == $choices->max_select){
                    $select_message[$i-1] = '次の選択肢の中から、'.$choices->max_select.'つ選んでください。';
                }else{
                    $select_message[$i-1] = '次の選択肢の中から、最小：'.$choices->min_select.'つ／最大：'.$choices->max_select.'つ選んでください。';
                }
            
                //選択肢を表示用配列に格納する
                for($j = 1; $j <= 5;$j++){
                    $choice_name = 'choice'.$j;
                    $choices_display[$i-1][$j-1] = $choices->$choice_name;
                }
            }
        }

        //アンケート回答入力画面に遷移
        return view('answers.create',[
            'enquete' => $enquete,
            'select_message' => $select_message,
            'choices_display' => $choices_display,
        ]);
    }

/*
-------------------------------------------------------------------------------------------- 
   アンケートの回答（DB登録）
--------------------------------------------------------------------------------------------
*/
    public function store(Request $request, $enquete_id)
    {
        //質問1～3ごとの回答でいずれかの選択肢を選択しているかをチェック。何も選択されていなかったらエラー
        //アンケートの抽出
        $enquete = Enquete::where('id',$enquete_id)->first();
        for($i = 1;$i <=3;$i++){
            $question_name = 'question'.$i;
            if(! is_null($enquete->$question_name)){
                $this->validate($request,[
                    'choices_question'.$i => 'required',
                ]);
            }
        }
        
        //暫定回答ワークエリアを初期化
        $temp_answer[0] = '00000';
        $temp_answer[1] = '00000';
        $temp_answer[2] = '00000';
        
        //入力した回答を格納する
        $answer[0] = $request->choices_question1;
        $answer[1] = $request->choices_question2;
        $answer[2] = $request->choices_question3;
        
        //質問1～3ごとに暫定回答を更新および選択数のチェック
        for($i = 1;$i <= 3;$i++){
            //エラーメッセージの定義
            $valid_mes = 'number of selections for question'.$i;
            //チェック用配列の初期化
            $data[$valid_mes] = 0;
            //入力した回答を元に暫定回答を更新
            //回答がある場合（なにか選択されている場合）
            if(! is_null($answer[$i-1])){
                foreach($answer[$i-1] as $key => $value){
                    //選択があるとカウントアップする
                    $data[$valid_mes]++;
                    //暫定回答を更新（選択がある場合0から1へ変更する）
                    for($j = 0;$j <= 4;$j++){
                        if($key == $j){
                            if($j == 0){
                                $temp_answer[$i-1] = '1'.substr($temp_answer[$i-1],$j + 1,4);
                            }elseif($j == 4){
                                $temp_answer[$i-1] = substr($temp_answer[$i-1],0,4).'1';
                            }else{
                                $temp_answer[$i-1] = substr($temp_answer[$i-1],0,$j).'1'.substr($temp_answer[$i-1],$j + 1,4 - $j);
                            }
                        }
                    }
                }
                //選択数が最小選択数～最大選択数の範囲かをチェック
                $choice = Choice::where('enquete_id','=',$enquete_id)->where('question_number','=',$i)->first();
                Validator::make($data,[
                    $valid_mes => 'Integer|between:'.$choice->min_select.','.$choice->max_select,
                ])->validate();
            }
        }
        //暫定回答を回答テーブルに登録する
        $request->user()->answers()->create([
            'enquete_id' => $enquete_id,
            'answer1' => $temp_answer[0],
            'answer2' => $temp_answer[1],
            'answer3' => $temp_answer[2],
        ]);

        //トップページに遷移する
        return redirect('/');
    }
    
/*
-------------------------------------------------------------------------------------------- 
   アンケート回答の削除
--------------------------------------------------------------------------------------------
*/
    public function destroy($id)
    {
        //既に回答しているかをチェック
        //ログインユーザーの回答を取得
        $user=\Auth::user();
        $answer = Answer::where('user_id',$user->id)->where('enquete_id',$id)->first();
        //エラーメッセージの定義
        $valid_mes = 'your answer is nothing！/ answer';
        //チェック用配列の初期化
        $data[$valid_mes] = null;
        //チェック用配列にログインユーザーの回答を格納
        $data[$valid_mes] = $answer;
        //既に回答していれば通過、回答がなければエラー
        Validator::make($data,[
            $valid_mes => 'required',
        ])->validate();
        
        //回答の削除
        $answer->delete();
        
        //トップページに遷移する
        return redirect('/');
    }
}