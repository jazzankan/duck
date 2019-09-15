@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Redigera  <span class="todotitle">{{ $todo->title }}</span></h1>
        <h3>Arbetsuppgift i projektet {{ $project->title }}</h3>
        <form method="post" action="/todos/{{ $todo->id  }}">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="title">Uppgift:</label>
                <input type="text" class="form-control" value="{{ old('title') }}" name="title"/>
            </div>
            <div class="form-group">
                <label for="description">Detaljer:</label>
                <textarea class="form-control" name="details">{{ old('details')}}</textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="date" id="date" value ="{{ old('deadline') != null ? old('deadline') : ''}}"/>
                <label for="deadline">Deadline om det finns någon:</label>
                <template>
                    <div>
                        <date-picker v-model="time1" :lang="lang" :first-day-of-week="1"></date-picker>
                    </div>
                </template>
            </div>
            <div class="radio">
                <label><input type="radio" name="priority" value="l" {{ (old('priority') === 'l') ? 'checked' : '' }}> Lågprioriterad</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="priority" value="m" {{ (old('priority') === 'l' || old('prio') === 'h') ? '' : 'checked' }}> Medelprioriterad</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="priority"  value="h" {{ (old('priority') === 'h') ? 'checked' : '' }}> Högprioriterad</label>
            </div>
            <div class="form-group">
                <label for="title">Ska utföras av:</label>
                <input type="text" class="form-control" value="{{ old('assigned') }}" name="assigned"/>
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
