{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    <h1>Mapiranje za Turnire</h1>

    <div>
        <label><strong>Objasnjenje</strong></label>
        <ol>
            <li>Ovo je lista svih kategorija koje su mapirane u <a href="/map/catregory">mapiranju kategorija</a></li>
            <li>Klikom na svaku od ovih kategorija, otvara se forma za mapiranje <strong>turnira</strong> za tu kategoriju</li>
            <li>Ukoliko je doslo do pogresnog mapiranja kategorija, vratiti se na <a href="/map/catregory">mapiranju kategorija</a> i ispraviti to</li>
        </ol>
    </div>

    @foreach($categoryList as $key => $categoryList)
        <h3>
            <a href="{{route('mapping.tournament.mapTournament', [$key])}}">
                {{ $categoryList->name }}
            </a>
        </h3>

    @endforeach


{{--@endsection--}}
