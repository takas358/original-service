{{-- 
-------------------------------------------------------------------------------------
   メッセージを表示
-------------------------------------------------------------------------------------
--}}

{{-- ---------- エラーメッセージがあれば、エラーメッセージを表示 ---------- --}}
@if (count($errors)>0)
    <ul class="alert alert-danger" role="alert">
        {{-- ---------- エラーメッセージがある分だけ全て表示 ---------- --}}
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif

{{-- ---------- フラッシュメッセージがあれば、そのメッセージを表示 ---------- --}}
@if (session('flash_message'))
    <div class="flash_message alert alert-success">
        {{ session('flash_message') }}
    </div>
@endif