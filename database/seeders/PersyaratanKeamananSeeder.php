<?php

namespace Database\Seeders;

use App\Models\InformasiAsetKritis;
use App\Models\PersyaratanKeamanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersyaratanKeamananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataPersyaratan = [
            'Data Nilai' => [
                [
                    'jenis' => '2',
                    'kebutuhan' => 'Data akurat konsisten tidak berubah tanpa izin dari yang berhak memberi nilai.',
                ]
            ],
            'SIAKAD' => [
                [
                    'jenis' => '2',
                    'kebutuhan' => 'Dapat diakses cepat, tepat, dan tersedia 24/7.',
                ]
            ],
            'Server Jaringan' => [
                [
                    'jenis' => '3',
                    'kebutuhan' => 'Dapat diakses cepat, tepat dan tersedia 24/7.',
                ]
            ],
            'Kabel' => [
                [
                    'jenis' => '3',
                    'kebutuhan' => 'Stok kabel cadangan tersedia 10% ketika dibutuhkan kabel tetap tersambung dengan aman.',
                ]
            ],
            'Server Database' => [
                [
                    'jenis' => '3',
                    'kebutuhan' => 'Performa akses data cepat dan dapat diakses 24/7.',
                ]
            ],
            'Admin Database' => [
                [
                    'jenis' => '2',
                    'kebutuhan' => 'Berlaku jujur bertanggung jawab, dan memiliki kemampuan.',
                ]
            ],
            'Operator Siakad' => [
                [
                    'jenis' => '2',
                    'kebutuhan' => 'Berlaku jujur dan bertanggung jawab atas validitas data dan cepat/tanggap dalam penanganan masalah sistem.',
                ]
            ],
            'Programmer' => [
                [
                    'jenis' => '1',
                    'kebutuhan' => 'Berlaku jujur bertanggung jawab, dan memiliki kemampuan.',
                ]
            ],
            'Admin Jaringan' => [
                [
                    'jenis' => '2',
                    'kebutuhan' => 'Berlaku jujur bertanggung jawab, dan memiliki kemampuan terhadap ketersediaan layanan internet.',
                ]
            ],
        ];

        foreach ($dataPersyaratan as $namaAset => $persyaratanList) {
            $aset = InformasiAsetKritis::where('name', $namaAset)->first();

            if ($aset) {
                foreach ($persyaratanList as $persyaratan) {
                    PersyaratanKeamanan::create([
                        'id_aset' => $aset->id,
                        'jenis' => $persyaratan['jenis'],
                        'kebutuhan' => $persyaratan['kebutuhan'],
                    ]);
                }
            }
        }
    }
}
