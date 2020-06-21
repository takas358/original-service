@extends('layouts.app')
@section('content')
    <h1>id: {{ $enquete->id }} のアンケート変更</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::open(['route' => ['enquetes.update', $enquete->id],'method'=>'put'])!!}
                <div class="form-group">
                    <h3>タイトル</h3>
                    {!! Form::text('title', $enquete->title, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <h3>質問1</h3>
                    {!! Form::text('question1', $enquete->question1, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
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
                            $choice_display[0][0], ['class' => 'form-control']) 
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
                            $choice_display[0][1], ['class' => 'form-control']) 
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('choice1_1', '選択肢1')!!}
                        {!! Form::text('choice1_1', $choice_display[0][2], ['class' => 'form-control']) !!}
                        {!! Form::label('choice1_2', '選択肢2')!!}
                        {!! Form::text('choice1_2', $choice_display[0][3], ['class' => 'form-control']) !!}
                        {!! Form::label('choice1_3', '選択肢3')!!}
                        {!! Form::text('choice1_3', $choice_display[0][4], ['class' => 'form-control']) !!}
                        {!! Form::label('choice1_4', '選択肢4')!!}
                        {!! Form::text('choice1_4', $choice_display[0][5], ['class' => 'form-control']) !!}
                        {!! Form::label('choice1_5', '選択肢5')!!}
                        {!! Form::text('choice1_5', $choice_display[0][6], ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <h3>質問2</h3>
                    {!! Form::text('question2', $enquete->question2, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
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
                            $choice_display[1][0], ['class' => 'form-control']) 
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
                            $choice_display[1][1], ['class' => 'form-control']) 
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('choice2_1', '選択肢1')!!}
                        {!! Form::text('choice2_1', $choice_display[1][2], ['class' => 'form-control']) !!}
                        {!! Form::label('choice2_2', '選択肢2')!!}
                        {!! Form::text('choice2_2', $choice_display[1][3], ['class' => 'form-control']) !!}
                        {!! Form::label('choice2_3', '選択肢3')!!}
                        {!! Form::text('choice2_3', $choice_display[1][4], ['class' => 'form-control']) !!}
                        {!! Form::label('choice2_4', '選択肢4')!!}
                        {!! Form::text('choice2_4', $choice_display[1][5], ['class' => 'form-control']) !!}
                        {!! Form::label('choice2_5', '選択肢5')!!}
                        {!! Form::text('choice2_5', $choice_display[1][6], ['class' => 'form-control']) !!}
                    </div>
                </div>
            
                <div class="form-group">
                    <h3>質問3</h3>
                    {!! Form::text('question3', $enquete->question3, ['class'=>'form-control']) !!}
                </div>
                                <div class="form-group">
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
                            $choice_display[2][0], ['class' => 'form-control']) 
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
                            $choice_display[2][1], ['class' => 'form-control']) 
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('choice3_1', '選択肢1')!!}
                        {!! Form::text('choice3_1', $choice_display[2][2], ['class' => 'form-control']) !!}
                        {!! Form::label('choice3_2', '選択肢2')!!}
                        {!! Form::text('choice3_2', $choice_display[2][3], ['class' => 'form-control']) !!}
                        {!! Form::label('choice3_3', '選択肢3')!!}
                        {!! Form::text('choice3_3', $choice_display[2][4], ['class' => 'form-control']) !!}
                        {!! Form::label('choice3_4', '選択肢4')!!}
                        {!! Form::text('choice3_4', $choice_display[2][5], ['class' => 'form-control']) !!}
                        {!! Form::label('choice3_5', '選択肢5')!!}
                        {!! Form::text('choice3_5', $choice_display[2][6], ['class' => 'form-control']) !!}
                    </div>
                </div>
                {!! Form::submit('更新',['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection