@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($undonetodos) > 0)
            <h1>Ofärdiga arbetsuppgifter</h1>
            <ul class="list-group striped-list">
                @foreach ($undonetodos as $t)
                    <li class="list-group-item"><h4>{{ $t->title }}</h4> @if($t['deadline']) Deadline: <span @if($t['deadline'] <= $today)class="redalert"@endif>{{ $t->deadline }}</span>@endif<br>
                        <h5>Tillhör projekt: <a href="/projects/{{ $t->project_id }}">{{ $t->projname }}</a></h5></li>
                @endforeach
            </ul>
        @else
            <h2>Du har inga ogjorda arbetsuppgifter.</h2>
        @endif
    </div>
@endsection
