<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function index()
    {
        $bagian = Bagian::all();
        return view('admin.bagian.index', compact('bagian'));
    }

    public function create()
    {
        return view('admin.bagian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bagian' => 'required|string|max:100'
        ]);

        Bagian::create($request->only('nama_bagian'));

        return redirect()->route('bagian.index')->with('success', 'Bagian berhasil ditambahkan.');
    }

    public function edit(Bagian $bagian)
    {
        return view('admin.bagian.edit', compact('bagian'));
    }

    public function update(Request $request, Bagian $bagian)
    {
        $request->validate([
            'nama_bagian' => 'required|string|max:100'
        ]);

        $bagian->update($request->only('nama_bagian'));

        return redirect()->route('bagian.index')->with('success', 'Bagian berhasil diperbarui.');
    }

    public function destroy(Bagian $bagian)
    {
        $bagian->delete();

        return redirect()->route('bagian.index')->with('success', 'Bagian berhasil dihapus.');
    }
}

