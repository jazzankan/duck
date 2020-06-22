@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Behandla bloggkommentar</h1>
        <form method="post" action="/comments/{{ $comment->id }}">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="name">Text:</label>
                    <input type="text" class="form-control" value="{{ $comment->body }}" name="body"/>
                </div>
            </div>
            <p>Inskickad av <strong>{{ $comment->name }}</strong><br> {{ $comment->email }}</p>
            <p>Vill ha publicerad:  @if($comment->wishpublic === 'yes')Ja @else Nej @endif</p>
            @if($comment->wishpublic ==='yes')
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="wishpublic" value="yes">
                            <label class="form-check-label" for="publish">Publicera</label>
                        </div>
                    </div>
            @endif
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="reviewed" value="yes" checked="checked">
                    <label class="form-check-label" for="publish">Granskad</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Skicka</button>
        </form>
        <p> {{ $comment->belongart }}</p>
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
