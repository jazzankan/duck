@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Skapa ett blogginlägg</h1>
        <form method="post" action="{{ route('articles.store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="heading">Rubrik:</label>
                    <input type="text" class="form-control" value="{{ old('heading') }}" name="heading"/>
                </div>
            </div>
            <div class="form-group">
                <label for="body">Brödtext:</label>
                <textarea class="form-control" id="body" name="body">{!! old('body') !!}</textarea>
            </div>
            <div class="form-group">
                Kategorier:<br>
                <select name="category_id">
                    <option value ="" selected>Välj:</option>
                    @foreach($categories as $c)
                        <option value ="{{ $c['id'] }}">{{ $c['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="radio">
                <label><input type="radio" name="published" value="no" checked="checked"> Opublicerad</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="published" value="yes"> Publicerad</label>
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
@section('scripts')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        function ckreplace() {
            CKEDITOR.replace('body');
        }
        window.onload=ckreplace;
    </script>
@endsection
