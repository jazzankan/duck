@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="/projects" class="btn btn-primary btn-sm">Tillbaka till projektlistan</a> <a href="/projects/{{ $project->id }}/edit" class="btn btn-primary btn-sm">Redigera projektet</a></p>
        <h1>{{ $project->title }}</h1>
        <hr>
        <p><span class="font-weight-bold">Beskrivning:</span><br>
        {{ $project->description }}</p>
        <p><span class="font-weight-bold">Deadline:</span> {{ $project->deadline }}</p>
        @if(count($sharing) > 0)
        <p>
        <ul class="sharing">
            <li class="list-inline-item font-weight-bold">Projektet delas med: </li>
            @foreach($sharing as $s)
                    <li class="list-inline-item">{{ $s }}</li>
                    @endforeach
            </ul>
        </p>
        @endif
        <hr>
            <div class="todos">
                <h3>Arbetsuppgifter</h3>
                <a href="{{ route('newtask', ['projectid' => $project->id])}}" class="btn btn-primary btn-sm">Skapa arbetsuppgift</a>
            </div>

        </div>
@endsection