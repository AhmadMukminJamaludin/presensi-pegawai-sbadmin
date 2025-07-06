<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresensiBulanan extends Model
{
    protected $table = 'presensi_bulanan';
    protected $fillable = ['tahun','bulan'];

    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_presensi_bulanan')
                    ->withPivot(['total_hadir','total_terlambat','total_alpha','total_cuti'])
                    ->withTimestamps();
    }
}
