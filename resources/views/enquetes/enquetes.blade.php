<ul class="list-unstyled">
    @foreach ($enquetes as $enquete)
        <li class="media mb-3">
            <div class="media-body">
                <div>
                    <p class="mb-0"><b>{!! nl2br(e($enquete->title)) !!}</b></p>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($enquete->question1)) !!}・・・</p>
                </div>
                <div class="row">
                    <div>
                        {!! Form::open(['route'=>['enquetes.show',$enquete->id], 'method' => 'get'])!!}
                            {!! Form::submit('詳細',['class' => 'btn btn-outline-success btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div>
                        {!! Form::open(['route'=>['enquetes.edit',$enquete->id], 'method' => 'get'])!!}
                            {!! Form::submit('変更',['class' => 'btn btn-outline-success btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div>
                        {!! Form::open(['route'=>['answers.create',$enquete->id], 'method' => 'get'])!!}
                            {!! Form::submit('回答',['class' => 'btn btn-outline-success btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div>
                        @if (Auth::id() == $enquete->user_id)
                            {!! Form::open(['route'=>['enquetes.destroy',$enquete->id], 'method' => 'delete'])!!}
                                {!! Form::submit('削除',['class' => 'btn btn-outline-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{!! $enquetes->links('pagination::bootstrap-4')!!}