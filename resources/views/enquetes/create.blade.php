{{-- 
-------------------------------------------------------------------------------------
   アンケート新規作成ページ(1/2)
-------------------------------------------------------------------------------------
--}}

{{-- ----------  ナビゲーションバー・エラーメッセージを表示 ---------- --}}
@extends('layouts.app')

@section('content')

    {{-- ----------  ページタイトルを表示 ---------- --}}
    <h1>アンケート新規作成ページ(1/2)</h1>
    {{-- ----------  ページサブタイトルを表示 ---------- --}}
    <h2>~タイトル・質問内容の設定~</h2>
    <br>
    <div class="row">
        <div class="col-6">
            {!! Form::model($enquete, ['route'=>'enquetes.store'])!!}
            
                {{-- ----------  タイトル入力欄を表示 ---------- --}}
                <div class ="form-group">
                    {!! Form::label('title','タイトル') !!}
                    {!! Form::text('title',null,['class'=>'form-control'])!!}
                </div>
                
                {{-- ----------  質問1入力欄を表示 ---------- --}}
                <div class="form-group">
                    {!! Form::label('question1','質問1') !!}
                    {!! Form::text('question1',null,['class'=>'form-control'])!!}
                </div>
                
                {{-- ----------  質問2入力欄を表示 ---------- --}}
                <div class="form-group">
                    {!! Form::label('question2','質問2') !!}
                    {!! Form::text('question2',null,['class'=>'form-control'])!!}
                </div>
                
                {{-- ----------  質問3入力欄を表示 ---------- --}}
                <div class="form-group">
                    {!! Form::label('question3','質問3') !!}
                    {!! Form::text('question3',null,['class'=>'form-control'])!!}
                </div>
                {{-- ----------  「送信」ボタンを表示 ---------- --}}
                {!! Form::submit('送信',['class'=>'btn btn-primary'])!!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection