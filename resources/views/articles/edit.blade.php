@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Redigera artikeln <span class="projtitel">{{ $article->heading }}</span></h1>
        <form method="post" action="/articles/{{ $article->id }}">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="heading">Rubrik:</label>
                    <input type="text" class="form-control" value="{{ $article->heading }}" name="heading"/>
                </div>
            </div>
            <div class="form-group">
                <label for="body">Brödtext:</label>
                <textarea class="form-control" id="body" name="body">{!! $article->body !!}</textarea>
            </div>
            <div class="form-group">
                Kategorier:<br>
                <select name="category_id">
                    @foreach($categories as $c)
                        @if($article->category_id === $c['id']))
                            <option value ="{{ $c['id'] }}" selected>{{ $c['name'] }}</option>
                        @else
                            <option value ="{{ $c['id'] }}">{{ $c['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="radio">
                <label><input type="radio" name="published" value="no" {{ ($article->published === 'no') ? 'checked' : '' }}> Opublicerad</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="published" {{ ($article->published === 'yes') ? 'checked' : '' }} value="yes"> Publicerad</label>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="delete" name="delete" value="delete">
                    <label class="custom-control-label" for="delete">Ta bort inlägget för gott.</label>
                </div>
            </div>
            <div>
            </div>
            <button type="submit" class="btn btn-primary">Skicka</button>
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
            CKEDITOR.replace('body');
        }
        window.onload=ckreplace;
    </script>
@endsection
