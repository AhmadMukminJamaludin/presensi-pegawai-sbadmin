@extends('layouts.app')

@section('title','Tambah Pegawai')

@section('content')
<div class="card shadow mb-4">
  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Tambah Pegawai</h6>
  </div>
  <div class="card-body">
    <form action="{{ route('pegawai.store') }}" method="POST">
      @include('admin.pegawai._form')
      <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Simpan
      </button>
      <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
