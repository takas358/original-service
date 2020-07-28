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
    public function top(){
        $data = [];
        if(\Auth::user()){

            $user=\Auth::user();
            $enquetes = $user->enquetes()->orderBy('created_at','desc')->paginate(10);
                    
            $data = [
               'user' => $user,
               'enquetes' => $enquetes,
            ];
            
            $data += $this->counts($user);
        }
        return view('welcome', $data);
    }
    
    public function index($page_type)
    {
        $data = [];
        if(\Auth::user()){

            $user=\Auth::user();
            switch($page_type){
                case "1":
                    $enquetes = $user->favorites()->paginate(10);
                    break;
                case "2":
                    $enquetes = $user->enquetes()->orderBy('created_at','desc')->paginate(10);
                    break;
                case "3":
                    $enquetes = Enquete::where('user_id','!=',$user->id)->orderBy('created_at','desc')->paginate(10);
                    break;
            }

            $data = [
               'user' => $user,
               'enquetes' => $enquetes,
            ];
            
            $data += $this->counts($user);
        }
        return view('welcome', $data);
    }
    
    public function create()
    {
        $enquete = new Enquete;
        
        return view('enquetes.create',[
            'enquete' => $enquete,
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'question1' => 'required|max:191',
            'question2' => 'max:191',
            'question3' => 'max:191',
        ]);
        
        $request->user()->enquetes()->create([
            'title' => $request->title,
            'question1' => $request->question1,
            'question2' => $request->question2,
            'question3' => $request->question3,
        ]);
        
        $enquete = Enquete::where('user_id','=',\Auth::user()->id)->orderBy('created_at','desc')->first();

        return redirect('enquetes/'.$enquete->id.'/choice_create');
    }
    
    public function show($id)
    {
        $enquete = Enquete::find($id);
        
        $response_count = Answer::where('enquete_id',$id)->count();
        
        
        $select_message = [[]];
        for($i = 1;$i <= 3;$i++){
            $question_name = 'question'.$i;
            if(! is_null($enquete->$question_name)){
                $choice = $enquete->choices()->where('question_number','=',$i)->first();
                if(! is_null($choice)){
                    if($choice->min_select == $choice->max_select){
                        $select_message[$i-1] = '次の選択肢の中から、'.$choice->max_select.'つ選んでください。';
                    }else{
                        $select_message[$i-1] = '次の選択肢の中から、最小：'.$choice->min_select.'つ／最大：'.$choice->max_select.'つ選んでください。';
                    }
                }else{
                    $select_message[$i-1] = '【注意：この質問には選択肢が設定されていません。】';
                }
            }
        }
        
        //回答1~3の存在チェック
        $answer_exists = ["0","0","0"];
        $answer_nothing = [
            "まだ回答はありません。",
            "まだ回答はありません。",
            "まだ回答はありません。",
        ];
        $answer = Answer::where('enquete_id',$id)->get();
        foreach($answer as $ans){
            if(! is_null($ans)){
                if($ans->answer1 != "00000"){
                    $answer_exists[0] = "1";
                }
                if($ans->answer2 != "00000"){
                    $answer_exists[1] = "1";
                }
                if($ans->answer3 != "00000"){
                    $answer_exists[2] = "1";
                }
            }
        }
        
        $pattern[0] = '1%';
        $pattern[1] = '_1___';
        $pattern[2] = '__1__';
        $pattern[3] = '___1_';
        $pattern[4] = '%1';
        
        $answer_count = [[]];
        for($i = 1;$i <= 3;$i++){
            $answer_count[$i-1][5] = 0;
            $answer_number = 'answer'.$i;
            //回答別の選択数を格納
            for($j = 0;$j <= 4;$j++){
                $answer_count[$i-1][$j] = Answer::where('enquete_id',$id)->where($answer_number,'like',$pattern[$j])->count();
                $answer_count[$i-1][5] += $answer_count[$i-1][$j];
            }
            //回答別の構成比を格納
            for($k = 0;$k <= 4;$k++){
                if($answer_count[$i-1][5] == 0){
                    $composition_ratio[$i-1][$k] = 0.0;
                }else{
                    $composition_ratio[$i-1][$k] = round($answer_count[$i-1][$k]/$answer_count[$i-1][5]*100,1);
                }
            }
        }
        
        for($i = 1;$i <= 3;$i++){
            $choices[$i-1] = null;
            $choices[$i-1] = Choice::where('enquete_id',$id)->where('question_number',$i)->first();
        }
        
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
    
    public function edit($id)
    {
        $enquete = Enquete::find($id);
        
        $choice = [];
        $choice_display = [[]];
        $choice_column_name = ['min_select','max_select','choice1','choice2','choice3','choice4','choice5'];
        
        for($i = 1;$i <= 3;$i++){
            $choice[$i-1] = $enquete->choices()->where('question_number','=',$i)->first();
            for($j = 1;$j <= 7; $j++){
                if(! is_null($choice[$i-1])){
                    $choice_display[$i-1][$j-1] = $choice[$i-1]->{$choice_column_name[$j-1]};
                }else{
                    $choice_display[$i-1][$j-1] = null;
                }
            }
        }
        
        return view('enquetes.edit',[
            'enquete' => $enquete,
            'choice_display' => $choice_display,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $enquete = Enquete::find($id);

        $enquete->title = $request->title;
        $enquete->question1 = $request->question1;
        $enquete->question2 = $request->question2;
        $enquete->question3 = $request->question3;
        $enquete->save();
        
        $coices_controller = app()->make('App\Http\Controllers\ChoicesController');
        $coices_controller->update($request, $id);
        
        return redirect('/');
    }
    
    public function destroy($id)
    {
        $enquete = Enquete::find($id);
        
        if(\Auth::id()===$enquete->user_id){
            $enquete->choices()->delete();
            $enquete->delete();
        }
        
        return redirect('/');
    }
}
