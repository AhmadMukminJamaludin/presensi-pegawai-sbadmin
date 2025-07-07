<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresensiHarian extends Model
{
    protected $table = 'presensi_harian';
    protected $fillable = ['pegawai_id','tanggal','waktu_checkin','waktu_checkout','status'];

    protected $casts = [
        'tanggal'        => 'date',
        'waktu_checkin'  => 'datetime',
        'waktu_checkout' => 'datetime',
    ];
    
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
