@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Nya bloggkommentarer</h1>
        <ul class="list-group striped-list">
            @foreach ($comments as $comment)
                <li class="list-group-item"><h4><a href="/categories/{{ $comment->id }}/edit">{{ $comment->body }}</a></h4>
            @endforeach
        </ul>
    </div>
@endsection
