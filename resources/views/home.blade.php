@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><img src="https://webbsallad.se/ankfiles/redduck100.png"> Duckboard</div>
                <div class="card-body">
                    <h4><a href="/memories">Minnen</a></h4>
                    <hr>
                    <h5>Projekt</h5>
                    <p><a href="/projects">Mina projekt</a></p>
                    <p><a href="/todos">Ofärdiga arbetsuppgifter</a></p>
                    <hr>
                    <h5>Blogg</h5>
                    <p><a href="/blog">Publik blogg</a></p>
                    <p><a href="/articles">Blogginlägg</a> - skapa och redigera</p>
                    <p><a href="/comments">Nya bloggkommentarer</a></p>
                    <p><a href="/categories">Bloggkategorier</a> - skapa och redigera</p>
                    <p><a href="/about">Om Ankhemmet</a> - lite info för bloggbesökare</p>
                    <p>Externa visningar: <b>{{ $visitingnumber }}</b>, sedan 2020-09-21</p>
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Du är inloggad!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
