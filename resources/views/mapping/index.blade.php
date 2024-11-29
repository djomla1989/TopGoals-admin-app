{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    <h1>Mapiranje za {{ ucfirst($table) }}</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form method="post" action="{{ route('mapping.store', $table) }}">
        @csrf
        <table border="1">
            <tr>
                <th>Source A</th>
                <th>Source B</th>
            </tr>
            @foreach($dataA as $itemA)
                <tr>
                    <td>{{ $itemA->name }} (ID: {{ $itemA->id }})</td>
                    <td>
                        @php
                            $selectedId = null;
                            $isAutoMapped = false;
                            if(isset($mappings[$itemA->id])) {
                                // Postoji postojeće mapiranje
                                $selectedId = $mappings[$itemA->id]->tipster_table_id;
                            } else {
                                // Proveri da li postoji automatsko mapiranje
                                foreach($dataB as $itemBCheck) {
                                    if(
                                        strtolower($itemA->name) == strtolower($itemBCheck->name) ||
                                        strtolower($itemA->slug) == strtolower($itemBCheck->slug)
                                    ) {
                                        $selectedId = $itemBCheck->id;
                                        $isAutoMapped = true;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <select name="mapping[{{ $itemA->id }}]">
                            <option value="">-- Izaberi --</option>
                            @foreach($dataB as $itemB)
                                <option value="{{ $itemB->id }}"
                                        @if($selectedId == $itemB->id)
                                            selected
                                    @endif
                                >
                                    {{ $itemB->name }} - `{{$itemB->slug}}` (ID: {{ $itemB->id }})
                                </option>
                            @endforeach
                        </select>
                        @if($isAutoMapped)
                            <span style="color:red;">auto mapped</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <button type="submit">Sačuvaj Mapiranja</button>
    </form>

    <form method="post" action="{{ route('mapping.auto', $table) }}">
        @csrf
        <button type="submit">Automatsko Mapiranje</button>
    </form>
{{--@endsection--}}
