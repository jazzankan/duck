@extends('layouts.app')
@section('title', ' - blogginlägg')
@section('content')
    <div class="container">
        <p><a href="/blog" class="btn btn-primary btn-sm">Visa alla blogginlägg</a></p>
        <h2>{{ $article->heading  }}</h2>
            <p>{!! $article->body !!}</p>
        @if(count($article->comments) > 0)<p>Kommentarer:</p>
        @foreach($article->comments as $com)
            @if($com->published === "yes")
            <p><span class="commentbody">{{ $com->body }}</span><br><b>{{ $com->name }}</b></p>
            @endif
        @endforeach
        @endif
            <p>Publicerad: {{$article->updated_at->format('Y-m-d')}}</p>
    </div>
@endsection
