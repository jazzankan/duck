@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Skapa ett projekt</h1>
        <form method="post" action="{{ route('projects.store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                <label for="title">Namn:</label>
                <input type="text" class="form-control" value="{{ old('title') }}" name="title"/>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Beskrivning:</label>
                <textarea class="form-control" id="description" name="description">{!! old('description') !!}</textarea>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="deadline">Deadline om det finns:</label>
                    <input type="date" class="form-control" value="{{ old('deadline') != null ? old('deadline') : ''}}" name="date">
                </div>
            </div>
            <div class="radio">
                <label><input type="radio" name="must" value="y" {{ (old('must') === 'n') ? '' : 'checked' }}>Plikt</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="must" {{ (old('must') === 'n') ? 'checked' : '' }} value="n">Hobby eller nöje</label>
            </div>
            <div>
            </div>
            <div class="form-group">
                Dela projektet med:<br>
                <select multiple name="selshare[]">
                    @foreach($usernames as $s)
                            <option value ="{{ $s }}">{{ $s }}</option>
                    @endforeach
                </select>
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
@section('scripts')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        function ckreplace() {
            CKEDITOR.replace('description');
        }
        window.onload=ckreplace;
    </script>
@endsection
