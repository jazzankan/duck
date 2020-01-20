@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="/memories" class="btn btn-primary btn-sm">Minneslistan</a> <a href="/memories/{{ $memory->id }}/edit" class="btn btn-primary btn-sm">Redigera minnet</a>
        <h2>{{ $memory->title  }}</h2>
        @if($memory->description != null)
        <p><strong>Beskrivning: </strong> {{ $memory-> description  }}</p>
        @endif
        @if($memory->source != null)
        <p><strong>Källa: </strong> {{ $memory-> source  }}</p>
        @endif
        @if($memory->link != null)
        <p><strong>Länk: </strong> <a href="{{ $memory-> link  }}" target="_blank">{{ $memory-> link  }}</a></p>
        @endif
        <p><strong>Viktighet: </strong> {{ $memory-> importance  }}</p>
        <p><strong>Skapat: </strong> {{ $memory-> created_at  }}</p>
        @if($memory->updated_at != null && $memory->updated_at != $memory->created_at)
        <p><strong>Senast ändrat: </strong> {{ $memory-> updated_at  }}</p>
        @endif
        <p><strong>Taggar: </strong>...</p>

    </div>
@endsection
