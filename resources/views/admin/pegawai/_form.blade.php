@csrf

<div class="form-group">
  <label for="nip">NIP</label>
  <input type="text" name="nip" id="nip"
         class="form-control @error('nip') is-invalid @enderror"
         value="{{ old('nip', $pegawai->nip ?? '') }}">
  @error('nip')<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

<div class="form-group">
  <label for="nama">Nama</label>
  <input type="text" name="nama" id="nama"
         class="form-control @error('nama') is-invalid @enderror"
         value="{{ old('nama', $pegawai->nama ?? '') }}">
  @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

<div class="form-group">
  <label for="email">Email</label>
  <input type="email" name="email" id="email"
         class="form-control @error('email') is-invalid @enderror"
         value="{{ old('email', $pegawai->email ?? '') }}">
  @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

<div class="form-group">
  <label for="bagian_id">Bagian</label>
  <select name="bagian_id" id="bagian_id"
          class="form-control @error('bagian_id') is-invalid @enderror">
    <option value="">-- Pilih Bagian --</option>
    @foreach($bagian as $b)
      <option value="{{ $b->id }}"
        {{ old('bagian_id', $pegawai->bagian_id ?? '') == $b->id ? 'selected' : '' }}>
        {{ $b->nama_bagian }}
      </option>
    @endforeach
  </select>
  @error('bagian_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

<div class="form-group">
  <label for="password">Password
    @if(isset($pegawai))<small>(kosongkan jika tidak diubah)</small>@endif
  </label>
  <input type="password" name="password" id="password"
         class="form-control @error('password') is-invalid @enderror">
  @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
</div>

<div class="form-group">
  <label for="password_confirmation">Konfirmasi Password</label>
  <input type="password" name="password_confirmation" id="password_confirmation"
         class="form-control">
</div>
