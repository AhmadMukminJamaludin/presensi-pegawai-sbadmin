@extends('layouts.app')

@section('title','Daftar Pegawai')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 text-gray-800">Daftar Pegawai</h1>
  <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Pegawai
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Bagian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pegawai as $p)
          <tr>
            <td>{{ $p->nip }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->email }}</td>
            <td>{{ $p->bagian->nama_bagian }}</td>
            <td>
              <a href="{{ route('pegawai.edit', $p) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
              </a>
              <form action="{{ route('pegawai.destroy', $p) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Hapus pegawai ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $pegawai->links() }}
    </div>
  </div>
</div>
@endsection
