<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enquete;
use App\User;
use App\Answer;
use App\Choice;

use App\Http\Controllers;

class EnquetesController extends Controller
{
/*
--------------------------------------------------------------------------------------------
   ログイン直後マイページ（トップ）の編集
--------------------------------------------------------------------------------------------
*/
    public function top(){
        //ページ表示に使用するデータ用配列を用意
        $data = [];
        //ログイン中のユーザである場合、そのユーザのアンケートを作成日時の降順に並び替える
        //また、1ページにつき10アンケートまでとする
        if(\Auth::user()){
            $user=\Auth::user();
            $enquetes = $user->enquetes()->orderBy('created_at','desc')->paginate(10);
                    
            $data = [
               'user' => $user,
               'enquetes' => $enquetes,
            ];
            
            //個数（お気に入り/マイアンケート/アンケート閲覧）を取得
            $data += $this->counts($user);
        }
        //ログイン直後マイページ（トップ）を表示する
        return view('welcome', $data);
    }

/*
-------------------------------------------------------------------------------------------- 
   各タブ（お気に入り/マイアンケート/アンケート閲覧）の編集
--------------------------------------------------------------------------------------------
*/
    public function index($page_type)
    {
        //ページ表示に使用するデータ用配列を用意
        $data = [];
         //ログイン中のユーザである場合
        if(\Auth::user()){
            $user=\Auth::user();
            switch($page_type){
                //お気に入りタブ・・・お気に入り登録しているアンケートを取得（1ページにつき10アンケートまでとする）
                case "1":
                    $enquetes = $user->favorites()->paginate(10);
                    break;
                //マイアンケートタブ・・・自分が投稿したアンケートを取得（1ページにつき10アンケートまでとする）
                case "2":
                    $enquetes = $user->enquetes()->orderBy('created_at','desc')->paginate(10);
                    break;
                //アンケート閲覧タブ・・・他人が投稿したアンケートを取得（1ページにつき10アンケートまでとする）
                case "3":
                    $enquetes = Enquete::where('user_id','!=',$user->id)->orderBy('created_at','desc')->paginate(10);
                    break;
            }

            $data = [
               'user' => $user,
               'enquetes' => $enquetes,
            ];

            //個数（お気に入り/マイアンケート/アンケート閲覧）を取得
            $data += $this->counts($user);
        }
        //ログイン直後マイページ（トップ）を表示する
        return view('welcome', $data);
    }

/*
-------------------------------------------------------------------------------------------- 
    新規アンケートの作成（入力画面遷移）
--------------------------------------------------------------------------------------------
*/
    public function create()
    {
        //アンケートテーブルの新規作成
        $enquete = new Enquete;
        
        //入力画面へ遷移
        return view('enquetes.create',[
            'enquete' => $enquete,
        ]);
    }
    
/*
--------------------------------------------------------------------------------------------
    新規アンケートの作成（DB登録）
--------------------------------------------------------------------------------------------
*/
    public function store(Request $request)
    {
        //アンケート入力項目のチェック
        $this->validate($request, [
            'title' => 'required|max:30',
            'question1' => 'required|max:191',
            'question2' => 'max:191',
            'question3' => 'max:191',
        ]);
        
        //入力項目をアンケートテーブルに登録
        $request->user()->enquetes()->create([
            'title' => $request->title,
            'question1' => $request->question1,
            'question2' => $request->question2,
            'question3' => $request->question3,
        ]);
        
        //上記で登録したアンケートを取得
        $enquete = Enquete::where('user_id','=',\Auth::user()->id)->orderBy('created_at','desc')->first();
        
        //アンケート回答選択肢の入力画面へ遷移
        return redirect('enquetes/'.$enquete->id.'/choice_create');
    }
/*
-------------------------------------------------------------------------------------------- 
   アンケート詳細ページ
--------------------------------------------------------------------------------------------
*/
    public function show($id)
    {
        //アンケートを取得
        $enquete = Enquete::find($id);
        
        //アンケートの回答数を取得
        $response_count = Answer::where('enquete_id',$id)->count();

        //アンケート質問メッセージの格納用配列
        $select_message = [[]];
        
        //アンケート質問1～3についてのメッセージを設定する
        for($i = 1;$i <= 3;$i++){
            $question_name = 'question'.$i;
            if(! is_null($enquete->$question_name)){
                //質問1～3それぞれの回答選択肢を取得
                $choice = $enquete->choices()->where('question_number','=',$i)->first();
                //選択肢が設定されている場合
                if(! is_null($choice)){
                    //最小回答数と最大回答数が同じ場合
                    if($choice->min_select == $choice->max_select){
                        $select_message[$i-1] = '次の選択肢の中から、'.$choice->max_select.'つ選んでください。';
                    //最小回答数と最大回答数が異なる場合
                    }else{
                        $select_message[$i-1] = '次の選択肢の中から、最小：'.$choice->min_select.'つ／最大：'.$choice->max_select.'つ選んでください。';
                    }
                //選択肢が設定されていない場合
                }else{
                    $select_message[$i-1] = '【注意：この質問には選択肢が設定されていません。】';
                }
            }
        }
        
        //回答1~3の存在チェック
        //回答の存在フラグを定義する（1・・・存在する、0・・・存在しない）
        $answer_exists = ["0","0","0"];
        //回答が存在しなかった場合のメッセージを定義する
        $answer_nothing = [
            "まだ回答はありません。",
            "まだ回答はありません。",
            "まだ回答はありません。",
        ];
        
        //アンケートに対する回答を取得する
        $answer = Answer::where('enquete_id',$id)->get();
        foreach($answer as $ans){
            if(! is_null($ans)){
                //回答1（質問1に対する回答）が回答済の場合
                if($ans->answer1 != "00000"){
                    //回答1の存在フラグをONにする
                    $answer_exists[0] = "1";
                }
                //回答2（質問2に対する回答）が回答済の場合
                if($ans->answer2 != "00000"){
                    //回答2の存在フラグをONにする
                    $answer_exists[1] = "1";
                }
                //回答3（質問3に対する回答）が回答済の場合
                if($ans->answer3 != "00000"){
                    //回答3の存在フラグをONにする
                    $answer_exists[2] = "1";
                }
            }
        }
        
        //パターンの定義
        //1桁目がONのパターン
        $pattern[0] = '1%';
        //2桁目がONのパターン
        $pattern[1] = '_1___';
        //3桁目がONのパターン
        $pattern[2] = '__1__';
        //4桁目がONのパターン
        $pattern[3] = '___1_';
        //5桁目がONのパターン
        $pattern[4] = '%1';
        
        //選択数の格納用配列
        $answer_count = [[]];
        
        //選択肢別の選択数・それらの構成比・全選択肢の合計選択数を求める
        for($i = 1;$i <= 3;$i++){
            $answer_count[$i-1][5] = 0;
            $answer_number = 'answer'.$i;
            for($j = 0;$j <= 4;$j++){
                //選択肢別の選択数を格納
                $answer_count[$i-1][$j] = Answer::where('enquete_id',$id)->where($answer_number,'like',$pattern[$j])->count();
                //全選択肢の合計選択数を格納
                $answer_count[$i-1][5] += $answer_count[$i-1][$j];
            }
            //回答別の構成比を格納
            for($k = 0;$k <= 4;$k++){
                if($answer_count[$i-1][5] == 0){
                    $composition_ratio[$i-1][$k] = 0.0;
                }else{
                    //構成比 = 選択肢別の選択数 ÷　全選択肢の合計選択数 ×　100　（小数点第1位まで表示）
                    $composition_ratio[$i-1][$k] = round($answer_count[$i-1][$k] / $answer_count[$i-1][5] * 100 ,1);
                }
            }
        }
        
        //質問1～3それぞれに対する選択肢を取得
        for($i = 1;$i <= 3;$i++){
            $choices[$i-1] = null;
            $choices[$i-1] = Choice::where('enquete_id',$id)->where('question_number',$i)->first();
        }
        
        //アンケート詳細ページへ遷移
        return view('enquetes.show',[
            'enquete' => $enquete,
            'response_count' => $response_count,
            'select_message' => $select_message,
            'answer_exists' => $answer_exists,
            'answer_nothing' => $answer_nothing,
            'answer_count' => $answer_count,
            'composition_ratio' => $composition_ratio,
            'choices' => $choices,
        ]);
    }

/*
-------------------------------------------------------------------------------------------- 
   アンケートの変更（入力）
--------------------------------------------------------------------------------------------
*/

    public function edit($id)
    {
        //アンケートを取得
        $enquete = Enquete::find($id);
        
        $choice = [];
        $choice_display = [[]];
        //選択肢テーブルのフィールド名（最小選択数・最大選択数・選択肢1～5）
        $choice_column_name = ['min_select','max_select','choice1','choice2','choice3','choice4','choice5'];
        
        //選択肢テーブルの値を取得
        for($i = 1;$i <= 3;$i++){
            //質問1～3それぞれに対する選択肢を取得
            $choice[$i-1] = $enquete->choices()->where('question_number','=',$i)->first();
            for($j = 1;$j <= 7; $j++){
                //選択肢が設定されている場合、選択肢テーブルの値をそのままセット
                if(! is_null($choice[$i-1])){
                    $choice_display[$i-1][$j-1] = $choice[$i-1]->{$choice_column_name[$j-1]};
                //選択肢が設定されていない場合、nullをセット
                }else{
                    $choice_display[$i-1][$j-1] = null;
                }
            }
        }
        
        //アンケート変更画面へ遷移
        return view('enquetes.edit',[
            'enquete' => $enquete,
            'choice_display' => $choice_display,
        ]);
    }

/*
--------------------------------------------------------------------------------------------
   アンケートの変更（DB更新）
--------------------------------------------------------------------------------------------
*/

    public function update(Request $request, $id)
    {
        //アンケートを取得する
        $enquete = Enquete::find($id);

        //アンケートを更新する
        $enquete->title = $request->title;
        $enquete->question1 = $request->question1;
        $enquete->question2 = $request->question2;
        $enquete->question3 = $request->question3;
        $enquete->save();
        
        //選択肢の更新を行う（ChoicesControllerのupdateメソッドに遷移する
        $coices_controller = app()->make('App\Http\Controllers\ChoicesController');
        $coices_controller->update($request, $id);
        
        //マイページに遷移する
        return redirect('/enquetes/'.$enquete->id)->with('flash_message', 'アンケートの変更が完了しました');
    }
/*
--------------------------------------------------------------------------------------------
   アンケートの削除
--------------------------------------------------------------------------------------------
*/

    public function destroy($id)
    {
        //アンケートを取得する
        $enquete = Enquete::find($id);
        
        //ログイン中のユーザがアンケートの作成者と同じであること
        if(\Auth::id() === $enquete->user_id){
            //アンケート回答の削除
            $enquete->answers()->delete();
            //アンケートの選択肢の削除
            $enquete->choices()->delete();
            //アンケートの削除
            $enquete->delete();
        }
        
        //マイページに遷移する
        return redirect('/')->with('flash_message', 'アンケートの削除が完了しました');
    }
}
