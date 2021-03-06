@extends('layouts.app')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @if(count($memories) > 0)
            <h1>Minnen</h1>
            <form method="post" action="{{ route('memories.index') }}">
                @csrf
            <a href="/memories/create" class="btn btn-primary btn-sm newmem">Nytt minne</a>
                <input type="text" class="newmembox" value="{{ $searchterm }}" name="search"/> <button type="submit" class="btn btn-primary newmem">Sök</button>
                <a href="#" v-on:click="memfilter = !memfilter"><b>Filtrera</b></a>
            <div v-show="memfilter">
                <p><label for="tag">Tagg:</label>
                    @if($tags)
                        <select id="tag" name="tag">
                            <option value=""></option>
                            @foreach($tags as $t)
                                <option value ="{{ $t['id'] }}">{{ $t['name'] }}</option>
                            @endforeach
                    @endif
                        </select>
                </p>
                <p><label for="importance">Viktighet:</label>
                    <select id="importance" name="importance">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select></p>
                <p><label for="fromdate">Från:</label>
                    <input type="date" value="" name="fromdate"/>
                    <label for="todate">Till:</label>
                    <input type="date" value="" name="todate"/></p>
            </div>
            </form>
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
            <ul class="list-group striped-list">
                @foreach ($memories as $memory)
                    <li class="list-group-item"><h4><a href="/memories/{{ $memory->id }}">{{ $memory->title }}</a></h4></li>
                @endforeach
            </ul>
            <p>
            {{$memories->render()}}
            </p>
            @elseif($searchterm)
            <h2>Inga träffar!</h2>
            <p><a href="/memories" class="btn btn-primary btn-sm">Minneslistan</a></p>
        @else
            <h2>Det finns inget...</h2>
            <p><a href="/memories/create" class="btn btn-primary btn-sm">Nytt minne</a></p>
        @endif
    </div>
@endsection

