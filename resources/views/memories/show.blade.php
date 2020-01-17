@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="/memories" class="btn btn-primary btn-sm">Minneslistan</a> <a href="/memories/{{ $memory->id }}/edit" class="btn btn-primary btn-sm">Redigera minnet</a>
        <h2>{{ $memory->title  }}</h2>
        <p><strong>Beskrivning: </strong> {{ $memory-> description  }}</p>
        <p><strong>Källa: </strong> {{ $memory-> source  }}</p>
        <p><strong>Länk: </strong> {{ $memory-> link  }} </p>
        <p><strong>Viktighet: </strong> {{ $memory-> importance  }}</p>
        <p><strong>Taggar: </strong>...</p>

    </div>
@endsection
