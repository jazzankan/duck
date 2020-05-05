@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @foreach($articles as $key => $art)
                    <h2><a href="#" v-on:click="toggleActive({{ $key }})">{{$art->heading}}</a></h2>
                    <div class="{{ $key }}" style="display:none;">{!! $art->body !!}</div>
                    <p>Kategori: {{ $art->catname }}</p>
                    <p>Publicerad: {{$art->updated_at->format('Y-m-d')}}</p>
                    <hr>
                    @endforeach
                    <p>
                        {{$articles->render()}}
                    </p>
            </div>
            <div class="col-sm-4">
                <h2>Kategorier</h2>
                <div>
                    <ul class="list-group">
                    @foreach($categories as $c)
                        <li class="list-group-item">{{ $c->name }}</li>
                    @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
