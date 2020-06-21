@extends('layouts.app')

@section('content')

    <h1>アンケート新規作成ページ(1/2)</h1>
    <h2>~タイトル・質問内容の設定~</h2>
    <br>
    <div class="row">
        <div class="col-6">
            {!! Form::model($enquete, ['route'=>'enquetes.store'])!!}
            
                <div class ="form-group">
                    {!! Form::label('title','タイトル') !!}
                    {!! Form::text('title',null,['class'=>'form-control'])!!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('question1','質問1') !!}
                    {!! Form::text('question1',null,['class'=>'form-control'])!!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('question2','質問2') !!}
                    {!! Form::text('question2',null,['class'=>'form-control'])!!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('question3','質問3') !!}
                    {!! Form::text('question3',null,['class'=>'form-control'])!!}
                </div>
                {!! Form::submit('送信',['class'=>'btn btn-primary'])!!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection