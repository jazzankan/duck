@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kommentera projektet ...</h1>
        <form method="post" action="{{ route('projcomments.store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-8">
                    <label for="name">Jag vill bara säga:</label>
                    <input type="text" class="form-control" value="{{ old('body') }}" name="body"/>
                </div>
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
