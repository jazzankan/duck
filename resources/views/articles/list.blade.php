@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1>Blogginlägg</h1>
                <p><a href="/articles/create" class="btn btn-primary btn-sm">Nytt inlägg</a></p>
                <hr>
                <ul class="list-group striped-list">
                    @foreach ($articles as $art)
                        <li class="list-group-item"><h4><a href="/articles/{{ $art->id }}">{{ $art->heading }}</a></h4></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-4" style="background-color:salmon">
                <h2>Nu är vi till höger</h2>
            </div>
        </div>
    </div>
@endsection
