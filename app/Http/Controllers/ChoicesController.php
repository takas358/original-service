<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\User;
use App\Enquete;
use App\Choice;

class ChoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($enquete_id)
    {
        $enquete = Enquete::find($enquete_id);
        
        return view('choices.create',[
            'enquete' => $enquete,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$enquete_id)
    {

        $enquete = Enquete::find($enquete_id);
        
        for($i = 1; $i <= 3; $i++){
            $question_name = 'question'.$i;
            $min_column_name = 'min_select'.$i;
            $max_column_name = 'max_select'.$i;
            $choice_count = 0;
            if(! is_null($enquete->$question_name)){
                for($j = 1; $j <= 5; $j++){
                    $choice_column_name = 'choice'.$i.'_'.$j;
                    if(! is_null($request->$choice_column_name)){
                        $choice_count++;
                    }
                }
                for($j = 2; $j <= 5; $j++){
                    $k = $j + 1;
                    $this->validate($request, [
                        'min_select'.$i => 'required|numeric|max:'.$request->$max_column_name.'|max:'.$choice_count,
                        'max_select'.$i => 'required|numeric|between:'.$request->$min_column_name.','.$choice_count,
                        'choice'.$i.'_1' => 'required|max:30',
                        'choice'.$i.'_'.$j => 'required_with:choice'.$i.'_'.$k.'|max:30',
                    ]);
                }
                $choice_name = 'choice'.$i;
                
                $$choice_name = $enquete->choices()->where('question_number','=',$i)->first();
                if( is_null($$choice_name)){
                    $$choice_name= new Choice;
                }
                
                $$choice_name->enquete_id = $enquete_id;
                $$choice_name->question_number = $i;
                $$choice_name->min_select = $request->$min_column_name;
                $$choice_name->max_select = $request->$max_column_name;
                for($j = 1; $j <= 5; $j++){
                    $choice_field_name = 'choice'.$j;
                    $choice_column_name = 'choice'.$i.'_'.$j;
                    $$choice_name->$choice_field_name = $request->$choice_column_name;
                }
                $$choice_name->save();
            }
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->store($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}