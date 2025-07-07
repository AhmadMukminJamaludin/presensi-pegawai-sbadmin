<table border="1" style="border-collapse: collapse; width: 100%;">

    {{-- Judul --}}
    <tr>
        <th colspan="{{ 4 + $dates->count() }}" style="border:1px solid black; text-align: center;">
            Laporan Presensi Bulanan: {{ \Carbon\Carbon::create($year,$month)->format('F Y') }}
        </th>
    </tr>
</table>

{{-- Matriks Presensi --}}
<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th rowspan="2" style="border:1px solid black;">No</th>
            <th rowspan="2" style="border:1px solid black;">NIP</th>
            <th rowspan="2" style="border:1px solid black;">Nama</th>
            <th rowspan="2" style="border:1px solid black;">Bagian</th>
            <th colspan="{{ $dates->count() }}" style="border:1px solid black;">Tanggal</th>
        </tr>
        <tr>
            @foreach($dates as $d)
                <th style="border:1px solid black;">{{ \Carbon\Carbon::parse($d)->format('j') }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($pegawais as $i => $peg)
        <tr>
            <td style="border:1px solid black;">{{ $i+1 }}</td>
            <td style="border:1px solid black;">{{ $peg->nip }}</td>
            <td style="border:1px solid black;">{{ $peg->nama }}</td>
            <td style="border:1px solid black;">{{ $peg->bagian->nama_bagian }}</td>
            @foreach($dates as $d)
                @php
                    $r = $daily->get($peg->id, collect())
                        ->first(fn($item)=> $item->tanggal->format('Y-m-d')===$d);
                @endphp
                <td style="border:1px solid black; text-align: center;">
                    @if($r)
                        {{ $r->waktu_checkin->format('H:i') }}-{{ $r->waktu_checkout?->format('H:i')??'*' }}
                    @else
                        -
                    @endif
                </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

<br/>

{{-- Tabel Rekap --}}
<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border:1px solid black;">No</th>
            <th style="border:1px solid black;">NIP</th>
            <th style="border:1px solid black;">Nama</th>
            <th style="border:1px solid black;">Bagian</th>
            <th style="border:1px solid black;">Hadir</th>
            <th style="border:1px solid black;">Terlambat</th>
            <th style="border:1px solid black;">Alpha</th>
            <th style="border:1px solid black;">Cuti</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekap as $i => $row)
        <tr>
            <td style="border:1px solid black;">{{ $i+1 }}</td>
            <td style="border:1px solid black;">{{ $row->nip }}</td>
            <td style="border:1px solid black;">{{ $row->nama }}</td>
            <td style="border:1px solid black;">{{ $row->bagian }}</td>
            <td style="border:1px solid black;">{{ $row->hadir }}</td>
            <td style="border:1px solid black;">{{ $row->terlambat }}</td>
            <td style="border:1px solid black;">{{ $row->alpha }}</td>
            <td style="border:1px solid black;">{{ $row->cuti }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
