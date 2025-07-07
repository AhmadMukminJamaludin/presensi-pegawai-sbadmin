<?php

namespace App\Http\Controllers;

use App\Models\PresensiHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek record hari ini
        $today = Carbon::today();
        $record = PresensiHarian::where('pegawai_id', $user->id)
                    ->where('tanggal', $today)
                    ->first();

        // Ambil riwayat 7 hari terakhir
        $history = PresensiHarian::where('pegawai_id', $user->id)
                     ->latest('tanggal')
                     ->take(7)
                     ->get();

        return view('pegawai.presensi.index', compact('record','history'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $today = Carbon::today();
        if (PresensiHarian::where('pegawai_id', $user->id)->where('tanggal', $today)->exists()) {
            return back()->with('error','Anda sudah melakukan check‑in hari ini.');
        }

        PresensiHarian::create([
            'pegawai_id'    => $user->id,
            'tanggal'       => $today,
            'waktu_checkin' => Carbon::now()->timezone(config('app.timezone')),
            'status'        => (Carbon::now()->gt(
                                 Carbon::parse(config('setting.jam_mulai_kerja','08:00:00'))
                               ) ? 'terlambat' : 'hadir'),
        ]);

        return back()->with('success','Check‑in berhasil.');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $record = PresensiHarian::where('pegawai_id',$user->id)
                   ->where('tanggal', Carbon::today())
                   ->firstOrFail();

        if ($record->waktu_checkout) {
            return back()->with('error','Anda sudah check‑out hari ini.');
        }

        $record->update([
            'waktu_checkout' => Carbon::now(),
        ]);

        return back()->with('success','Check‑out berhasil.');
    }
}
