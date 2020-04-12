@if (Auth::user()->is_favorite($enquete->id))
    {!! Form::open(['route' => ['favorites.unfavorite', $enquete->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfavorite', ['class' => "btn btn-outline-danger btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['favorites.favorite', $enquete->id]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-outline-primary btn-sm"]) !!}
    {!! Form::close() !!}
@endif