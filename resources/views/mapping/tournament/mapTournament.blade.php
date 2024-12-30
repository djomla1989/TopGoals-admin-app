@extends('layout')

@section('title', 'Map Tournaments')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-xl font-bold mb-4">Map Tournaments: <span class="underline"> {{$category->name}} </span></h1>

        <span class="text-blue-600">
            <a href="{{route('mapping.tournament.index')}}"> Back to list</a>
        </span>

        <form action="{{ route('mapping.tournament.mapTournament', ['dataMapping' => $dataMapping->id]) }}" method="POST">
            @csrf
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left">Source Tournament</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Mapped Tournament</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sourceTournaments as $sourceTournament)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $sourceTournament->name }} (ID: {{ $sourceTournament->id }})
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @php
                                $selectedId = null;
                                $isAutoMapped = false;

                                if (isset($mappings[$sourceTournament->id])) {
                                    // Postoji postojeće mapiranje
                                    $selectedId = $mappings[$sourceTournament->id]->tipster_table_id;
                                } else {
                                    // Proveri da li postoji automatsko mapiranje
                                    foreach ($mapTournament as $tournamentCheck) {
                                        if (
                                            isset($autoMapper[$sourceTournament->id]) && $autoMapper[$sourceTournament->id] == $tournamentCheck->id
                                        ) {
                                            $selectedId = $tournamentCheck->id;
                                            $isAutoMapped = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp

                            <select name="mapping[{{ $sourceTournament->id }}]" class="form-select block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Select Tournament --</option>
                                @foreach($mapTournament as $tournament)
                                    <option value="{{ $tournament->id }}"
                                            @if($selectedId == $tournament->id)
                                                selected
                                        @endif
                                    >
                                        {{ $tournament->name }} (ID: {{ $tournament->id }})
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
