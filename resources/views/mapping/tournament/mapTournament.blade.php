@extends('layout')

@section('title', 'Map Tournaments')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 mx-auto">
        <h1 class="text-xl font-bold mb-4">Map Tournaments: <span class="underline text-3xl"> {{$category->name}} </span></h1>

        <span class="text-blue-600">
            <a href="{{route('mapping.tournament.index')}}"> Vrati se na lisu mapiranih kategorija </a>
        </span>
        <div class="mt-2">
            <label><strong>Objasnjenje</strong></label>
            <ol>
                <li>Ove su prikazane turniri u 4 kolone ( po svakom izvoru )</li>
                <li>Prva kolona je <strong>OS Sports `izvor`</strong> i ona je glavna, i ne moze da se menja</li>
                <li>Treba mapirati turnire iz ostalih `izvora` (sources ) sa OS Sports</li>
                <li>Po default turniri su mapirani prema prvom/OS-Sport izvodu po <string>Ime ili slug</string>, i tada ce pored reda pisati <span class="text-red-500">`Auto`</span>. Posle sacuvavanje, taj `auto` ce nestati</li>
                <li><strong>Os-sport / All Sport i Sport Radar su oko 95% slicne, sto znaci da su vec same po sebi mapirane. Imaju isto ime kao i "ID"</strong>, ali svakako je potrebno potvrditi na save</li>
                <li>Posle svake promene, mora se <strong>sacuvati promena na dugme "SAVE MAPPINGS" na kraju</strong></li>
                <li>Ukoliko je doslo do pogresnog mapiranja, mora se rucno ispraviti, tj odabrati zeljeni turnir ( ili ostaviti prazno ) i opet sacuvati</li>
                <li>Sve Mapirane kategorije ce se prikazati u <a class="text-blue-500" href="/map/tournament">Mapiranje turnira</a> </li>
                <li>Ukoliko je <strong>kategorija</strong> pogresno mapirana, mora da se vrati na <a class="text-blue-500" href="/map/category">Mapiranje kategorije</a> i da se tu ispravi.</li>
            </ol>
        </div>

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
                                $selectedId = $mappings[$osSportTournament->import_id]['allsport_table_id'] ?? null;
                                $isAutoMapped = false;

                                if ($selectedId === null) {
                                    foreach($allSportsTournaments as $tournamentCheck) {
                                        if(
                                            strtolower($osSportTournament->name) == strtolower($tournamentCheck->name) ||
                                            strtolower($osSportTournament->slug) == strtolower($tournamentCheck->slug)
                                        ) {
                                            $selectedId = $tournamentCheck->import_id;
                                            $isAutoMapped = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp

                            <select name="mapping[allsport][{{ $osSportTournament->import_id }}]" class="searchable-select" style="width: 85%">
                                <option value="">-- Select Tournament --</option>
                                @foreach($allSportsTournaments as $allSportstournament)
                                    <option value="{{ $allSportstournament->import_id }}"
                                            @if($selectedId == $allSportstournament->import_id)
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
                                $selectedIdOddsFeed = $mappings[$osSportTournament->import_id]['oddsfeed_table_id'] ?? null;
                                $isAutoMapped = false;

                                if ($selectedIdOddsFeed === null) {
                                    foreach($oddsFeedTournaments as $tournamentCheck) {
                                        if(
                                            strtolower($osSportTournament->name) == strtolower($tournamentCheck->name) ||
                                            strtolower($osSportTournament->slug) == strtolower($tournamentCheck->slug)
                                        ) {
                                            $selectedIdOddsFeed = $tournamentCheck->import_id;
                                            $isAutoMapped = true;
                                            break;
                                        }
                                    }
                                }

                            @endphp

                            <select name="mapping[oddsfeed][{{ $osSportTournament->import_id }}]" class="searchable-select" style="width: 85%">
                                <option value="">-- Select Tournament --</option>
                                @foreach($oddsFeedTournaments as $oddsFeedTournament)
                                    <option value="{{ $oddsFeedTournament->import_id }}"
                                            @if($selectedIdOddsFeed == $oddsFeedTournament->import_id)
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
                                $selectedIdSportRadar = $mappings[$osSportTournament->import_id]['sportradar_table_id'] ?? null;
                                $isAutoMapped = false;

                                if ($selectedIdSportRadar === null) {
                                    foreach($sportRadarTournaments as $tournamentCheck) {
                                        if(
                                            strtolower($osSportTournament->name) == strtolower($tournamentCheck->name) ||
                                            strtolower($osSportTournament->slug) == strtolower($tournamentCheck->slug)
                                        ) {
                                            $selectedIdSportRadar = $tournamentCheck->import_id;
                                            $isAutoMapped = true;
                                            break;
                                        }
                                    }
                                }

                            @endphp

                            <select name="mapping[sportradar][{{ $osSportTournament->import_id }}]" class="searchable-select" style="width: 85%">
                                <option value="">-- Select Tournament --</option>
                                @foreach($sportRadarTournaments as $sportRadarTournament)
                                    <option value="{{ $sportRadarTournament->import_id }}"
                                            @if($selectedIdSportRadar == $sportRadarTournament->import_id)
                                                selected
                                        @endif
                                    >
                                        {{ $sportRadarTournament->name }} (ID: {{ preg_replace('/\D/', '',$sportRadarTournament->import_id) }})
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
