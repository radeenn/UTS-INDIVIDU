<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Surat::query()->delete();

        $samples = [
            [
                'nomor_surat' => 'SK-2026/001',
                'jenis_surat' => 'Keterangan domisili',
                'nama_warga' => 'Budi Santoso',
                'nik' => '3201010101010001',
                'keperluan' => 'Pengurusan listrik rumah tangga.',
                'status' => 'selesai',
                'tanggal_surat' => now()->subDays(5)->toDateString(),
                'catatan_admin' => 'Sudah ditandatangani lurah.',
            ],
            [
                'nomor_surat' => 'SK-2026/002',
                'jenis_surat' => 'Pengantar nikah',
                'nama_warga' => 'Siti Aminah',
                'nik' => '3201010101010002',
                'keperluan' => 'Administrasi di KUA.',
                'status' => 'diproses',
                'tanggal_surat' => now()->subDay()->toDateString(),
                'catatan_admin' => null,
            ],
            [
                'nomor_surat' => 'SK-2026/003',
                'jenis_surat' => 'Keterangan tidak mampu',
                'nama_warga' => 'Ahmad Fauzi',
                'nik' => null,
                'keperluan' => 'Beasiswa sekolah.',
                'status' => 'diajukan',
                'tanggal_surat' => now()->toDateString(),
                'catatan_admin' => null,
            ],
        ];

        foreach ($samples as $row) {
            Surat::create($row);
        }
    }
}
