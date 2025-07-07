@extends('layouts.app')

@section('title', 'Ubah Pengaturan')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Ubah Pengaturan</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('pengaturan.update', $pengaturan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Kunci</label>
                        <input type="text" class="form-control" value="{{ $pengaturan->kunci }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="text" name="nilai" id="nilai"
                            class="form-control @error('nilai') is-invalid @enderror"
                            value="{{ old('nilai', $pengaturan->nilai) }}">
                        @error('nilai')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('pengaturan.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
