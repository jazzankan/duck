@extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Skapa ett projekt</h1>
        <form method="post" action="{{ route('projects.store') }}">
            <div class="form-group">
                @csrf
                <label for="title">Namn:</label>
                <input type="text" class="form-control" name="title"/>
            </div>
            <div class="form-group">
                <label for="description">Beskrivning:</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline om det finns någon:</label>
                <template>
                    <div>
                        <date-picker v-model="time1" :lang="lang" :first-day-of-week="1"></date-picker>
                    </div>
                </template>
            </div>
            <div class="radio">
                <label><input type="radio" name="must" value="y" checked>Plikt</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="must" value="n">Hobby eller nöje</label>
            </div>
            <button type="submit" class="btn btn-primary">Skapa</button>
        </form>
        </div>
    <div>
        <p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </p>
    </div>
@endsection