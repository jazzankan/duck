@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @foreach($articles as $art)
                    <h2>{{$art->heading}}</h2>
                    <p>{!! $art->body !!}</p>
                    <p>Publicerad: {{$art->updated}}</p>
                    <hr>
                    @endforeach
            </div>
            <div class="col-sm-4" style="background-color:salmon">
                <h2>Nu är vi till höger</h2>
            </div>
        </div>
    </div>
@endsection
