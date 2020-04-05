@extends('layouts.app')

@section('content')
    
    <h1>アンケート回答</h1>

    <div class="row">
        <div class="col-6">
            <br>
            <h3>タイトル：{!! $enquete->title !!}</h3>
            {!! Form::model($answer, ['route' => ['answers.store',$enquete->id],'method' => 'post']) !!}
                <div class="form-group">
                    {!! Form::label('question1', "質問1：".$enquete->question1) !!}
                    {!! Form::text('answer1',null,['class'=>'form-control']) !!}
                </div>
                @if ($enquete->question2 != null)
                    <div class="form-group">
                        {!! Form::label('question2', "質問2：".$enquete->question2) !!}
                        {!! Form::text('answer2',null,['class'=>'form-control']) !!}
                    </div>
                @endif
                @if ($enquete->question3 != null)
                    <div class="form-group">
                        {!! Form::label('question3', "質問3：".$enquete->question3) !!}
                        {!! Form::text('answer3',null,['class'=>'form-control']) !!}
                    </div>
                @endif
                {!! Form::submit('回答',['class'=>'btn btn-success'])!!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection