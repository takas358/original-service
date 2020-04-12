<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enquete;
use App\User;
use App\Answer;

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
        
        return redirect('/');
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
        
        return view('enquetes.edit',[
            'enquete' => $enquete,
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
        
        return redirect('/');
    }
    
    public function destroy($id)
    {
        $enquete = Enquete::find($id);
        
        if(\Auth::id()===$enquete->user_id){
            $enquete->delete()  ;
        }
        
        return redirect('/');
    }
}
