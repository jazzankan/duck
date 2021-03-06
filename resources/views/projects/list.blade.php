@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($visibleproj) > 0)
            <h1>Mina projekt</h1>
            <p><a href="/projects/create" class="btn btn-primary btn-sm">Nytt projekt</a> @if(!$archived)<a class="btn btn-secondary btn-sm"href="/projects?arkiv=y">Arkiverade projekt</a>@endif</p>
        <ul class="list-group striped-list">
            @foreach ($visibleproj as $project)
                <li class="list-group-item"><h4><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h4> <span class="must">@if($archived)<b>ARKIVERAT PROJEKT!</b><br>@endif</span><span class="must">@if($project['must']=='y')Plikt!<br>@endif</span> @if($project['deadline']) Deadline: <span @if($project['deadline'] <= $today)class="redalert"@endif>{{ $project->deadline }}</span>@endif<br>@if($project['late'])<span class="redalert">Det finns minst en försenad arbetsuppgift!</span>@endif</li>
            @endforeach
        </ul>
        @else
            <h2>Du har inga projekt på gång.</h2>
            <p><a href="/projects/create" class="btn btn-primary btn-sm">Nytt projekt</a></p>
        @endif
    </div>
@endsection
