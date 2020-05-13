@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Döp om kategori</h1>
        <form method="post" action="/categories/{{ $category->id }}">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="name">Namn:</label>
                    <input type="text" class="form-control" value="{{ $category->name }}" name="name"/>
                </div>
            </div>
            @if($articlenum < 1)<div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="delete" name="delete" value="delete">
                    <label class="custom-control-label" for="delete">Ta bort kategorin. Ingen artikel använder den.</label>
                </div>
            </div>@endif
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
