@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Bagian</h1>

    <form action="{{ route('bagian.update', $bagian->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Nama Bagian</label>
            <input type="text" name="nama_bagian" class="form-control" value="{{ old('nama_bagian', $bagian->nama_bagian) }}">
            @error('nama_bagian') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('bagian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
