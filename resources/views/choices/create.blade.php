@extends('layouts.app')

@section('content')

    <h1>アンケート新規作成ページ(2/2)</h1>
    <h2>~回答選択肢の設定~</h2>
    <br>
    <div class="row">
        <div class="col-6">

            {!! Form::open(['route'=> ['choices.store',$enquete->id],'method' => 'post'])!!}
                <div class="form-group">
                    <h3>質問1</h3>
                    <h5><p>「{!! $enquete->question1 !!}」</p></h5>
                    <div class ="form-inline">
                        {!! Form::label('min_select1', '最小選択数')!!}
                        {!! Form::select('min_select1',
                                ['' => '選択してください', 
                                '1' => 1,
                                '2' => 2,
                                '3' => 3,
                                '4' => 4,
                                '5' => 5,
                                ],
                            null, ['class' => 'form-control']) 
                        !!}
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::label('max_select1', '最大選択数')!!}
                        {!! Form::select('max_select1',
                                ['' => '選択してください', 
                                '1' => 1,
                                '2' => 2,
                                '3' => 3,
                                '4' => 4,
                                '5' => 5,
                                ],
                            null, ['class' => 'form-control']) 
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('choice1_1', '選択肢1')!!}
                        {!! Form::text('choice1_1', old('choice1'), ['class' => 'form-control']) !!}
                        {!! Form::label('choice1_2', '選択肢2')!!}
                        {!! Form::text('choice1_2', old('choice2'), ['class' => 'form-control']) !!}
                        {!! Form::label('choice1_3', '選択肢3')!!}
                        {!! Form::text('choice1_3', old('choice3'), ['class' => 'form-control']) !!}
                        {!! Form::label('choice1_4', '選択肢4')!!}
                        {!! Form::text('choice1_4', old('choice4'), ['class' => 'form-control']) !!}
                        {!! Form::label('choice1_5', '選択肢5')!!}
                        {!! Form::text('choice1_5', old('choice5'), ['class' => 'form-control']) !!}
                    </div>
                </div>

            @if ($enquete->question2 != null)
                {!! Form::open(['route'=> ['choices.store',$enquete->id],'method' => 'post'])!!}
                    <div class="form-group">
                        <h3>質問2</h3>
                        <h5><p>「{!! $enquete->question2 !!}」</p></h5>
                        <div class ="form-inline">
                            {!! Form::label('min_select2', '最小選択数')!!}
                            {!! Form::select('min_select2',
                                    ['' => '選択してください', 
                                    '1' => 1,
                                    '2' => 2,
                                    '3' => 3,
                                    '4' => 4,
                                    '5' => 5,
                                    ],
                                null, ['class' => 'form-control']) 
                            !!}
                            &nbsp;&nbsp;&nbsp;
                            {!! Form::label('max_select2', '最大選択数')!!}
                            {!! Form::select('max_select2',
                                    ['' => '選択してください', 
                                    '1' => 1,
                                    '2' => 2,
                                    '3' => 3,
                                    '4' => 4,
                                    '5' => 5,
                                    ],
                                null, ['class' => 'form-control']) 
                            !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('choice2_1', '選択肢1')!!}
                            {!! Form::text('choice2_1', old('choice1'), ['class' => 'form-control']) !!}
                            {!! Form::label('choice2_2', '選択肢2')!!}
                            {!! Form::text('choice2_2', old('choice2'), ['class' => 'form-control']) !!}
                            {!! Form::label('choice2_3', '選択肢3')!!}
                            {!! Form::text('choice2_3', old('choice3'), ['class' => 'form-control']) !!}
                            {!! Form::label('choice2_4', '選択肢4')!!}
                            {!! Form::text('choice2_4', old('choice4'), ['class' => 'form-control']) !!}
                            {!! Form::label('choice2_5', '選択肢5')!!}
                            {!! Form::text('choice2_5', old('choice5'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
            @endif

            @if ($enquete->question3 != null)
                {!! Form::open(['route'=> ['choices.store',$enquete->id],'method' => 'post'])!!}
                    <div class="form-group">
                        <h3>質問3</h3>
                        <h5><p>「{!! $enquete->question3 !!}」</p></h5>
                        <div class ="form-inline">
                            {!! Form::label('min_select3', '最小選択数')!!}
                            {!! Form::select('min_select3',
                                    ['' => '選択してください', 
                                    '1' => 1,
                                    '2' => 2,
                                    '3' => 3,
                                    '4' => 4,
                                    '5' => 5,
                                    ],
                                null, ['class' => 'form-control']) 
                            !!}
                            &nbsp;&nbsp;&nbsp;
                            {!! Form::label('max_select3', '最大選択数')!!}
                            {!! Form::select('max_select3',
                                    ['' => '選択してください', 
                                    '1' => 1,
                                    '2' => 2,
                                    '3' => 3,
                                    '4' => 4,
                                    '5' => 5,
                                    ],
                                null, ['class' => 'form-control']) 
                            !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('choice3_1', '選択肢1')!!}
                            {!! Form::text('choice3_1', old('choice1'), ['class' => 'form-control']) !!}
                            {!! Form::label('choice3_2', '選択肢2')!!}
                            {!! Form::text('choice3_2', old('choice2'), ['class' => 'form-control']) !!}
                            {!! Form::label('choice3_3', '選択肢3')!!}
                            {!! Form::text('choice3_3', old('choice3'), ['class' => 'form-control']) !!}
                            {!! Form::label('choice3_4', '選択肢4')!!}
                            {!! Form::text('choice3_4', old('choice4'), ['class' => 'form-control']) !!}
                            {!! Form::label('choice3_5', '選択肢5')!!}
                            {!! Form::text('choice3_5', old('choice5'), ['class' => 'form-control']) !!}
                        </div>
                    </div>

            @endif

            {!! Form::submit('送信',['class'=>'btn btn-primary'])!!}
            {!! Form::close() !!}

        </div>
    </div>
@endsection