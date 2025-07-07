@extends('layouts.app')

@section('title', 'Laporan Presensi Bulanan')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Laporan Presensi Bulanan</h1>

        {{-- Filter Bulan & Tahun --}}
        <form class="form-inline mb-4" method="GET" action="{{ route('laporan.index') }}">
            <div class="form-group mr-3">
                <label class="mr-1">Bulan</label>
                <select name="month" class="form-control">
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create($year, $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-3">
                <label class="mr-1">Tahun</label>
                <select name="year" class="form-control">
                    @foreach (range(now()->year - 2, now()->year) as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-primary mr-2">Tampilkan</button>
                <a href="{{ route('laporan.export', ['year'=>$year,'month'=>$month]) }}"
                    class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Cetak Excel
                </a>
            </div>
        </form>

        {{-- Nav Tabs --}}
        <ul class="nav nav-tabs mb-3" id="laporanTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="harian-tab" data-toggle="tab" href="#harian" role="tab">Detail Harian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="rekap-tab" data-toggle="tab" href="#rekap" role="tab">Rekap Bulanan</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" id="matrix-tab" data-toggle="tab" href="#matrix" role="tab">Matriks Presensi</a>
            </li> --}}
        </ul>

        <div class="tab-content" id="laporanTabContent">
            {{-- Tab: Detail Harian --}}
            <div class="tab-pane fade show active" id="harian" role="tabpanel">
                <div class="card shadow mb-4">
                    <div class="card-body table-responsive">
                        @if ($dailyRecords->isEmpty())
                            <div class="alert alert-warning">Tidak ada data presensi untuk bulan ini.</div>
                        @else
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Bagian</th>
                                        <th>Check‑in</th>
                                        <th>Check‑out</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dailyRecords as $r)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ $r->pegawai->nip }}</td>
                                            <td>{{ $r->pegawai->nama }}</td>
                                            <td>{{ $r->pegawai->bagian->nama_bagian }}</td>
                                            <td>{{ $r->waktu_checkin->format('H:i') }}</td>
                                            <td>{{ $r->waktu_checkout ? $r->waktu_checkout->format('H:i') : '-' }}</td>
                                            <td>{{ ucfirst($r->status) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tab: Rekap Bulanan --}}
            <div class="tab-pane fade" id="rekap" role="tabpanel">
                <div class="card shadow">
                    <div class="card-body table-responsive">
                        @if ($rekap->isEmpty())
                            <div class="alert alert-warning">Belum ada data rekap untuk bulan ini.</div>
                        @else
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Bagian</th>
                                        <th>Hadir</th>
                                        <th>Terlambat</th>
                                        <th>Alpha</th>
                                        <th>Cuti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekap as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $row->nip }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->bagian }}</td>
                                            <td>{{ $row->total_hadir }}</td>
                                            <td>{{ $row->total_terlambat }}</td>
                                            <td>{{ $row->total_alpha }}</td>
                                            <td>{{ $row->total_cuti }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tab: Matriks Presensi --}}
            <div class="tab-pane fade" id="matrix" role="tabpanel">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:auto; white-space: nowrap;">
                            <table class="table table-bordered table-sm">
                                <thead class="text-center align-top thead-light">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">NIP</th>
                                        <th rowspan="2">Nama</th>
                                        <th rowspan="2">Bagian</th>
                                        <th colspan="{{ $dates->count() }}">Tanggal</th>
                                    </tr>
                                    <tr>
                                        @foreach ($dates as $d)
                                            <th>{{ \Carbon\Carbon::parse($d)->format('j') }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawais as $i => $peg)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $peg->nip }}</td>
                                            <td>{{ $peg->nama }}</td>
                                            <td>{{ $peg->bagian->nama_bagian }}</td>

                                            @foreach ($dates as $d)
                                                @php
                                                    // Cari record harian untuk pegawai + tanggal
                                                    $recordsForPeg = $groupedByPegawai->get($peg->id, collect());
                                                    $r = $recordsForPeg->first(
                                                        fn($item) => $item->tanggal->format('Y-m-d') === $d,
                                                    );
                                                @endphp
                                                <td class="text-center">
                                                    @if ($r)
                                                        {{-- Tampilkan checkin–checkout --}}
                                                        {{ $r->waktu_checkin->format('H:i') }}
                                                        -
                                                        {{ $r->waktu_checkout ? $r->waktu_checkout->format('H:i') : '*' }}
                                                    @else
                                                        &ndash;
                                                    @endif
                                                </td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

</style>
@endpush
