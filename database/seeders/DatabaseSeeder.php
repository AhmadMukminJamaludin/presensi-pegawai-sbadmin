<?php

namespace Database\Seeders;

use App\Models\Bagian;
use App\Models\Pegawai;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $bagianSales = Bagian::create(['nama_bagian' => 'Sales']);
        $bagianService = Bagian::create(['nama_bagian' => 'Service']);
        $bagianGudang = Bagian::create(['nama_bagian' => 'Gudang']);

        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'pegawai', 'guard_name' => 'web']);

        $admin = Pegawai::create([
            'nip' => 'TK0001',
            'nama' => 'Admin Toko',
            'email' => 'admin@toko.test',
            'password' => bcrypt('password'),
            'bagian_id' => $bagianSales->id,
        ]);
        $admin->assignRole('admin');
    }
}
