@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detaljer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Här ska själva detaljerna synas...
                </div>
            </div>
        </div>
    </div>
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
                    <ul class="list-group striped-list">
                        <li class="list-group-item"><h5>Ogjort</h5></li>
                        @foreach ($belongingtodos as $todo)
                            @if($todo->status === 'n')
                                <li class="list-group-item"><a class="todolink" href="/todos/{{ $todo->id }}">{{ $todo->title }}</a><span class="todoline"><span class="deadline"> Deadline: <b>{{ $todo->deadline }}</b>&nbsp;&nbsp;</span><span class="priority"><b>{{ $todo->priority }}</b></span>&nbsp;&nbsp;<span class="assigned"><b>{{$todo->assigned}}</b></span>&nbsp;&nbsp;<span class="details">{!! $todo->details !!}</span></li>
                            @endif
                            @endforeach
                     @endif
                    </ul>
                </div>
            </div>

        </div>
@endsection
