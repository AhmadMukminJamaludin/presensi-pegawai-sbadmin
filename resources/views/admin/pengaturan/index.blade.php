@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Pengaturan Sistem</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kunci</th>
                            <th>Nilai</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $set)
                            <tr>
                                <td>{{ $set->kunci }}</td>
                                <td>{{ $set->nilai }}</td>
                                <td>
                                    <a href="{{ route('pengaturan.edit', $set) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
