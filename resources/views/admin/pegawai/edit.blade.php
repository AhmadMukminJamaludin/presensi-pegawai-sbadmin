@extends('layouts.app')

@section('title','Ubah Pegawai')

@section('content')
<div class="card shadow mb-4">
  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Ubah Pegawai</h6>
  </div>
  <div class="card-body">
    <form action="{{ route('pegawai.update', $pegawai) }}" method="POST">
      @method('PUT')
      @include('admin.pegawai._form')
      <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Update
      </button>
      <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
