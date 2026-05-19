<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data yang diekstrak dari HTML
        $data = [
            'Pemuda' => [
                'Wirausaha Muda',
                'Pemuda Usia 16-30',
                'Pemuda Pelopor',
                'Pemuda Berprestasi',
                'Indikator'
            ],
            'Olahraga' => [
                'Olahraga Prestasi',
                'Olahraga Disabilitas',
                'Olahraga Masyarakat',
                'Indikator.'
            ],
            'Sarana dan Prasarana' => [
                'Sapras Kepemudaan',
                'Sapras Keolahragaan'
            ],
            'Organisasi' => [
                'Organisasi Pramuka',
                'Organisasi Pemuda',
                'Organisasi Olahraga'
            ]
        ];

        $now = Carbon::now();
        $kategoriOrder = 1;

        // Looping untuk insert Kategori dan Sub Kategori
        foreach ($data as $namaKategori => $subKategoris) {
            
            // 1. Insert Kategori dan ambil ID-nya
            $kategoriId = DB::table('kategoris')->insertGetId([
                'nama_kategori' => $namaKategori,
                'ordering'      => $kategoriOrder++,
                'deskripsi'     => 'Kategori ' . $namaKategori,
                'is_active'     => true,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            $subKategoriOrder = 1;

            // 2. Insert Sub Kategori berdasarkan ID Kategori di atas
            foreach ($subKategoris as $namaSub) {
                DB::table('sub_kategoris')->insert([
                    'kategori_id'       => $kategoriId,
                    'nama_sub_kategori' => $namaSub,
                    'ordering'          => $subKategoriOrder++,
                    'deskripsi'         => 'Sub Kategori ' . $namaSub,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ]);
            }
        }
    }
}