@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Skapa ett minne</h1>
        <form method="post" action="{{ route('memories.store') }}">
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
                <label for="source">Länk:</label>
                <input type="text" class="form-control" value="{{ old('link') }}" name="link"/>
            </div>
            <div>Viktighetsgrad:</div>
            <div class="radio">
                <label><input type="radio" name="importance" value="y" {{ (old('importance') === '1') ? '' : 'checked' }}> 1 </label>
                <label> <input type="radio" name="importance" {{ (old('importance') === '2')  || (old('importance') === null )? 'checked' : '' }} value="n"> 2 </label>
                <label><input type="radio" name="importance" {{ (old('importance') === '3') ? 'checked' : '' }} value="n"> 3 </label>
            </div>
            <!--<div class="form-group">
                <input type="hidden" name="date" id="date" value ="{{ old('deadline') != null ? old('deadline') : ''}}"/>
                <label for="deadline">Deadline om det finns någon:</label>
                <template>
                    <div>
                        <date-picker v-model="time1" :lang="lang" :first-day-of-week="1"></date-picker>
                    </div>
                </template>
            </div>
            <div class="radio">
                <label><input type="radio" name="importance" value="y" {{ (old('importance') === 'n') ? '' : 'checked' }}>Plikt</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="importance" {{ (old('importance') === 'n') ? 'checked' : '' }} value="n">Hobby eller nöje</label>
            </div>
            <div>
            </div>-->
            <button type="submit" class="btn btn-primary">Skapa</button>
        </form>
    </div>
    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    </div>
@endsection
