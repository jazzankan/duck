@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Redigera projektet <span class="projtitel">{{ $project->title }}</span></h1>
        <form method="post" action="/projects/{{ $project->id  }}">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                <label for="title">Namn:</label>
                <input type="text" class="form-control" value="{{ $project->title }}" name="title"/>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Beskrivning:</label>
                <textarea class="form-control" name="description" id="description">{!! $project->description !!}</textarea>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                <label for="deadline">Deadline om det finns:</label>
                <input type="date" class="form-control" value="{{ ($project->deadline != null) ? $project->deadline : '' }}" name="date">
                </div>
            </div>
            <div class="form-group">
            <div class="radio">
                <label><input type="radio" name="must" value="y" {{ ($project->must != 'n') ? 'checked' : '' }}>Plikt</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="must" {{ ($project->must === 'n') ? 'checked' : '' }} value="n">Hobby eller nöje</label>
            </div>
            </div>
            <div class="form-group">
                Dela projektet med:<br>
                <select multiple name="selshare[]">
                    @foreach($usernames as $s)
                        @if(in_array( $s, $sharing))
                        <option value ="{{ $s }}" selected>{{ $s }}</option>
                        @else
                            <option value ="{{ $s }}">{{ $s }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="visible" name="visible" value="n">
                <label class="custom-control-label" for="visible">Arkivera projektet. Det syns då inte längre i den vanliga projektlistan.</label>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="delete" name="delete" value="delete">
                    <label class="custom-control-label" for="delete">Ta bort projektet för gott. All tillhörande data tas bort!</label>
                </div>
            </div>
            <div class="mail" v-if="getSelshare()">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="sendmail" name="sendmail" value="sendmail" checked="checked">
                        <label class="custom-control-label" for="sendmail">Skicka mail till dem  du delar projektet med.</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Spara</button>
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
