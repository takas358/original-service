@extends('layouts.app')

@section('content')
    <h1>id = {{ $enquete->id}} のアンケート詳細</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $enquete->id}}</td>
        </tr>
        <tr>
            <th>投稿者</th>
            <td>
                <img class="mr-2 rounded" src="{{ Gravatar::src($enquete->user->email,50) }}" alt="">
                {{ $enquete->user->name }}
            </td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $enquete->title}}</td>
        </tr>
        <tr>
            <th>質問1</th>
            <td>{{ $enquete->question1}}</td>
        </tr>
        <tr>
            <th>質問2</th>
            <td>{{ $enquete->question2}}</td>
        </tr>
        <tr>
            <th>質問3</th>
            <td>{{ $enquete->question3}}</td>
        </tr>
    </table>
    {!! Form::model($enquete, ['route' => ['enquetes.destroy', $enquete->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除',['class' => 'btn btn-danger'])!!}
    {!! Form::close() !!}
    
@endsection