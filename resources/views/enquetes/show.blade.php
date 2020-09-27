{{-- 
-------------------------------------------------------------------------------------
   アンケート詳細を表示
-------------------------------------------------------------------------------------
--}}

{{-- ----------  ナビゲーションバー・エラーメッセージを表示 ---------- --}}
@extends('layouts.app')

@section('content')
    {{-- ----------  ページタイトルを表示 ---------- --}}
    <h1>アンケートID: {{ $enquete->id}} の詳細</h1>
    
    <div class="row">
        <div class="col-9">
            <table class="table table-bordered success">
                {{-- ----------  アンケートIDを表示 ---------- --}}
                <tr>
                    <th>アンケートID</th>
                    <td>{{ $enquete->id}}</td>
                </tr>
                {{-- ----------  投稿者を表示 ---------- --}}
                <tr>
                    <th>投稿者</th>
                    <td>
                        <img class="mr-2 rounded" src="{{ Gravatar::src($enquete->user->email,50) }}" alt="">
                        {{ $enquete->user->name }}
                    </td>
                </tr>
                {{-- ----------  アンケートタイトルを表示 ---------- --}}
                <tr>
                    <th>タイトル</th>
                    <td>{{ $enquete->title}}</td>
                </tr>
                {{-- ----------  アンケート回答数を表示 ---------- --}}
                <tr>
                    <th>回答数</th> 
                    <td>{{ $response_count }}</td>
                </tr>
                {{-- ----------  質問内容と集計結果を表示 ---------- --}}
                <tr>
                    <th>
                        <p>質問1</p>
                        <br>
                        <p>&ensp;回答</p>
                    </th>
                    <td>
                        {{-- ----------  質問1が設定されていたら、質問内容を表示 ---------- --}}
                        @if ($enquete->question1 != null)
                            <p>{{ $enquete->question1 }}</p>
                            <p>{{ $select_message[0] }}</p>
                        {{-- ----------  質問1が設定されていなかったら、"未設定"を表示 ---------- --}}
                        @else
                            <p class="text-secondary">未設定</p>
                        @endif
                        {{-- ----------  質問1の回答が設定されていたら、集計結果を表示 ---------- --}}
                        @if ( $answer_exists[0] == "1")
                            <table class="table-responsive">
                                <tr>
                                    <th class="text-center">選択肢</th>
                                    <th class="text-center">選択数</th>
                                    <th class="text-center">構成比</th>
                                </tr>
                                {{-- ----------  質問1の選択肢1～5が設定されていたら、それぞれの選択肢内容、選択数、構成比を表示 ---------- --}}
                                @for($i = 1;$i <= 5;$i++)
                                    @php $choice_name = 'choice'.$i; @endphp
                                    @if(! is_null($choices[0]->$choice_name))
                                        <tr>
                                            <td>{{ $choices[0]->$choice_name }}</td>
                                            <td class="text-right">{{ $answer_count[0][$i-1] }}</td>
                                            <td class="text-right">{{ $composition_ratio[0][$i-1].' %' }}</td>
                                        </tr>
                                    @endif
                                @endfor
                                {{-- ----------  質問1の全体選択数を表示 ---------- --}}
                                <tr>
                                    <th class="text-center">全体選択数</th>
                                    <td class="text-right">{{ $answer_count[0][5] }}</td>
                                </tr>
                            </table>
                        {{-- ----------  質問1の回答が設定されていなかったら、その旨を表示 ---------- --}}
                        @else
                            <p class="text-secondary">&ensp;{{ $answer_nothing[0] }}</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>質問2</p>
                        <br>
                        <p>&ensp;回答</p>
                    </th>
                    <td>
                        {{-- ----------  質問2が設定されていたら、質問内容を表示 ---------- --}}
                        @if ($enquete->question2 != null)
                            <p>{{ $enquete->question2 }}</p>
                            <p>{{ $select_message[1] }}</p>
                        {{-- ----------  質問2が設定されていなかったら、"未設定"を表示 ---------- --}}
                        @else
                            <p class="text-secondary">未設定</p>
                        @endif
                        {{-- ----------  質問1の回答が設定されていたら、集計結果を表示 ---------- --}}
                        @if ( $answer_exists[1] == "1")
                            <table class="table-responsive">
                                <tr>
                                    <th class="text-center">選択肢</th>
                                    <th class="text-center">選択数</th>
                                    <th class="text-center">構成比</th>
                                </tr>
                                {{-- ----------  質問2の選択肢1～5が設定されていたら、それぞれの選択肢内容、選択数、構成比を表示 ---------- --}}
                                @for($i = 1;$i <= 5;$i++)
                                    @php $choice_name = 'choice'.$i; @endphp
                                    @if(! is_null($choices[1]->$choice_name))
                                        <tr>
                                            <td>{{ $choices[1]->$choice_name }}</td>
                                            <td class="text-right">{{ $answer_count[1][$i-1] }}</td>
                                            <td class="text-right">{{ $composition_ratio[1][$i-1].' %' }}</td>
                                        </tr>
                                    @endif
                                @endfor
                                {{-- ----------  質問2の全体選択数を表示 ---------- --}}
                                <tr>
                                    <th class="text-center">全体選択数</th>
                                    <td class="text-right">{{ $answer_count[1][5] }}</td>
                                </tr>
                            </table>
                         {{-- ----------  質問1の回答が設定されていなかったら、その旨を表示 ---------- --}}
                        @else
                            <p class="text-secondary">&ensp;{{ $answer_nothing[1] }}</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>    
                        <p>質問3</p>
                        <br>
                        <p>&ensp;回答</p>
                    </th>
                    <td>
                        {{-- ----------  質問3が設定されていたら、質問内容を表示 ---------- --}}
                        @if ($enquete->question3 != null)
                            <p>{{ $enquete->question3 }}</p>
                            <p>{{ $select_message[2] }}</p>
                        {{-- ----------  質問3が設定されていなかったら、"未設定"を表示 ---------- --}}
                        @else
                            <p class="text-secondary">未設定</p>
                        @endif
                        {{-- ----------  質問3の回答が設定されていたら、集計結果を表示 ---------- --}}
                        @if ( $answer_exists[2] == "1")
                            <table class="table-responsive">
                                <tr>
                                    <th class="text-center">選択肢</th>
                                    <th class="text-center">選択数</th>
                                    <th class="text-center">構成比</th>
                                </tr>
                                {{-- ----------  質問3の選択肢1～5が設定されていたら、それぞれの選択肢内容、選択数、構成比を表示 ---------- --}}
                                @for($i = 1;$i <= 5;$i++)
                                    @php $choice_name = 'choice'.$i; @endphp
                                    @if(! is_null($choices[2]->$choice_name))
                                        <tr>
                                            <td>{{ $choices[2]->$choice_name }}</td>
                                            <td class="text-right">{{ $answer_count[2][$i-1] }}</td>
                                            <td class="text-right">{{ $composition_ratio[2][$i-1].' %' }}</td>
                                            </tr>
                                    @endif
                                @endfor
                                {{-- ----------  質問3の全体選択数を表示 ---------- --}}
                                <tr>
                                    <th class="text-center">全体選択数</th>
                                    <td class="text-right">{{ $answer_count[2][5] }}</td>
                                </tr>
                            </table>
                        {{-- ----------  質問3の回答が設定されていなかったら、その旨を表示 ---------- --}}
                        @else
                            <p class="text-secondary">&ensp;{{ $answer_nothing[2] }}</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <aside class="col-sm-1">
            {{-- ----------  「お気に入り登録」もしくは「お気に入り解除」ボタンを表示 ---------- --}}
            @include('favorite.favorite_button', ['enquete' =>$enquete ])
            <br>
            {{-- ----------  「アンケート回答」ボタンを表示 ---------- --}}
            {!! Form::open(['route'=>['answers.create',$enquete->id], 'method' => 'get'])!!}
                {!! Form::submit('アンケート回答',['class' => 'btn btn-outline-success']) !!}
            {!! Form::close() !!}
            <br>
            {{-- ----------  「回答の削除」ボタンを表示 ---------- --}}
            {!! Form::open(['route'=>['answers.delete',$enquete->id], 'method' => 'delete'])!!}
                {!! Form::submit('回答の削除',['class' => 'btn btn-outline-danger']) !!}
            {!! Form::close() !!}
            <br>
            {{-- ----------  ログインユーザーとアンケート作成者が同じ場合 ---------- --}}
            @if (Auth::id() == $enquete->user_id)
                <div>
                    {{-- ---------- 「アンケート変更」ボタンを表示 ---------- --}}
                    {!! Form::open(['route'=>['enquetes.edit',$enquete->id], 'method' => 'get'])!!}
                        {!! Form::submit('アンケート変更',['class' => 'btn btn-outline-success']) !!}
                    {!! Form::close() !!}
                </div>
                <br>
                <div>
                    {{-- ---------- 「アンケート削除」ボタンを表示 ---------- --}}
                    {!! Form::open(['route'=>['enquetes.destroy',$enquete->id], 'method' => 'delete'])!!}
                        {!! Form::submit('アンケート削除',['class' => 'btn btn-outline-danger']) !!}
                    {!! Form::close() !!}
                </div>
            @endif
        </aside>
    </div>
@endsection