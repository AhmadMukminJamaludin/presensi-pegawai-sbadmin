@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Bagian</h1>

    <form action="{{ route('bagian.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Bagian</label>
            <input type="text" name="nama_bagian" class="form-control" value="{{ old('nama_bagian') }}">
            @error('nama_bagian') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('bagian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
