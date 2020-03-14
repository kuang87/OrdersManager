@extends('main.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h2>Weather in Bryansk</h2>
        <div class="jumbotron p-3 p-md-5 rounded">
            <div class="col-md-6 px-0">
                @if($weather === false)
                    <p class="lead">Connection is lost</p>
                @else
                    <p class="lead">Temperature: {{$weather['temp'] ?? ''}} &#176;C,  feels like: {{$weather['feels_like'] ?? ''}} &#176;C</p>
                    <p class="lead">Wind: {{$weather['wind_speed'] ?? ''}} m/s</p>
                    <p class="lead">Humidity: {{$weather['humidity'] ?? ''}} %</p>
                @endif
            </div>
        </div>
    </main>
@endsection
