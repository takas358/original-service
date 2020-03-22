<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enquete;
use App\User;

class EnquetesController extends Controller
{
    public function index()
    {
        $data = [];
        if(\Auth::user()){
            $user=\Auth::user();
            $enquetes = $user->enquetes()->orderBy('created_at','desc')->paginate(10);

            $data = [
               'user' => $user,
                'enquetes' => $enquetes,
            ];
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
        
        return view('enquetes.show',[
            'enquete' => $enquete,
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
