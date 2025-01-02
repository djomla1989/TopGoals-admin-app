@extends('layout')

@section('content')
    <h1>Mapiranje za {{ ucfirst($table) }}</h1>

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
                        <select name="mapping[allsport][{{ $osSport->id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataAllSports as $itemAllSports)
                                <option value="{{ $itemAllSports->id }}"
                                        @if($row['selectedAllSports'] == $itemAllSports->id) selected @endif>
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
                        <select name="mapping[oddsfeed][{{ $osSport->id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataOddsFeed as $itemOddsFeed)
                                <option value="{{ $itemOddsFeed->id }}"
                                        @if($row['selectedOddsFeed'] == $itemOddsFeed->id) selected @endif>
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
                        <select name="mapping[sportradar][{{ $osSport->id }}]" class="searchable-select" style="width: 85%">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataSportRadar as $sportRadar)
                                <option value="{{ $sportRadar->id }}"
                                        @if($row['selectedSportRadar'] == $sportRadar->id) selected @endif>
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
