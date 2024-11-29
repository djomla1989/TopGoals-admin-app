@extends('layout')

@section('title', 'Map Seasons')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-xl font-bold mb-4">Map Season: <span class="underline"> {{$tournament->name}} </span></h1>

        <span class="text-blue-600">
            <a href="{{route('mapping.tournament.index')}}"> Back to list</a>
        </span>

        <form action="{{ route('mapping.tournament.season.store', ['dataMapping' => $dataMapping->id]) }}" method="POST">
            @csrf
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left">Source Season</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Mapped Season</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sourceSeasons as $sourceSeason)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $sourceSeason->name }} (ID: {{ $sourceSeason->year }})
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @php
                                $selectedId = null;
                                $isAutoMapped = false;

                                if (isset($mappings[$sourceSeason->id])) {
                                    // Postoji postojeće mapiranje
                                    $selectedId = $mappings[$sourceSeason->id]->tipster_table_id;
                                } else {
                                    // Proveri da li postoji automatsko mapiranje
                                    foreach ($mapSeason as $tournamentCheck) {
                                        if (
                                            strtolower($sourceSeason->name) == strtolower($tournamentCheck->name) ||
                                            strtolower($sourceSeason->slug) == strtolower($tournamentCheck->slug) ||
                                            strtolower($sourceSeason->year) == strtolower($tournamentCheck->year) ||
                                            strtolower($sourceSeason->year) == strtolower(preg_replace('/(\d{2})(\d{2})-(\d{2})(\d{2})/', '$2/$4', $tournamentCheck->year))
                                        ) {
                                            $selectedId = $tournamentCheck->id;
                                            $isAutoMapped = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp

                            <select name="mapping[{{ $sourceSeason->id }}]" class="form-select block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Select Season --</option>
                                @foreach($mapSeason as $tournament)
                                    <option value="{{ $tournament->id }}"
                                            @if($selectedId == $tournament->id)
                                                selected
                                        @endif
                                    >
                                        {{ $tournament->name }} ({{preg_replace('/(\d{2})(\d{2})-(\d{2})(\d{2})/', '$2/$4', $tournament->year)}})
                                    </option>
                                @endforeach
                            </select>

                            @if($isAutoMapped)
                                <span class="text-red-500 text-sm">Auto-mapped</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Mappings</button>
        </form>
    </div>
@endsection
