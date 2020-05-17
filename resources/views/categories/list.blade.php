@extends('layouts.app')
@section('content')
    <div class="container">
                <h1>Kategorivård - för bloggen</h1>
                <p><a href="/categories/create" class="btn btn-primary btn-sm">Ny kategori</a></p>
                <ul class="list-group striped-list">
                    @foreach ($categories as $cat)
                        <li class="list-group-item"><h4><a href="/categories/{{ $cat->id }}/edit">{{ $cat->name }}</a></h4>
                    @endforeach
                </ul>
            </div>
@endsection
