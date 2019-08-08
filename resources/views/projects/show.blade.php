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
                <div>
                <h3>Arbetsuppgifter</h3>
                <p>
                    <a href="{{ route('newtask', ['projectid' => $project->id])}}" class="btn btn-primary btn-sm">Skapa arbetsuppgift</a>
                </p>
                </div>
                <div class="todolist">
                    @if($belongingtodos->isNotEmpty())
                    <ul class="list-group">
                        @foreach ($belongingtodos as $todo)
                            <li class="list-group-item"><a class="todolink" href="/todos/{{ $todo->id }}">{{ $todo->title }}</a><span class="todoline"><span class="deadline"> Deadline: {{ $todo->deadline }}, </span><span class="details"><a href="#"> Detaljer</a>, </span><span class="priority"> Prio: {{ $todo->priority }}, </span><span class="status"> Status: {{ $todo->status }}</span>{{$todo->assigned}}</span></li>
                        @endforeach
                     @endif
                    </ul>
                </div>
            </div>

        </div>
@endsection
