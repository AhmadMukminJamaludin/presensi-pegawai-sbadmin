@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('content')
    <div class="container-fluid">
        <!-- Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Saya</h1>
        </div>

        <!-- Row Statistik Bulanan -->
        <div class="row mb-4">

            <!-- Card Presensi Hari Ini -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Presensi Hari Ini
                        </div>
                        @if ($recordToday)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $recordToday->waktu_checkin->format('H:i') }}
                                @if ($recordToday->waktu_checkout)
                                    - {{ $recordToday->waktu_checkout->format('H:i') }}
                                @else
                                    - *
                                @endif
                            </div>
                            <div class="mt-1 text-muted">Status: {{ ucfirst($recordToday->status) }}</div>
                        @else
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Belum Check‑In</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Total Hadir Bulan Ini -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hadir</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['hadir'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Card Total Terlambat -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Terlambat</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['terlambat'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Card Total Alpha -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Alpha</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['alpha'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Card Total Cuti -->
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cuti</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['cuti'] }}</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Riwayat 7 Hari Terakhir -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Presensi 7 Hari Terakhir</h6>
            </div>
            <div class="card-body table-responsive">
                @if ($history->isEmpty())
                    <p class="text-muted">Belum ada riwayat presensi.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Check‑in</th>
                                <th>Check‑out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $row)
                                <tr>
                                    <td>{{ $row->tanggal->format('d-m-Y') }}</td>
                                    <td>{{ $row->waktu_checkin->format('H:i') }}</td>
                                    <td>
                                        {{ $row->waktu_checkout ? $row->waktu_checkout->format('H:i') : '-' }}
                                    </td>
                                    <td>{{ ucfirst($row->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
@endsection
