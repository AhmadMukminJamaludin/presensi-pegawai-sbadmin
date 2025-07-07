<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PresensiBulanan;
use App\Models\PresensiHarian;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $year  = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);

        // Ambil data presensi_harian flat untuk tab Harian
        $dailyRecords = PresensiHarian::with('pegawai.bagian')
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderBy('tanggal')
            ->orderBy('pegawai_id')
            ->get();

        // Grouped untuk tab Matriks & Rekap
        $groupedByPegawai = $dailyRecords->groupBy('pegawai_id');

        // Data pegawai untuk rekap/matriks
        $pegawais = Pegawai::with('bagian')->orderBy('nama')->get();

        // Tanggal di bulan itu
        $start = Carbon::create($year, $month, 1);
        $end   = $start->copy()->endOfMonth();
        $period = CarbonPeriod::create($start, $end);
        $dates  = collect($period)->map(fn($d) => $d->format('Y-m-d'));

        // Hitung rekap
        $rekap = $pegawais->map(function ($peg) use ($groupedByPegawai) {
            $h = $groupedByPegawai->get($peg->id, collect());
            return (object)[
                'nip'             => $peg->nip,
                'nama'            => $peg->nama,
                'bagian'          => $peg->bagian->nama_bagian,
                'total_hadir'     => $h->where('status', 'hadir')->count(),
                'total_terlambat' => $h->where('status', 'terlambat')->count(),
                'total_alpha'     => $h->where('status', 'alpha')->count(),
                'total_cuti'      => $h->where('status', 'cuti')->count(),
            ];
        });

        return view('admin.laporan.index', [
            'dailyRecords'      => $dailyRecords,
            'groupedByPegawai'  => $groupedByPegawai,
            'pegawais'          => $pegawais,
            'dates'             => $dates,
            'rekap'             => $rekap,
            'year'              => $year,
            'month'             => $month,
        ]);
    }
}
