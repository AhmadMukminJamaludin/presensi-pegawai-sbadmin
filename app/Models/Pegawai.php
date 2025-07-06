<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Pegawai extends Authenticatable
{
    use HasRoles;
    protected $table = 'pegawai';
    protected $fillable = ['nip','nama','email','password','bagian_id'];
    protected $hidden = ['password','remember_token'];
    protected $guard_name = 'web';

    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }

    public function presensiHarian()
    {
        return $this->hasMany(PresensiHarian::class);
    }

    public function presensiBulanan()
    {
        return $this->belongsToMany(PresensiBulanan::class, 'pegawai_presensi_bulanan')
                    ->withPivot(['total_hadir','total_terlambat','total_alpha','total_cuti'])
                    ->withTimestamps();
    }
}
