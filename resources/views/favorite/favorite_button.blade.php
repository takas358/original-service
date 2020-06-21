@if (Auth::user()->is_favorite($enquete->id))
    {!! Form::open(['route' => ['favorites.unfavorite', $enquete->id], 'method' => 'delete']) !!}
        {!! Form::submit('×♡', ['class' => "btn btn-outline-secondary btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['favorites.favorite', $enquete->id]]) !!}
        {!! Form::submit('♡', ['class' => "btn btn-outline-primary btn-sm"]) !!}
    {!! Form::close() !!}
@endif