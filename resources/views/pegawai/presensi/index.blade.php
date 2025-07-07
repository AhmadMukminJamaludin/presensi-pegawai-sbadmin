@extends('layouts.app')

@section('title', 'Presensi Saya')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Presensi Hari Ini</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body text-center">
                @if (!$record)
                    {{-- Tombol Check-in --}}
                    <form action="{{ route('presensi.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Check‑In
                        </button>
                    </form>
                @elseif(!$record->waktu_checkout)
                    <p><strong>Check‑in:</strong> {{ date('H:i:s', strtotime($record->waktu_checkin)) }}</p>
                    {{-- Tombol Check-out --}}
                    <form action="{{ route('presensi.update', $record->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fas fa-sign-out-alt"></i> Check‑Out
                        </button>
                    </form>
                @else
                    <p><strong>Check‑in :</strong> {{ date('H:i:s', strtotime($record->waktu_checkin)) }}</p>
                    <p><strong>Check‑out:</strong> {{ date('H:i:s', strtotime($record->waktu_checkout)) }}</p>
                    <span class="badge badge-info">{{ strtoupper($record->status) }}</span>
                @endif
            </div>
        </div>

        {{-- Riwayat 7 Hari Terakhir --}}
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat 7 Hari Terakhir</h6>
            </div>
            <div class="card-body table-responsive">
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
                        @forelse($history as $h)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($h->tanggal)) }}</td>
                                <td>{{ date('H:i', strtotime($h->waktu_checkin)) }}</td>
                                <td>{{ $h->waktu_checkout ? date('H:i', strtotime($h->waktu_checkout)) : '-' }}</td>
                                <td>{{ ucfirst($h->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada riwayat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
