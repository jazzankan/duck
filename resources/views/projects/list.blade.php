@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mina projekt</h1>
        <ul class="list-group">
            @foreach ($projectlist as $project)
                <li class="list-group-item"><h4><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h4></li>
            @endforeach
        </ul>
    <div>
@endsection