{{-- 
-------------------------------------------------------------------------------------
   ログインページ
-------------------------------------------------------------------------------------
--}}

{{-- ----------  ナビゲーションバー・エラーメッセージを表示 ---------- --}}
@extends('layouts.app')

@section('content')
    {{-- ----------  ページタイトルを表示 ---------- --}}
    <div class="text-center">
        <h1>ログイン</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(['route'=>'login.post'])!!}
                {{-- ----------  メールアドレス入力欄を表示 ---------- --}}
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                {{-- ----------  パスワード入力欄を表示 ---------- --}}
                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                {{-- ---------- 「ログイン」ボタンを表示 ---------- --}}
                {!! Form::submit('ログイン',['class'=>'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            
            {{-- ---------- 会員登録の推奨メッセージを表示 ---------- --}}
            <p class="mt-2">会員登録がまだなら...{!! link_to_route('signup.get', '今すぐ登録しましょう!') !!}</p>
            {{-- ---------- 「戻る」ボタンを表示 ---------- --}}
            <a class="btn btn-secondary" href="/" role="button">
                <i class="far fa-arrow-alt-circle-left"></i>&nbsp;戻る
            </a>
        </div>
    </div>
@endsection