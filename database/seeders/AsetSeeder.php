<?php

namespace Database\Seeders;

use App\Models\InformasiAsetKritis;
use App\Models\KategoriAsetKritis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asetData = [
            'Data' => [
                [
                    'name' => 'Data Nilai',
                    'deskripsi' => 'Data yang krusial terkait penilaian dosen kepada mahasiswa sehingga membuatkan data dan informasi yang valid untuk proses perkuliahan',
                ],
            ],
            'Sistem' => [
                [
                    'name' => 'SIAKAD',
                    'deskripsi' => 'Siakad memiliki runtutan proses yang saling mempengaruhi untuk layanan penerimaan mahasiswa baru, daftar ulang mahasiswa, jadwal perkuliahan dan penilaian perkuliahan',
                ],
            ],
            'Hardware' => [
                [
                    'name' => 'Server Jaringan',
                    'deskripsi' => 'Server jaringan merupakan komputer dan komponen lainnya yang menggunakan mikrotik router sebagai server',
                ],
                [
                    'name' => 'Kabel',
                    'deskripsi' => 'Kabel sebagai base jaringan dan listrik semua peralatan berhubungan dengan listrik dan tidak dapat berjalan tanpa listrik',
                ],
                [
                    'name' => 'Server Database',
                    'deskripsi' => 'Server database merupakan komputer server dan perangkat lainnya yang mengolah dan menyimpan data SIAKAD',
                ],
            ],
            'Orang' => [
                [
                    'name' => 'Admin Database',
                    'deskripsi' => 'Orang yang mengkondisikan, server database dapat berjalan dalam keadaan baik dan koneksi tersedia setiap saat dan bertanggung jawab menjaga keamanan data dalam memenuhi kebutuhan layanan data',
                ],
                [
                    'name' => 'Operator Siakad',
                    'deskripsi' => 'Admin orang yang mengelola aplikasi dan operator SIAKAD orang memiliki level otoritas yang berbeda-beda di fakultas atau Prodi bisa melakukan input, mengubah dan menghapus data terkait layanan akademik seperti penjadwalan, rencana studi, data nilai dan lain sebagainya',
                ],
                [
                    'name' => 'Admin Jaringan',
                    'deskripsi' => 'Bertanggung jawab terkait berjalannya layanan internet yang mempunyai hak akses penuh dan kontrol atas dirinya sendiri dalam penanganan masalah jaringan yang putus dan lainnya',
                ],
                [
                    'name' => 'Programmer',
                    'deskripsi' => 'Programmer di posisi kan sesuai job desk masing-masing sistem layanan dan memiliki tanggung jawab atas performa produk layanan yang dihasilkan untuk memenuhi kebutuhan, memperbaiki kekurangan dari masalah bug, antarmuka website',
                ],
            ],
        ];

        foreach ($asetData as $kategoriNama => $asetList) {
            $kategori = KategoriAsetKritis::where('name', $kategoriNama)->first();

            if ($kategori) {
                foreach ($asetList as $aset) {
                    InformasiAsetKritis::create([
                        'id_kategori' => $kategori->id,
                        'name' => $aset['name'],
                        'deskripsi' => $aset['deskripsi'],
                        'created_at' => Carbon::now()->subDays(rand(0, 60)),
                    ]);
                }
            }
        }
    }
}
