{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    <h1>Mapiranje za Turnire</h1>

    @foreach($categoryList as $key => $categoryList)
        <h3>
            <a href="{{route('mapping.tournament.mapTournament', [$key])}}">
                {{ $categoryList->name }}
            </a>
        </h3>

    @endforeach


{{--@endsection--}}
