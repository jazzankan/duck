@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <p><a href="/projects">Projekt</a></p>
                    <p><a href="/todos">Ofärdiga arbetsuppgifter</a></p>
                    <p><a href="/memories">Minnesgrejer</a></p>
                    <p><a href="/blog">Publik blogg</a></p>
                    <p><a href="/articles">Blogginlägg</a> - skapa och redigera</p>
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
