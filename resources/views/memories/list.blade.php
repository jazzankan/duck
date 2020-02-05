@extends('layouts.app')
@section('content')
    <div class="container">
        @if(count($memories) > 0)
            <h1>Mina minnesvärda saker</h1>
            <p><a href="/memories/create" class="btn btn-primary btn-sm">Nytt minne</a></p>
            <ul class="list-group striped-list">
                @foreach ($memories as $memory)
                    <li class="list-group-item"><h4><a href="/memories/{{ $memory->id }}">{{ $memory->title }}</a></h4></li>
                @endforeach
            </ul>
            <p>
            {{$memories->render()}}
            </p>
        @else
            <h2>Det finns inget...</h2>
            <p><a href="/memories/create" class="btn btn-primary btn-sm">Nytt minne</a></p>
        @endif
    </div>
@endsection

