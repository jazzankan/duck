@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($visibleproj) > 0)
            <h1>Mina projekt</h1>
            <p><a href="/projects/create" class="btn btn-primary btn-sm">Nytt projekt</a></p>
        <ul class="list-group">
            @foreach ($visibleproj as $project)
                <li class="list-group-item"><h4><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h4></li>
            @endforeach
        </ul>
        @else
            <h2>Du har inga projekt på gång.</h2>
        @endif
    </div>
@endsection