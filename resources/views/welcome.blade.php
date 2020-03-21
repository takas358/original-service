@extends('layouts.app')

@section('content')
    <div class="left jumbotron">
        <div class="text-left" style="color: green">
            <h1>ようこそ Open Enquete へ!!</h1>
            <br>
            <h3>
                <p>Open Enqueteとは、、みんなでアンケートを共有する革新的なサービスです！</p>
                <p>・自分が作ったアンケートを共有し、他の人に回答してもらおう！</P>
                <p>・他の人のアンケートを見て、回答しよう！</p>
                {!! link_to_route('signup.get', '会員登録（無料）', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </h3>
        </div>
    </div>
@endsection