@extends('layouts.app')

@section('content')
    
    <h1>アンケート回答</h1>

    <div class="row">
        <div class="col-6">
            <br>
            <h3>タイトル：{!! $enquete->title !!}</h3>
            {!! Form::open(['route'=> ['answers.store',$enquete->id],'method' => 'post'])!!}
                <div class="form-group">
                    <h3>質問1</h3>
                    <h5><p>「{!! $enquete->question1 !!}」</p></h5>
                    <h6><p>{!! $select_message[0] !!}</p></h6>
                    <br>
                    @php $i = 0; @endphp
                    @foreach($choices_display[0] as $choices)
                        @if(! is_null($choices))
                            {!! Form::checkbox('choices_question1['.$i.']') !!}
                            {!! Form::label('choices_question1['.$i.']',$choices) !!}
                            <br>
                            @php $i = $i + 1; @endphp
                        @endif
                    @endforeach
                    <br>
                    @if ($enquete->question2 != null)
                        <h3>質問2</h3>
                        <h5><p>「{!! $enquete->question2 !!}」</p></h5>
                        <h6><p>{!! $select_message[1] !!}</p></h6>
                        <br>
                        @php $i = 0; @endphp
                        @foreach($choices_display[1] as $choices)
                            @if(! is_null($choices))
                                {!! Form::checkbox('choices_question2['.$i.']') !!}
                                {!! Form::label('choices_question2['.$i.']',$choices) !!}
                                <br>
                                @php $i = $i + 1; @endphp
                            @endif
                        @endforeach
                    @endif
                    <br>
                    @if ($enquete->question3 != null)
                        <h3>質問3</h3>
                        <h5><p>「{!! $enquete->question3 !!}」</p></h5>
                        <h6><p>{!! $select_message[2] !!}</p></h6>
                        <br>
                        @php $i = 0; @endphp
                        @foreach($choices_display[2] as $choices)
                            @if(! is_null($choices))
                                {!! Form::checkbox('choices_question3['.$i.']') !!}
                                {!! Form::label('choices_question3['.$i.']',$choices) !!}
                                <br>
                                @php $i = $i + 1; @endphp
                            @endif
                        @endforeach
                    @endif
                {!! Form::submit('回答',['class'=>'btn btn-primary'])!!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection