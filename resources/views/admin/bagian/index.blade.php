@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Bagian</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('bagian.create') }}" class="btn btn-primary mb-3">+ Tambah Bagian</a>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Bagian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bagian as $bg)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bg->nama_bagian }}</td>
                            <td>
                                <a href="{{ route('bagian.edit', $bg->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('bagian.destroy', $bg->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
