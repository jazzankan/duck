@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Nya bloggkommentarer</h1>
        <ul class="list-group striped-list">
            @foreach ($comments as $comment)
                <li class="list-group-item"><a href="/comments/{{ $comment->id }}/edit"><strong>Kommentar:</strong></a> {{ $comment->body }}<br>
                    <strong>Hör till inlägget "{{ $comment->belongart['heading'] }}". Kommentaren skapad {{ $comment->created_at }}.  @if($comment->wishpublic ==='yes') <span class="redalert">Vill ha publicerad!</span> @endif </strong></li>
            @endforeach
        </ul>
    </div>
@endsection
