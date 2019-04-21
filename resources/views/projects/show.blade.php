@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="/projects" class="btn btn-primary">Tilbaka till listan</a></p>
        <h1>{{ $project->title }}</h1>
        <hr>
        <p><span class="font-weight-bold">Beskrivning:</span><br>
        {{ $project->description }}</p>
        <p><span class="font-weight-bold">Deadline:</span> {{ $project->deadline }}</p>
        </div>
@endsection