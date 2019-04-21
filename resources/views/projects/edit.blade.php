@extends('layouts.app')



@section('content')
    <div class="container">
        <h1>Redigera ett projekt</h1>
        <form method="post" action="/projects/{{ $project->id  }}">
            {{ method_field('PATCH') }}
            <div class="form-group">
                @csrf
                <label for="title">Namn:</label>
                <input type="text" class="form-control" value="{{ $project->title }}" name="title"/>
            </div>
            <div class="form-group">
                <label for="description">Beskrivning:</label>
                <textarea class="form-control" name="description">{{ $project->description }}</textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="date" id="date" value ="{{ ($project->deadline != null) ? $project->deadline : '' }}" />
                <label for="deadline">Deadline om det finns någon:</label>
                <template>
                    <div>
                        <date-picker v-model="time1" :lang="lang" :first-day-of-week="1"></date-picker>
                    </div>
                </template>
            </div>
            <div class="radio">
                <label><input type="radio" name="must" value="y" {{ ($project->must != 'n') ? 'checked' : '' }}>Plikt</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="must" {{ ($project->must === 'n') ? 'checked' : '' }} value="n">Hobby eller nöje</label>
            </div>
            <div>
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