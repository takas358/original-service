@extends('layouts.app')
@section('content')
    <h1>id: {{ $enquete->id }} のアンケート変更</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($enquete, ['route' => ['enquetes.update', $enquete->id],'method'=>'put'])!!}
                <div class="form-group">
                    {!! Form::label('title', 'タイトル') !!}
                    {!! Form::text('title', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('question1', '質問1') !!}
                    {!! Form::text('question1', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('question2', '質問2') !!}
                    {!! Form::text('question2', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('question3', '質問3') !!}
                    {!! Form::text('question3', null, ['class'=>'form-control']) !!}
                </div>
                {!! Form::submit('更新',['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection