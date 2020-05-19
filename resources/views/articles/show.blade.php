@extends('layouts.app')
@section('title', ' - blogginlägg')
@section('content')
    <div class="container">
        <p><a href="/blog" class="btn btn-primary btn-sm">Visa alla blogginlägg</a></p>
        <h2>{{ $article->heading  }}</h2>
            <p>{!! $article->body !!}</p>
            <p>Publicerad: {{$article->updated_at->format('Y-m-d')}}</p>
    </div>
@endsection
