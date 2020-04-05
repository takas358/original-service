@extends('layouts.app')

@section('content')
    <h1>アンケートID: {{ $enquete->id}} の詳細</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>アンケートID</th>
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
            <th>
                <p>質問1</p>
                <p>&ensp;回答</p>
            </th>
            <td>
                @if ($enquete->question1 != null)
                    <p>{{ $enquete->question1 }}</p>
                @else
                    <p class="text-secondary">未設定</p>
                @endif
                @if ( $answer_exists[0] == "1")
                    <p>&ensp;{{ $answer_display[0] }}</p>
                @else
                    <p class="text-secondary">&ensp;{{ $answer_display[0] }}</p>
                @endif
            </td>
        </tr>
        <tr>
            <th>
                <p>質問2</p>
                <p>&ensp;回答</p>
            </th>
            <td>
                @if ($enquete->question2 != null)
                    <p>{{ $enquete->question2 }}</p>
                @else
                    <p class="text-secondary">未設定</p>
                @endif
                @if ( $answer_exists[1] == "1")
                    <p>&ensp;{{ $answer_display[1] }}</p>
                @else
                    <p class="text-secondary">&ensp;{{ $answer_display[1] }}</p>
                @endif
            </td>
        </tr>
        <tr>
            <th>
                <p>質問3</p>
                <p>&ensp;回答</p>
            </th>
            <td>
                @if ($enquete->question3 != null)
                    <p>{{ $enquete->question3 }}</p>
                @else
                    <p class="text-secondary">未設定</p>
                @endif
                @if ( $answer_exists[2] == "1" )
                    <p>&ensp;{{ $answer_display[2] }}</p>
                @else
                    <p class="text-secondary">&ensp;{{ $answer_display[2] }}</p>
                @endif
            </td>
        </tr>
    </table>
    {!! Form::model($enquete, ['route' => ['enquetes.destroy', $enquete->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除',['class' => 'btn btn-danger'])!!}
    {!! Form::close() !!}
    
@endsection