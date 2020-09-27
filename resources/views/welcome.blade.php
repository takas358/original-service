{{-- 
-------------------------------------------------------------------------------------
   トップページ（マイページ）
-------------------------------------------------------------------------------------
--}}

{{-- ----------  ナビゲーションバー・エラーメッセージを表示 ---------- --}}
@extends('layouts.app')

@section('content')
    {{-- ---------- ログインしている場合 ---------- --}}
    @if(Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                {{-- ----------  ページタイトルを表示 ---------- --}}
                <div class="text-left">
                    <h1>マイページ</h1>
                </div>
                <div class="card">
                    {{-- ---------- ユーザー名を表示 ---------- --}}
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    {{-- ---------- ユーザーアイコンを表示 ---------- --}}
                    <div class="card-body">
                        <img class="rounded img-fluid" src="{{ Gravatar::src(Auth::user()->email,500) }}" alt="">
                    </div>
                </div>
                <br>
                {{-- ---------- 「新規アンケートの作成」ボタン（リンク先：アンケート新規作成ページ） ---------- --}}
                {!! link_to_route('enquetes.create','新規アンケートの作成', [], ['class'=>'btn btn-primary']) !!}
            </aside>
            <div class="col-sm-8">
                {{-- ---------- タブを表示 ---------- --}}
                @include('enquetes.navtabs')
                {{-- ---------- アンケートを表示 ---------- --}}
                @include('enquetes.enquetes',['enquetes'=>$enquetes])
            </div>
        </div>
    @else
    {{-- ---------- ログインしていない場合 ---------- --}}
        {{-- ---------- 紹介文を表示する ---------- --}}
        <div class="left jumbotron">
            <div class="text-left" style="color: green">
                <h1>ようこそ Open Enquete へ!!</h1>
                <br>
                <h3>
                    <p>Open Enqueteとは、、みんなでアンケートを共有する革新的なサービスです！</p>
                    <p>自分が作ったアンケートを共有し、他の人に回答してもらおう！</P>
                    <p>他の人のアンケートを見て、回答しよう！</p>
                </h3>
                <br>
                <h5>
                    <p>【こんな時に使える！】<p>
                    <p>・街角に出向いてアンケートを取るのが手間だな。。</p>
                    <p>・アンケートの集計がめんどくさい。。</p>
                    <p>・親へのプレゼントは何がいいだろう。。そうだ！みんなにアンケート取ろう</p>
                </h5>
                {{-- ---------- 「会員登録（無料）」ボタン（リンク先：会員登録ページ） ---------- --}}
                {!! link_to_route('signup.get', '会員登録（無料）', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection