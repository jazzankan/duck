@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Redigera  <span class="todotitle">{{ $todo->title }}</span></h1>
        <h3>Arbetsuppgift i projektet {{ $project->title }}</h3>
        <form method="post" action="/todos/{{ $todo->id }}">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <div class="radio todostatus">
                    <label for="status">Status:</label><br>
                <label><input type="radio" name="status" value="n" {{ ($todo->status === 'n') ? 'checked' : '' }}> Ny </label>
                <label><input type="radio" name="status" value="o" {{ ($todo->status === 'o') ? 'checked' : '' }}> Pågående </label>
                <label><input type="radio" name="status" value="d" {{ ($todo->status === 'd') ? 'checked' : '' }}> Avklarad </label>
                </div>
                <label for="title">Uppgift:</label>
                <input type="text" class="form-control" value="{{ $todo->title }}" name="title"/>
            </div>
            <div class="form-group">
                <label for="description">Detaljer:</label>
                <textarea class="form-control" id="details" name="details">{!! $todo->details !!}</textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="date" id="date" value ="{{ ($todo->deadline != null) ? $todo->deadline : '' }}"/>
                <label for="deadline">Deadline om det finns någon:</label>
                <template>
                    <div>
                        <date-picker v-model="time1" :lang="lang" :first-day-of-week="1"></date-picker>
                    </div>
                </template>
            </div>
            <div class="radio">
                <label><input type="radio" name="priority" value="l" {{ ($todo->priority === 'l') ? 'checked' : '' }}> Lågprioriterad</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="priority" value="m" {{ ($todo->priority === 'm') ? 'checked' : '' }}> Medelprioriterad</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="priority"  value="h" {{ ($todo->priority === 'h') ? 'checked' : '' }}> Högprioriterad</label>
            </div>
            <div class="form-group">
                <label for="title">Ska utföras av:</label>
                <input type="text" class="form-control" value="{{ $todo->assigned }}" name="assigned"/>
            </div>
            <div class="delete">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="delete" name="delete" value="delete">
                    <label class="custom-control-label" for="delete">Ta bort arbetsuppgiften helt!</label>
                </div>
            </div>
            @if ($shared)
                <div class="mail">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="smail" name="smail" value="smail" checked="checked">
                            <label class="custom-control-label" for="smail">Skicka mail till dem  du delar projektet med.</label>
                        </div>
                    </div>
            </div>
            @endif
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <button type="submit" class="btn btn-primary btop">Uppdatera</button>
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
