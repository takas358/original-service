@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                <div class="text-left">
                    <h1>マイページ</h1>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="card-body">
                        <img class="rounded img-fluid" src="{{ Gravatar::src(Auth::user()->email,500) }}" alt="">
                    </div>
                </div>
                <br>
                {!! link_to_route('enquetes.create','新規アンケートの作成', [], ['class'=>'btn btn-primary']) !!}
            </aside>
            <div class="col-sm-8">
                @include('enquetes.navtabs')
                @include('enquetes.enquetes',['enquetes'=>$enquetes])
            </div>
        </div>
    @else
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
    @endif
@endsection