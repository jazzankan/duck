@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Hej! Tack för att du vill kommentera inlägget <strong>"<span class="articletitle">{{ $article->heading }}</span>"</strong></h3>
        <p>Ankhemmet är ett milt <b>a</b>socialt medium. Följande gäller:</p>
        <ul>
            <li>Du måste ange en giltig e-postadress!</li>
            <li>Din e-postadress publiceras <strong>aldrig</strong> om du inte själv skriver in den i själva kommentarstexten. Den lämnas inte vidare till någon.</li>
            <li>Du kan välja om du bara vill höra av dig eller om du vill ha din kommentar publicerad.</li>
            <li>Alla kommentarer granskas innan de eventuellt publiceras. Det kan ta lite tid!</li>
            <li>Om du kommenterar går du med på att namn och e-postadress lagras i Ankhemmets databas.</li>
        </ul>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <p><label for="name">Namn (gärna ditt riktiga):</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name"/></p>
                    <p><label for="email">E-post:</label>
                    <input type="text" class="form-control" value="{{ old('email') }}" name="email"/></p>
                    <div class="form-check">
                        <p><input type="checkbox" class="form-check-input" name="wishpublic" value="yes" >
                        <label class="form-check-label" for="publish">Jag vill att min kommentar publiceras i bloggen.</label></p>
                    </div>
                    <div class="form-group">
                        <label for="description">Min text:</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <p><button type="submit" class="btn btn-primary">Skicka</button></p>
        </form>
        <p>Visa inläggets text här:</p>
        <p>{{ $article->body }}</p>
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
