<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\Mekanik;
use App\Models\Sparepart;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin default
        User::create([
            'name' => 'Admin Bengkel',
            'email' => 'admin@bengkel.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Akun customer contoh
        User::create([
            'name' => 'Ferdy',
            'email' => 'customer@bengkel.test',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '089876543210',
        ]);

        // Layanan servis
        Layanan::insert([
            ['nama' => 'Ganti Oli', 'deskripsi' => 'Ganti oli mesin standar', 'harga' => 65000, 'estimasi_menit' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Servis Ringan', 'deskripsi' => 'Cek rutin, setel rantai, rem', 'harga' => 50000, 'estimasi_menit' => 45, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Servis Berat', 'deskripsi' => 'Turun mesin, overhaul', 'harga' => 250000, 'estimasi_menit' => 180, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Tambal Ban', 'deskripsi' => 'Tambal ban bocor', 'harga' => 15000, 'estimasi_menit' => 15, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Mekanik
        Mekanik::insert([
            ['nama' => 'Budi Santoso', 'no_hp' => '081111111111', 'spesialisasi' => 'Mesin', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Anto Wijaya', 'no_hp' => '082222222222', 'spesialisasi' => 'Kelistrikan', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sparepart
        Sparepart::insert([
            ['kode' => 'OLI-001', 'nama' => 'Oli Mesin 1L', 'stok' => 50, 'harga' => 45000, 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KMP-001', 'nama' => 'Kampas Rem Depan', 'stok' => 20, 'harga' => 35000, 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'BAN-001', 'nama' => 'Ban Luar Standar', 'stok' => 10, 'harga' => 180000, 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'BSI-001', 'nama' => 'Busi Standar', 'stok' => 30, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
