{{-- 
-------------------------------------------------------------------------------------
   アンケートを表示
-------------------------------------------------------------------------------------
--}}

<ul class="list-unstyled">
    @foreach ($enquetes as $enquete)
        <li class="card">
            {{-- ---------- タイトルを表示（リンク先：アンケート詳細ページ） ---------- --}}
            <div class="card-header border-bottom-0 pb-0">
                <p class="mb-0"><h5><b>{!! link_to_route('enquetes.show',nl2br(e($enquete->title)), [$enquete->id], ['class'=>"link"]) !!}</h5></b></p>
            </div>
            <div class="card-body bg-light pt-0 pb-0 pl-1 pr-2">
                <div class="float-left col-7">
                    {{-- ---------- 質問1を表示 ---------- --}}
                    <p class="mb-0">質問1：{!! nl2br(e($enquete->question1)) !!}</p>
                    {{-- ---------- 質問2が設定されていたら、質問2表示 ---------- --}}
                    @if(! is_null($enquete->question2))
                        <p class="mb-0">質問2：{!! nl2br(e($enquete->question2)) !!}</p>
                    {{-- ---------- 質問2が設定されていなかったら、"質問2：なし"を表示 ---------- --}}
                    @else
                        <p class="mb-0 text-muted">質問2：なし</p>
                    @endif
                    {{-- ---------- 質問3が設定されていたら、質問3表示 ---------- --}}
                    @if(! is_null($enquete->question3))
                        <p class="mb-0">質問3：{!! nl2br(e($enquete->question3)) !!}</p>
                    {{-- ---------- 質問3が設定されていなかったら、"質問3：なし"を表示 ---------- --}}
                    @else
                        <p class="mb-0 text-muted">質問3：なし</p>
                    @endif
                </div>
            </div>
            <div class="card-footer border-top-0 pb-1">
                {{-- ---------- 作成者を表示 ---------- --}}
               <div class="float-left row col-5 d-flex align-items-center align-items-end">
                    <p>作成者：</p>
                    <img class="mr-2 rounded" src="{{ Gravatar::src($enquete->user->email,30) }}" alt="">
                    &nbsp;<p>{{ $enquete->user->name }}</p>
               </div>
               {{-- ---------- 作成日時を表示 ---------- --}}
               <div class="float-right">
                   <p>作成日時：{{ $enquete->created_at }}</p>
               </div>
            </div>
        </li>
        <br>
    @endforeach
</ul>
{!! $enquetes->links('pagination::bootstrap-4')!!}