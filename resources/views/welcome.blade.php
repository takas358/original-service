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
                {!! link_to_route('enquetes.create','アンケートの新規作成', [], ['class'=>'btn btn-primary']) !!}
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
        <div class="left jumbotron border border-success bg-light">
            <div class="text-left" style="color: green">
                <h1>ようこそ Open Enquete へ!!</h1>
                <br>
                <h3>
                    <div class="row">
                        <i class="fas fa-square"></i>
                        &nbsp;<p>このサービスについて<p>
                    </div>
                </h3>
                <h5>
                    <p>みんなでアンケートを共有する革新的なサービスです！</p>
                    <p>自分が作ったアンケートを共有し、他の人に回答してもらおう！</P>
                    <p>他の人のアンケートを見て、回答しよう！</p>
                    <br>
                </h5>
                <h3>
                    <div class="row">
                        <i class="fas fa-square"></i>
                        &nbsp;<p>こんな時に使おう！<p>
                    </div>
                </h3>
                <h5>
                    <p>・親へのプレゼントは何がいいだろう。。？そうだ！みんなにアンケート取ろう</p>
                    <p>・わざわざ街角に出向いてアンケートを取るのが手間だな。。</p>
                    <p>・アンケートの集計がめんどくさい。。</p>
                </h5>
                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#demoNormalModal">
                    製作物説明（使用方法など）
                </button>
                
                {{-- ---------- 「会員登録（無料）」ボタン（リンク先：会員登録ページ） ---------- --}}
                &nbsp;&nbsp;{!! link_to_route('signup.get', '会員登録（無料）', [], ['class' => 'btn btn-lg btn-primary']) !!}
                &nbsp;&nbsp;{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}
                <br>
            </div>
        </div>
    @endif
@endsection