@extends('layout')

@section('content')
    <h1>Mapiranje za {{ ucfirst($table) }}</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
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
            @foreach($dataOsSports as $itemA)
                <tr>
                    <td class="border border-slate-300 w-1/4">{{ $itemA->name }} (ID: {{ $itemA->import_id }})</td>
                    <td class="border border-slate-300 w-1/4">
                        @php
                            $selectedAllSports = $mappings[$itemA->id]['allsport_table_id'] ?? null;
                            $isAutoMappedTipser = false;

                            if ($selectedAllSports === null) {
                                foreach($dataAllSports as $itemBCheck) {
                                    if(
                                        strtolower($itemA->name) == strtolower($itemBCheck->name) ||
                                        strtolower($itemA->slug) == strtolower($itemBCheck->slug)
                                    ) {
                                        $selectedAllSports = $itemBCheck->id;
                                        $isAutoMappedTipser = true;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <select name="mapping[allsport][{{ $itemA->id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataAllSports as $itemB)
                                <option value="{{ $itemB->id }}"
                                        @if($selectedAllSports == $itemB->id)
                                            selected
                                    @endif>
                                    {{ $itemB->name }} - `{{$itemB->slug}}` (ID: {{ $itemB->import_id }})
                                </option>
                            @endforeach
                        </select>
                        @if($isAutoMappedTipser)
                            <span style="color:red;">auto</span>
                        @endif
                    </td>

                    <!--Odss Feed Mapping -->
                    <td class="border border-slate-300 w-1/4">
                        @php
                            $selectedIdOddsFeed = $mappings[$itemA->id]['oddsfeed_table_id'] ?? null;
                            $isAutoMappedOsSports = false;

                            if ($selectedIdOddsFeed === null) {
                                foreach($dataOddsFeed as $itemCCheck) {
                                    if(
                                        strtolower($itemA->name) == strtolower($itemCCheck->name) ||
                                        strtolower($itemA->slug) == strtolower($itemCCheck->slug)
                                    ) {
                                        $selectedIdOddsFeed = $itemCCheck->id;
                                        $isAutoMappedOsSports = true;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <select name="mapping[oddsfeed][{{ $itemA->id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataOddsFeed as $itemC)
                                <option value="{{ $itemC->id }}"
                                        @if($selectedIdOddsFeed == $itemC->id)
                                            selected
                                    @endif>
                                    {{ $itemC->name }} - `{{$itemC->slug}}` (ID: {{ $itemC->import_id }})
                                </option>
                            @endforeach
                        </select>
                        @if($isAutoMappedOsSports)
                            <span style="color:red;">auto</span>
                        @endif
                    </td>

                    <!-- Sport Radar Sports Mapping -->
                    <td class="border border-slate-300 w-1/4">
                        @php
                            $selectedIdSportRadar = $mappings[$itemA->id]['sportradar_table_id'] ?? null;
                            $isAutoMappedSportRadar = false;

                            if ($selectedIdSportRadar === null) {
                                foreach($dataSportRadar as $itemDCheck) {
                                    if(
                                        strtolower($itemA->name) == strtolower($itemDCheck->name) ||
                                        strtolower($itemA->slug) == strtolower($itemDCheck->slug)
                                    ) {
                                        $selectedIdSportRadar = $itemDCheck->id;
                                        $isAutoMappedSportRadar = true;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <select name="mapping[sportradar][{{ $itemA->id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataSportRadar as $sportRadar)
                                <option value="{{ $sportRadar->id }}"
                                        @if($selectedIdSportRadar == $sportRadar->id)
                                            selected
                                    @endif>
                                    {{ $sportRadar->name }} - `{{$sportRadar->slug}}` (ID: {{ $sportRadar->import_id }})
                                </option>
                            @endforeach
                        </select>
                        @if($isAutoMappedSportRadar)
                            <span style="color:red;">auto</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <button type="submit" class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Sačuvaj Mapiranja
        </button>
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
