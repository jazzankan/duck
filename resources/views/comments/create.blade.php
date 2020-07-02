@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Hej! Tack för att du vill kommentera inlägget <strong>"{{ $article->heading }}"</strong></h3>
        <p>Ankhemmet intar en milt asocial attityd. Följande gäller:</p>
        <ul>
            <li>Du måste ange en giltig e-postadress!</li>
            <li>Din e-postadress publiceras <strong>aldrig</strong> om du inte själv skriver in den i själva kommentarstexten.</li>
            <li>Du kan välja om du bara vill höra av dig eller om du vill ha din kommentar publicerad.</li>
            <li>Alla kommentarer granskas innan de eventuellt publiceras. Det kan ta lite tid!</li>
            <li>Om du kommenterar går du med på att namn och e-postadress lagras i Ankhemmets databas.</li>
        </ul>


        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="name">Namn:</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"/>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="email">E-post:</label>
                <input type="text" class="form-control" value="{{ old('email') }}" name="email"/>
            </div>
            <button type="submit" class="btn btn-primary">Skapa</button>
        </form>
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
