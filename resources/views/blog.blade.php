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
                <form id="search" method="post" action="/blog">
                    @csrf
                <input type="text" value="{{ $searchterm }}" name="search"/> <button type="submit" class="btn btn-primary newmem">Sök</button>
                </form>
                <h2>Kategorier</h2>
                <div>
                    <ul class="list-group">
                       @if($requestcid)<li class="list-group-item"><a href="#" v-on:click="blogcatall()"><h5 id="allfat" @if($requestcid == "allcat")style = 'color:green;font-weight:600'@endif>Alla ({{ $allart }})</h5></a></li>@endif
                        <form id="showall" action="/blog">
                        <input type="hidden" id="allcat" name="cid" value="allcat">
                        </form>
                        @foreach($categories as $c)
                            <form id="c{{ $c->id }}" action="/blog">
                            <input type="hidden" name="cid" value="{{ $c->id }}">
                                <li class="list-group-item"><a href="#" v-on:click="blogcatcid('c{{ $c->id}}')"><h5 @if($requestcid == $c->id)style = 'color:green;font-weight:600'@endif>{{$c->name }} ({{$c->numcat }})</h5></a></li>
                            </form>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
