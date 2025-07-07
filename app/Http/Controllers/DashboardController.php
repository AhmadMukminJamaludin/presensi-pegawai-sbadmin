<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Bagian;
use App\Models\PresensiHarian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $today         = Carbon::today();
        $totalPeg      = Pegawai::count();
        $totalBag      = Bagian::count();
        $presensiToday = PresensiHarian::whereDate('tanggal', $today)->count();
        $lateToday     = PresensiHarian::whereDate('tanggal', $today)
                            ->where('status','terlambat')
                            ->count();

        // Chart: jumlah presensi per bulan untuk tahun berjalan
        $year = $today->year;
        $raw = PresensiHarian::selectRaw('MONTH(tanggal) as month, COUNT(*) as cnt')
                ->whereYear('tanggal', $year)
                ->groupBy('month')
                ->pluck('cnt','month')
                ->toArray();

        // Pastikan semua bulan ada (1–12)
        $chartData = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartData[] = $raw[$m] ?? 0;
        }
        // Labels nama bulan
        $chartLabels = collect(range(1,12))
                        ->map(fn($m) => Carbon::create()->month($m)->format('M'))
                        ->toArray();

        return view('admin.dashboard', compact(
            'totalPeg','totalBag','presensiToday','lateToday',
            'chartLabels','chartData'
        ));
    }

    public function indexPegawai()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Record hari ini (bisa null jika belum check‑in)
        $recordToday = PresensiHarian::where('pegawai_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        // Statistik bulan ini
        $month  = $today->month;
        $year   = $today->year;
        $monthly = PresensiHarian::where('pegawai_id', $user->id)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month);

        $stats = [
            'hadir'     => $monthly->where('status','hadir')->count(),
            'terlambat' => $monthly->where('status','terlambat')->count(),
            'alpha'     => $monthly->where('status','alpha')->count(),
            'cuti'      => $monthly->where('status','cuti')->count(),
        ];

        // Riwayat 7 hari terakhir
        $history = PresensiHarian::where('pegawai_id', $user->id)
            ->latest('tanggal')
            ->take(7)
            ->get();

        return view('pegawai.dashboard', compact('recordToday','stats','history'));
    }
}
