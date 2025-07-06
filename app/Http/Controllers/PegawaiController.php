<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Bagian;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('bagian')->paginate(10);
        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $bagian = Bagian::all();
        return view('admin.pegawai.create', compact('bagian'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nip'        => 'required|unique:pegawai,nip',
            'nama'       => 'required|string',
            'email'      => 'required|email|unique:pegawai,email',
            'password'   => 'required|confirmed|min:6',
            'bagian_id'  => 'required|exists:bagian,id',
        ]);

        $data['password'] = bcrypt($data['password']);
        $pegawai = Pegawai::create($data);
        $pegawai->assignRole('pegawai');

        return redirect()->route('pegawai.index')
                         ->with('success','Pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai)
    {
        $bagian = Bagian::all();
        return view('admin.pegawai.edit', compact('pegawai','bagian'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $data = $request->validate([
            'nip'        => 'required|unique:pegawai,nip,'.$pegawai->id,
            'nama'       => 'required|string',
            'email'      => 'required|email|unique:pegawai,email,'.$pegawai->id,
            'password'   => 'nullable|confirmed|min:6',
            'bagian_id'  => 'required|exists:bagian,id',
        ]);

        if ($data['password'] ?? false) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')
                         ->with('success','Pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')
                         ->with('success','Pegawai berhasil dihapus.');
    }
}
