@extends('layouts.app')
@section('content')
    <div class="container">
        @if(count($memories) > 0)
            <h1>Minnen</h1>
            <form class="form-inline" method="post" action="{{ route('memories.store') }}">
                @csrf
            <a href="/memories/create" class="btn btn-primary btn-sm newmem">Nytt minne</a>
                <input type="text" class="form-control newmembox" value="{{ old('search') }}" name="search"/> <button type="submit" class="btn btn-primary newmem">Sök</button>
                <a href="#" v-on:click="filter = true"><b>Filtrera</b></a>
            </form>
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

