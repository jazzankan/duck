@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Arbetsuppgift i projektet {{ $taskProject->title }}</h1>
        <form method="post" action="{{ route('todos.store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                <label for="title">Uppgift:</label>
                <input type="text" class="form-control" value="{{ old('title') }}" name="title"/>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Detaljer:</label>
                <textarea class="form-control" name="details">{{ old('details')}}</textarea>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="deadline">Deadline om det finns:</label>
                    <input type="date" class="form-control" value="{{ old('deadline') != null ? old('deadline') : ''}}" name="date">
                </div>
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
            <div class="form-group row">
                <div class="col-sm-6">
                <label for="title">Ska utföras av:</label>
                <input type="text" class="form-control" value="{{ old('assigned') }}" name="assigned"/>
                </div>
            </div>
            <div>
                <input type="hidden" value="{{ $taskProject->id }}"  name="project_id"/>
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
