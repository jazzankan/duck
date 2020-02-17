@extends('layouts.app')
@section('title', ' - ett minne')
@section('content')
    <div class="container">
        <p><a href="/memories" class="btn btn-primary btn-sm">Minneslistan</a> <a href="/memories/{{ $memory->id }}/edit" class="btn btn-primary btn-sm">Redigera minnet</a> <a href="/memupload/{{ $memory->id }}" class="btn btn-primary btn-sm">Ladda upp fil</a>
        <h2>{{ $memory->title  }}</h2>
        @if($memory->description != null)
        <p><strong>Beskrivning: </strong> {!! nl2br(e($memory->description)) !!}</p>
        @endif
        @if($memory->source != null)
        <p><strong>Källa: </strong> {{ $memory->source  }}</p>
        @endif
        @if($memory->link != null)
        <p><strong>Länk: </strong> <a href="{{ $memory-> link  }}" target="_blank">{{ $memory-> link  }}</a></p>
        @endif
        <p><strong>Viktighet: </strong> {{ $memory-> importance  }}</p>
        <p><strong>Skapat: </strong> {{ $memory-> created_at  }}</p>
        @if($memory->updated_at != null && $memory->updated_at != $memory->created_at)
        <p><strong>Senast ändrat: </strong> {{ $memory-> updated_at  }}</p>
        @endif
        <p><strong>Taggar: </strong>@foreach($tags as $tag) {{ $tag->name }}&nbsp;@endforeach</p>
        @if(count($belongingfiles) > 0)
            <ul class="list-group-horizontal nomargin">
                <li class="list-inline-item font-weight-bold nomargin">Tillhörande filer: </li>
                @foreach($belongingfiles as $f)
                    <li class="list-inline-item"><a href="https://ank.webbsallad.se/storage/files/{{ $f->filename }}" target="_blank">{{ $f->filename }}</a></li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
