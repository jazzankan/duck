@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="post" action="/memories/{{ $memory->id  }}">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" class="form-control" value="{{ $memory->title }}" name="title"/>
            </div>
            <div class="form-group">
                <label for="description">Beskrivning:</label>
                <textarea class="form-control" id="description" name="description">{{ $memory->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="source">Källa:</label>
                <input type="text" class="form-control" value="{{ $memory->source }}" name="source"/>
            </div>
            <div class="form-group">
                <label for="link">Länk:</label>
                <input type="text" class="form-control" value="{{ $memory->link }}" name="link"/>
            </div>
            <div class="form-group">
                Tags:<br>
                <select multiple name="tags[]">
                    @foreach($tags as $t)
                        @if($seltags->contains('id', $t['id']))
                            <option value ="{{ $t['id'] }}" selected>{{ $t['name'] }}</option>
                        @else
                            <option value ="{{ $t['id'] }}">{{ $t['name'] }}</option>
                        @endif
                    @endforeach
                </select><br>
                Skapa och använd ny tag:<br>
                <input type="text" class="form-control" name="newtag"/>

            </div>
            <div>Viktighetsgrad:</div>
            <div class="radio">
                <label><input type="radio" name="importance" value="1"  {{ ($memory->importance === 1) ? 'checked' : '' }}> 1 </label>
                <label> <input type="radio" name="importance" value="2" {{ ($memory->importance === 2  ) ? 'checked' : '' }}> 2 </label>
                <label><input type="radio" name="importance" value="3"  {{ ($memory->importance === 3) ? 'checked' : '' }}> 3 </label>
            </div>
            <button type="submit" class="btn btn-primary">Uppdatera</button>
        </form>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @endsection
