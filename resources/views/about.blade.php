@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div>
                    <p>Ankhemmet är en applikation gjord av Anders Fredriksson; en pensionerad biblioteksmedarbetare med kvardröjande passion för programmering.
                        Det mesta är bakom inloggning och till för eget bruk, men det finns en öppen del i form av en <a href='/blog'>blogg</a>.</p>
                    <p>Ankhemmet är ett Laravel-projekt (PHP) med inslag av Vue.js</p>
                    <div class="imgcontainer">
                    <img src="https://webbsallad.se/ankfiles/jazzankan.png" alt="Anders">
                        <div class="bottom-centered">
                            <i>Själva Anders</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>
@endsection
