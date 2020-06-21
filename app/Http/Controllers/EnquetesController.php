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
        $answer = Answer::where('enquete_id',$enquete->id)->first();
        
        //回答1~3の存在チェック
        $answer_exists=["0","0","0"];
        $answer_display=
        [
            "回答はまだありません",
            "回答はまだありません",
            "回答はまだありません",
        ];

        if( is_null($answer)){
        }else{
            if(!is_null($answer->answer1) ){
                $answer_exists[0] = "1";
                $answer_display[0] = $answer->answer1;
            }
            if(!is_null($answer->answer2) ){
                $answer_exists[1] = "1";
                $answer_display[1] = $answer->answer2;
            }
            if(!is_null($answer->answer3) ){
                $answer_exists[2] = "1";
                $answer_display[2] = $answer->answer3;
            }
        }
        
        return view('enquetes.show',[
            'enquete' => $enquete,
            'answer' => $answer,
            'answer_exists' => $answer_exists,
            'answer_display' => $answer_display,
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
