@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($undonetodos) > 0)
            <h1>Ofärdiga Arbetsuppgifter</h1>
            <ul class="list-group striped-list">
                @foreach ($undonetodos as $t)
                    <li class="list-group-item"><h4>{{ $t->title }}</h4> @if($t['deadline']) Deadline: <span @if($t['deadline'] <= $today)class="redalert"@endif>{{ $t->deadline }}</span>@endif</li>
                @endforeach
            </ul>
        @else
            <h2>Du har inga ogjorda arbetsuppgifter.</h2>
            <p><a href="/projects/create" class="btn btn-primary btn-sm">Nytt projekt</a></p>
        @endif
    </div>
@endsection
