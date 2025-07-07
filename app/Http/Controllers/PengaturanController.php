<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $settings = Pengaturan::orderBy('kunci')->get();
        return view('admin.pengaturan.index', compact('settings'));
    }

    public function edit(Pengaturan $pengaturan)
    {
        return view('admin.pengaturan.edit', compact('pengaturan'));
    }

    public function update(Request $request, Pengaturan $pengaturan)
    {
        $data = $request->validate([
            'nilai' => 'required|string',
        ]);

        $pengaturan->update($data);

        return redirect()
            ->route('pengaturan.index')
            ->with('success', 'Pengaturan "' . $pengaturan->kunci . '" berhasil diperbarui.');
    }
}
