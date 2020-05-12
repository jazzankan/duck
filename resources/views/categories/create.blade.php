@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Skapa en ny kategori</h1>
        <form method="post" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="name">Namn:</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"/>
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
