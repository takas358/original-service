@extends('layouts.app')

@section('content')
    <h1>アンケートID: {{ $enquete->id}} の詳細</h1>
    
    <div class="row">
        <div class="col-9">
            <table class="table table-bordered success">
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
                    <th>回答数</th> 
                    <td>{{ $response_count }}</td>
                </tr>
                <tr>
                    <th>
                        <p>質問1</p>
                        <br>
                        <p>&ensp;回答</p>
                    </th>
                    <td>
                        @if ($enquete->question1 != null)
                            <p>{{ $enquete->question1 }}</p>
                            <p>{{ $select_message[0] }}</p>
                        @else
                            <p class="text-secondary">未設定</p>
                        @endif
                        @if ( $answer_exists[0] == "1")
                            <table class="table-responsive">
                                <tr>
                                    <th class="text-center">選択肢</th>
                                    <th class="text-center">選択数</th>
                                    <th class="text-center">構成比</th>
                                </tr>
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
                                <tr>
                                    <th class="text-center">全体選択数</th>
                                    <td class="text-right">{{ $answer_count[0][5] }}</td>
                                </tr>
                            </table>
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
                        @if ($enquete->question2 != null)
                            <p>{{ $enquete->question2 }}</p>
                            <p>{{ $select_message[1] }}</p>
                        @else
                            <p class="text-secondary">未設定</p>
                        @endif
                        @if ( $answer_exists[1] == "1")
                            <table class="table-responsive">
                                <tr>
                                    <th class="text-center">選択肢</th>
                                    <th class="text-center">選択数</th>
                                    <th class="text-center">構成比</th>
                                </tr>
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
                                <tr>
                                    <th class="text-center">全体選択数</th>
                                    <td class="text-right">{{ $answer_count[1][5] }}</td>
                                </tr>
                            </table>
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
                        @if ($enquete->question3 != null)
                            <p>{{ $enquete->question3 }}</p>
                            <p>{{ $select_message[2] }}</p>
                        @else
                            <p class="text-secondary">未設定</p>
                        @endif
                        @if ( $answer_exists[2] == "1")
                            <table class="table-responsive">
                                <tr>
                                    <th class="text-center">選択肢</th>
                                    <th class="text-center">選択数</th>
                                    <th class="text-center">構成比</th>
                                </tr>
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
                                <tr>
                                    <th class="text-center">全体選択数</th>
                                    <td class="text-right">{{ $answer_count[2][5] }}</td>
                                </tr>
                            </table>
                        @else
                            <p class="text-secondary">&ensp;{{ $answer_nothing[2] }}</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <aside class="col-sm-1">
            @include('favorite.favorite_button', ['enquete' =>$enquete ])
            <br>
            {!! Form::open(['route'=>['answers.create',$enquete->id], 'method' => 'get'])!!}
                {!! Form::submit('アンケート回答',['class' => 'btn btn-outline-success']) !!}
            {!! Form::close() !!}
            <br>
            {{--
            {! Form::open(['route'=>['answers.create',$enquete->id], 'method' => 'get'])!!}
                {!! Form::submit('回答の変更',['class' => 'btn btn-outline-success']) !!}
            {!! Form::close() !!}
            <br>
            --}}
            {!! Form::open(['route'=>['answers.delete',$enquete->id], 'method' => 'delete'])!!}
                {!! Form::submit('回答の削除',['class' => 'btn btn-outline-danger']) !!}
            {!! Form::close() !!}
            <br>
            @if (Auth::id() == $enquete->user_id)
                <div>
                    {!! Form::open(['route'=>['enquetes.edit',$enquete->id], 'method' => 'get'])!!}
                        {!! Form::submit('アンケート変更',['class' => 'btn btn-outline-success']) !!}
                    {!! Form::close() !!}
                </div>
                <br>
                <div>
                    {!! Form::open(['route'=>['enquetes.destroy',$enquete->id], 'method' => 'delete'])!!}
                        {!! Form::submit('アンケート削除',['class' => 'btn btn-outline-danger']) !!}
                    {!! Form::close() !!}
                </div>
            @endif
        </aside>
    </div>
@endsection