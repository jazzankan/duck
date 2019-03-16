@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="/posts" class="btn btn-default">Tilbaka till listan</a></p>
        <h1>Mina projekt</h1>
        @if(count($projectlist) > 0)
        <ul class="list-group">
            @foreach ($projectlist as $project)
                <li class="list-group-item"><h4><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h4></li>
            @endforeach
        </ul>
        @else
            <h2>Du har inga projekt på gång.</h2>
        @endif
    </div>
@endsection