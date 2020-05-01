@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @foreach($articles as $key => $art)
                    <h2><a href="#" v-on:click="toggleActive({{ $key }})">{{$art->heading}}</a></h2>
                    <div class="{{ $key }}" style="display:none;">{!! $art->body !!}</div>
                    <p>Kategori: {{ $art->category_id }}</p>
                    <p>Publicerad: {{$art->updated_at->format('Y-m-d')}}</p>
                    <hr>
                    @endforeach
                    <p>
                        {{$articles->render()}}
                    </p>
            </div>
            <div class="col-sm-4" style="background-color:salmon">
                <h2>Nu är vi till höger</h2>
            </div>
        </div>
    </div>
@endsection
