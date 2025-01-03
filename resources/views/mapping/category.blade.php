@extends('layout')

@section('content')
    <h1 class="text-3xl">Mapiranje za Kategorije</h1>

    <div class="mt-2">
        <label><strong>Objasnjenje</strong></label>
        <ol>
            <li>Ove su prikazane kategorije u 4 kolone ( po svakom izvoru )</li>
            <li>Prva kolona je <strong>OS Sports `izvor`</strong> i ona je glavna, i ne moze da se menja</li>
            <li>Treba mapirati kategorije iz ostalih `izvora` (sources ) sa OS Sports</li>
            <li>Po default kategorije su mapirani prema prvom/OS-Sport izvodu po <string>Ime ili slug</string>, i tada ce pored reda pisati <span class="text-red-500">`Auto`</span>. Posle sacuvavanje, taj `auto` ce nestati</li>
            <li><strong>Os-sport / All Sport i Sport Radar su oko 95% slicne, sto znaci da su vec same po sebi mapirane. Imaju isto ime kao i "ID"</strong>, ali svakako je potrebno potvrditi na save</li>
            <li>Posle svake promene, mora se <strong>sacuvati promena na dugme "SAVE MAPPINGS" na kraju</strong></li>
            <li>Ukoliko je doslo do pogresnog mapiranja, mora se rucno ispraviti, tj odabrati zeljenu kategoriju ( ili ostaviti prazno ) i opet sacuvati</li>
            <li>Sve Mapirane kategorije ce se prikazati u <a class="text-blue-500" href="/map/tournament">Mapiranje turnira</a> </li>
        </ol>
    </div>

    @if(session('success'))
        <div class="alert text-red-500 text-sm">{{ session('success') }}</div>
    @endif

    <form method="post" action="{{ route('mapping.category.store', $table) }}">
        @csrf
        <table class="table-fixed border-collapse border border-slate-400 w-full">
            <tr>
                <th class="border border-slate-300 w-1/4">OS Sports</th>
                <th class="border border-slate-300 w-1/4">ALL SPORTS</th>
                <th class="border border-slate-300 w-1/4">TIPSER - ODDS FEED</th>
                <th class="border border-slate-300 w-1/4">SPORT RADAR</th>
            </tr>

            @foreach($mappedData as $row)
                @php
                    $osSport = $row['osSport'];
                @endphp
                <tr>
                    <!-- OS Sports -->
                    <td class="border border-slate-300 w-1/4">
                        {{ $osSport->name }} (ID: {{ $osSport->import_id }})
                    </td>

                    <!-- All Sports -->
                    <td class="border border-slate-300 w-1/4">
                        <select name="mapping[allsport][{{ $osSport->import_id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataAllSports as $itemAllSports)
                                <option value="{{ $itemAllSports->import_id }}"
                                        @if($row['selectedAllSports'] == $itemAllSports->import_id) selected @endif>
                                    {{ $itemAllSports->name }} - `{{$itemAllSports->slug}}` (ID: {{ $itemAllSports->import_id }})
                                </option>
                            @endforeach
                        </select>
                        @if($row['isAutoMappedAllSports'])
                            <span style="color:red;">auto</span>
                        @endif
                    </td>

                    <!-- Tipster - Odds Feed -->
                    <td class="border border-slate-300 w-1/4">
                        <select name="mapping[oddsfeed][{{ $osSport->import_id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataOddsFeed as $itemOddsFeed)
                                <option value="{{ $itemOddsFeed->import_id }}"
                                        @if($row['selectedOddsFeed'] == $itemOddsFeed->import_id) selected @endif>
                                    {{ $itemOddsFeed->name }} - `{{$itemOddsFeed->slug}}` (ID: {{ $itemOddsFeed->import_id }})
                                </option>
                            @endforeach
                        </select>
                        @if($row['isAutoMappedOddsFeed'])
                            <span style="color:red;">auto</span>
                        @endif
                    </td>

                    <!-- Sport Radar -->
                    <td class="border border-slate-300 w-1/4">
                        <select name="mapping[sportradar][{{ $osSport->import_id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataSportRadar as $sportRadar)
                                <option value="{{ $sportRadar->import_id }}"
                                        @if($row['selectedSportRadar'] == $sportRadar->import_id) selected @endif>
                                    {{ $sportRadar->name }} - `{{$sportRadar->slug}}` (ID: {{ preg_replace('/\D/', '',$sportRadar->import_id) }})
                                </option>
                            @endforeach
                        </select>
                        @if($row['isAutoMappedSportRadar'])
                            <span style="color:red;">auto</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        <button type="submit" class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Sačuvaj Mapiranja
        </button>

        @if(Session::has('message'))
            <p class="alert text-red-500 text-sm" {{ Session::get('alert-class', 'alert-info') }}">
            {{ Session::get('message') }}
            </p>
        @endif
    </form>

{{--    <div class="pt-10 clear-start">--}}
{{--        <h2>Automatsko Mapiranje</h2>--}}
{{--        <form method="post" action="{{ route('mapping.category.auto') }}">--}}
{{--            @csrf--}}
{{--            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                Automatsko Mapiranje--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}

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
