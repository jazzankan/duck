@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1>Blogginlägg</h1>
                <p><a href="/articles/create" class="btn btn-primary btn-sm">Nytt inlägg</a> <a href="/blog" class="btn btn-primary btn-sm">Publik blogg</a></p>
                <hr>
                <ul class="list-group striped-list">
                    @foreach ($articles as $art)
                        <li class="list-group-item"><h4><a href="/articles/{{ $art->id }}/edit">{{ $art->heading }}</a></h4>
                            Skapad: {{ $art->created_at->format('Y-m-d') }}<br>
                            @if($art->published === "yes")
                                <span class="published"><strong>Publicerad</strong></span>
                            @else
                                <span class="unpublished"><strong>Opublicerad</strong></span>
                            @endif</li>
                    @endforeach
                </ul>
                <p>
                    {{$articles->render()}}
                </p>
            </div>
            <div class="col-sm-4" style="background-color:#ffffcc">
                <h2>Blogganteckningar</h2>
                <p>5 senaste från "Minnesgrejer" med tag "bloggidéer".</p>
                @foreach ($blogideas as $bi)
                    <p><strong>{{$bi->title}}</strong><br>
                    {{$bi->description}}</p>
                    <hr>
                    @endforeach


            </div>
        </div>
    </div>
@endsection
