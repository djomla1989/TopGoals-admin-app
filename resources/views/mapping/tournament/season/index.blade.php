{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    <h1>Mapiranje za Sezone</h1>

    @foreach($tournamentList as $key => $tournament)
        <h3>
            <a href="{{route('mapping.tournament.season.mapSeason', [$key])}}">
            {{$tournament->category->name}} -- {{ $tournament->name }}
    </a>
</h3>

@endforeach


{{--@endsection--}}
