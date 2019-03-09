@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $project->title }}</h1>
        <hr>
        <p><span class="font-weight-bold">Beskrivning:</span><br>
        {{ $project->description }}</p>
        <p><span class="font-weight-bold">Deadline:</span> {{ $project->deadline }}</p>
        <div>
@endsection