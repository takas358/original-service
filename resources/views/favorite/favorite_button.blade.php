@if (Auth::user()->is_favorite($enquete->id))
    {!! Form::open(['route' => ['favorites.unfavorite', $enquete->id], 'method' => 'delete']) !!}
        {!! Form::submit('お気に入り解除', ['class' => "btn btn-outline-secondary"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['favorites.favorite', $enquete->id]]) !!}
        {!! Form::submit('お気に入り登録', ['class' => "btn btn-outline-primary"]) !!}
    {!! Form::close() !!}
@endif