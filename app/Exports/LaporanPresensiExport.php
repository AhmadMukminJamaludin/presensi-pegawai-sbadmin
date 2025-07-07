<?php

namespace App\Exports;

use App\Models\Pegawai;
use App\Models\PresensiHarian;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanPresensiExport implements FromView, ShouldAutoSize
{
    protected $year;
    protected $month;

    public function __construct(int $year, int $month)
    {
        $this->year  = $year;
        $this->month = $month;
    }

    public function view(): View
    {
        // Data pegawai
        $pegawais = Pegawai::with('bagian')->orderBy('nama')->get();

        // Data harian & grouping
        $daily = PresensiHarian::whereYear('tanggal', $this->year)
            ->whereMonth('tanggal', $this->month)
            ->get()
            ->groupBy('pegawai_id');

        // Tanggal di bulan
        $start  = Carbon::create($this->year, $this->month, 1);
        $end    = $start->copy()->endOfMonth();
        $period = CarbonPeriod::create($start, $end);
        $dates  = collect($period)->map(fn($d) => $d->format('Y-m-d'));

        // Ringkasan rekap
        $rekap = $pegawais->map(function($peg) use ($daily) {
            $h = $daily->get($peg->id, collect());
            return (object)[
                'nip'             => $peg->nip,
                'nama'            => $peg->nama,
                'bagian'          => $peg->bagian->nama_bagian,
                'hadir'           => $h->where('status','hadir')->count(),
                'terlambat'       => $h->where('status','terlambat')->count(),
                'alpha'           => $h->where('status','alpha')->count(),
                'cuti'            => $h->where('status','cuti')->count(),
            ];
        });

        return view('admin.laporan.excel', [
            'pegawais' => $pegawais,
            'daily'    => $daily,
            'dates'    => $dates,
            'rekap'    => $rekap,
            'year'     => $this->year,
            'month'    => $this->month,
        ]);
    }
}
