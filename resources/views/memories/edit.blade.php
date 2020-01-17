@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="post" action="{{ route('memories.edit') }}">
            @csrf
            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" class="form-control" value="{{ old('title') }}" name="title"/>
            </div>
            <div class="form-group">
                <label for="description">Beskrivning:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="source">Källa (om inte länk):</label>
                <input type="text" class="form-control" value="{{ old('source') }}" name="source"/>
            </div>
            <div class="form-group">
                <label for="link">Länk:</label>
                <input type="text" class="form-control" value="{{ old('link') }}" name="link"/>
            </div>
            <div class="form-group">
                Tags:<br>
                <select multiple name="tags[]">
                    @foreach($tags as $t)
                        <option value ="{{ $t['id'] }}">{{ $t['name'] }}</option>
                    @endforeach
                </select><br>
                Skapa och använd ny tag:<br>
                <input type="text" class="form-control" value="{{ old('newtag') }}" name="newtag"/>

            </div>
            <div>Viktighetsgrad:</div>
            <div class="radio">
                <label><input type="radio" name="importance" value="1" {{ (old('importance') === '1') ? 'checked' : '' }}> 1 &nbsp; </label>
                <label> <input type="radio" name="importance" value="2" {{ (old('importance') === '2' || old('importance') === null) ? 'checked' : '' }}> 2 &nbsp; </label>
                <label><input type="radio" name="importance" value="3" {{ (old('importance') === '3') ? 'checked' : '' }}> 3 &nbsp;</label>
            </div>
            <button type="submit" class="btn btn-primary">Skapa</button>
        </form>
    </div>
