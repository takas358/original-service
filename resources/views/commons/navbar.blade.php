{{-- 
-------------------------------------------------------------------------------------
   ナビゲーションバーを表示
-------------------------------------------------------------------------------------
--}}

<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-success"> 
        {{-- ---------- サービス名を表示---------- --}}
        <a class="navbar-brand" href="/">Open Enquete</a>
         
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- ---------- ログインしている場合 ---------- --}}
                @if (Auth::check())
                    {{-- ---------- ログアウトメニューを表示 ---------- --}}
                    <li class="nav-item">{!! link_to_route('logout.get','ログアウト', [], ['class' => "nav-link"]) !!} </li>
                {{-- ---------- ログインしていない場合 ---------- --}}
                @else
                    {{-- ---------- 会員登録メニューを表示 ---------- --}}
                    <li class="nav-item">{!! link_to_route('signup.get','会員登録', [], ['class'=>"nav-link"]) !!}</li>
                    {{-- ---------- ログインメニューを表示 ---------- --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => "nav-link"]) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>