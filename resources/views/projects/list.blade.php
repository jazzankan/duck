@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mina projekt</h1>
        <ul class="list-group">
            @foreach ($projectlist as $project)
                <li class="list-group-item">{{ $project->title }}</li>
            @endforeach
        </ul>
    <div>
@endsection