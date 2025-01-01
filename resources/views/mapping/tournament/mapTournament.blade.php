@extends('layout')

@section('title', 'Map Tournaments')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 mx-auto">
        <h1 class="text-xl font-bold mb-4">Map Tournaments: <span class="underline"> {{$category->name}} </span></h1>

        <span class="text-blue-600">
            <a href="{{route('mapping.tournament.index')}}"> Back to list</a>
        </span>

        <form action="{{ route('mapping.tournament.mapTournament', ['dataMapping' => $dataMapping->id]) }}" method="POST">
            @csrf
            <table class="table-fixed border-collapse border border-slate-400 w-full">
                <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left w-1/4">OS Sports</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-1/4">ALL Sports</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-1/4">ODDS FEED</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-1/4">Sport Radar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($osSportTournaments as $osSportTournament)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 w-1/4">
                            {{ $osSportTournament->name }} (ID: {{ $osSportTournament->import_id }})
                        </td>
                        <td class="border border-gray-300 px-4 py-2 w-1/4">
                            @php
                                $selectedId = $mappings[$osSportTournament->id]['allsport_table_id'] ?? null;
                                $isAutoMapped = false;

                                if ($selectedId === null) {
                                    foreach($allSportsTournaments as $tournamentCheck) {
                                        if(
                                            strtolower($osSportTournament->name) == strtolower($tournamentCheck->name) ||
                                            strtolower($osSportTournament->slug) == strtolower($tournamentCheck->slug)
                                        ) {
                                            $selectedId = $tournamentCheck->id;
                                            $isAutoMapped = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp

                            <select name="mapping[allsport][{{ $osSportTournament->id }}]" class="searchable-select" style="width: 85%">
                                <option value="">-- Select Tournament --</option>
                                @foreach($allSportsTournaments as $allSportstournament)
                                    <option value="{{ $allSportstournament->id }}"
                                            @if($selectedId == $allSportstournament->id)
                                                selected
                                        @endif
                                    >
                                        {{ $allSportstournament->name }} (ID: {{ $allSportstournament->import_id }})
                                    </option>
                                @endforeach
                            </select>

                            @if($isAutoMapped)
                                <span class="text-red-500 text-sm">Auto</span>
                            @endif
                        </td>

                        <td class="border border-gray-300 px-4 py-2 w-1/4">
                            @php
                                $selectedIdOddsFeed = $mappings[$osSportTournament->id]['oddsfeed_table_id'] ?? null;
                                $isAutoMapped = false;

                                if ($selectedIdOddsFeed === null) {
                                    foreach($oddsFeedTournaments as $tournamentCheck) {
                                        if(
                                            strtolower($osSportTournament->name) == strtolower($tournamentCheck->name) ||
                                            strtolower($osSportTournament->slug) == strtolower($tournamentCheck->slug)
                                        ) {
                                            $selectedIdOddsFeed = $tournamentCheck->id;
                                            $isAutoMapped = true;
                                            break;
                                        }
                                    }
                                }

                            @endphp

                            <select name="mapping[oddsfeed][{{ $osSportTournament->id }}]" class="searchable-select" style="width: 85%">
                                <option value="">-- Select Tournament --</option>
                                @foreach($oddsFeedTournaments as $oddsFeedTournament)
                                    <option value="{{ $oddsFeedTournament->id }}"
                                            @if($selectedIdOddsFeed == $oddsFeedTournament->id)
                                                selected
                                        @endif
                                    >
                                        {{ $oddsFeedTournament->name }} (ID: {{ $oddsFeedTournament->import_id }})
                                    </option>
                                @endforeach
                            </select>

                            @if($isAutoMapped)
                                <span class="text-red-500 text-sm">Auto</span>
                            @endif
                        </td>

                        <td class="border border-gray-300 px-4 py-2 w-1/4">
                            @php
                                $selectedIdSportRadar = $mappings[$osSportTournament->id]['sportradar_table_id'] ?? null;
                                $isAutoMapped = false;

                                if ($selectedIdSportRadar === null) {
                                    foreach($sportRadarTournaments as $tournamentCheck) {
                                        if(
                                            strtolower($osSportTournament->name) == strtolower($tournamentCheck->name) ||
                                            strtolower($osSportTournament->slug) == strtolower($tournamentCheck->slug)
                                        ) {
                                            $selectedIdSportRadar = $tournamentCheck->id;
                                            $isAutoMapped = true;
                                            break;
                                        }
                                    }
                                }

                            @endphp

                            <select name="mapping[sportradar][{{ $osSportTournament->id }}]" class="searchable-select" style="width: 85%">
                                <option value="">-- Select Tournament --</option>
                                @foreach($sportRadarTournaments as $sportRadarTournament)
                                    <option value="{{ $sportRadarTournament->id }}"
                                            @if($selectedIdSportRadar == $sportRadarTournament->id)
                                                selected
                                        @endif
                                    >
                                        {{ $sportRadarTournament->name }} (ID: {{ $sportRadarTournament->import_id }})
                                    </option>
                                @endforeach
                            </select>

                            @if($isAutoMapped)
                                <span class="text-red-500 text-sm">Auto</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Mappings</button>
        </form>
        @if(Session::has('message'))
            <p class="alert text-red-500 text-sm" {{ Session::get('alert-class', 'alert-info') }}">
            {{ Session::get('message') }}
            </p>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const submitBtn = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtn.innerText = 'Submitting...';
            });
        });
    </script>
@endsection
