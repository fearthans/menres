<?php

namespace Database\Seeders;

use App\Models\Risiko;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $risikos = [
            [
                'kode' => 'R1.1',
                'id_aset' => 1,
                'kerentanan' => 'Kesadaran keamanan yang kurang',
                'ancaman' => 'Data dibobol dan disalahgunakan orang yang tidak berwenang',
                'potensi_sebab' => 'Akses menggunakan komputer umum yang dipasang aplikasi spy',
                'potensi_efek' => 'Kebocoran informasi',
                'mitigation' => 'Membuat password yang kuat dan menambahkan akun penanggung jawab',
            ],
            [
                'kode' => 'R1.2',
                'id_aset' => 1,
                'kerentanan' => 'Ancaman orang dalam',
                'ancaman' => 'Data berubah',
                'potensi_sebab' => 'Mengubah data langsung ke sistem aplikasi siakad',
                'potensi_efek' => 'Data tidak valid',
                'mitigation' => 'Mengubah data langsung ke sistem aplikasi siakad'
            ],
            [
                'kode' => 'R1.3',
                'id_aset' => 1,
                'kerentanan' => 'Ancaman orang dalam',
                'ancaman' => 'Data hilang atau tidak tersedia',
                'potensi_sebab' => 'Kesalahan setting periode atau tahun ajaran pada aplikasi siakad',
                'potensi_efek' => 'Data hilang atau terhapus',
            ],
            [
                'kode' => 'R2.1',
                'id_aset' => 2,
                'kerentanan' => 'Serangan DDoS, malware atau kode berbahaya',
                'ancaman' => 'Akses sistem lambat atau tidak tersedia',
                'potensi_sebab' => 'Serangan DDoS, malware atau kode berbahaya (hacker)',
                'potensi_efek' => 'Akses layanan sistem lambat atau tidak tersedia',
                'mitigation' => 'Menghindari serangan DDoS, malware atau kode berbahaya'
            ],
            [
                'kode' => 'R2.2',
                'id_aset' => 2,
                'kerentanan' => 'Serangan deface',
                'ancaman' => 'Tampilan halaman utama web berubah',
                'potensi_sebab' => 'Serangan deface (hacker)',
                'potensi_efek' => 'Tampilan halaman utama web berubah'
            ],
            [
                'kode' => 'R2.3',
                'id_aset' => 2,
                'kerentanan' => 'Kesadaran keamanan yang kurang',
                'ancaman' => 'Data login diketahui orang yang tidak berwenang dan penyalahgunaan data',
                'potensi_sebab' => 'Akses menggunakan komputer umum yang dipasang spy atau sharing email dan password',
                'potensi_efek' => 'Kebocoran informasi'
            ],
            [
                'kode' => 'R2.4',
                'id_aset' => 2,
                'kerentanan' => 'Kesadaran keamanan yang kurang',
                'ancaman' => 'Perubahan data LIRS, login, dll',
                'potensi_sebab' => 'Akses menggunakan komputer umum yang dipasang spy atau sharing email dan password',
                'potensi_efek' => 'Kebocoran data Siakad (LIRS, login, dll)'
            ],
            [
                'kode' => 'R3.1',
                'id_aset' => 3,
                'kerentanan' => 'Kesadaran keamanan yang kurang',
                'ancaman' => 'Perubahan pengaturan (setting) server',
                'potensi_sebab' => 'Data pada server diketahui orang yang tidak berwenang',
                'potensi_efek' => 'Perubahan pengaturan (setting) server',
                'mitigation' => 'Menghindari perubahan pengaturan (setting) server'
            ],
            [
                'kode' => 'R3.2',
                'id_aset' => 3,
                'kerentanan' => 'Kesadaran keamanan yang kurang',
                'ancaman' => 'Server down',
                'potensi_sebab' => 'Data pada server diketahui orang yang tidak berwenang',
                'potensi_efek' => 'Server down'
            ],
            [
                'kode' => 'R3.3',
                'id_aset' => 3,
                'kerentanan' => 'Terlalu panas',
                'ancaman' => 'Server panas atau rusak',
                'potensi_sebab' => 'Listrik tidak stabil',
                'potensi_efek' => 'Server panas atau rusak'
            ],
            [
                'kode' => 'R3.4',
                'id_aset' => 3,
                'kerentanan' => 'Serangan pemblokiran access point',
                'ancaman' => 'Koneksi Internet Putus.',
                'potensi_sebab' => 'Serangan duplikasi alamat IP (hacker)',
                'potensi_efek' => 'Koneksi Internet Terputus'
            ],
            [
                'kode' => 'R3.5',
                'id_aset' => 3,
                'kerentanan' => 'Serangan duplikasi alamat IP',
                'ancaman' => 'Sistem crash atau error',
                'potensi_sebab' => 'Serangan duplikasi alamat IP (hacker)',
                'potensi_efek' => 'Sistem Crash atau Error'
            ],
            [
                'kode' => 'R4.1',
                'id_aset' => 4,
                'kerentanan' => 'Kerentanan terhadap penyimpanan yang tidak dilindungi',
                'ancaman' => 'Sistem error data terhapus atau tidak bisa disimpan',
                'potensi_sebab' => 'Spek perangkat memori CPU, komputer tidak memenuhi layanan',
                'potensi_efek' => 'System Error Data Terhapus Atau Tidak Bisa Disimpan',
                'mitigation' => 'Menghindari kerentanan terhadap penyimpanan yang tidak dilindungi'
            ],
            [
                'kode' => 'R4.2',
                'id_aset' => 4,
                'kerentanan' => 'Terlalu panas',
                'ancaman' => 'Server panas atau rusak',
                'potensi_sebab' => 'Listrik Tidak Stabil',
                'potensi_efek' => 'Server panas atau rusak'
            ],
            [
                'kode' => 'R4.3',
                'id_aset' => 4,
                'kerentanan' => 'Ancaman Orang Dalam',
                'ancaman' => 'Akses Jaringan Terputus',
                'potensi_sebab' => 'Masalah konfigurasi fisik kabel lepas',
                'potensi_efek' => 'Akses Jaringan Terputus'
            ],
            [
                'kode' => 'R5.1',
                'id_aset' => 5,
                'kerentanan' => 'Ancaman orang dalam dan luar',
                'ancaman' => 'Akses Koneksi Internet Terputus',
                'potensi_sebab' => 'Human error kabel tersentuh atau ditarik saat beraktivitas',
                'potensi_efek' => 'Akses Koneksi Internet Terputus',
                'mitigation' => 'Menghindari Akses Koneksi Internet Terputus'
            ],
            [
                'kode' => 'R5.2',
                'id_aset' => 5,
                'kerentanan' => 'Jalur komunikasi yang tidak terlindungi (tidak ada kebijakan izin pemutusan kabel dan ganti rugi yang jelas ke pihak UPT. TIK XYZ)',
                'ancaman' => 'Akses koneksi internet ke client atau server terputus',
                'potensi_sebab' => 'Pembangunan yang memutuskan kabel tanpa izin yang jelas',
                'potensi_efek' => 'Akses Koneksi Internet Client Atau Server Terputus'
            ],
            [
                'kode' => 'R5.3',
                'id_aset' => 5,
                'kerentanan' => 'Jalur komunikasi yang tidak terlindungi (tidak ada kebijakan izin pemutusan kabel dan ganti rugi yang jelas ke pihak UPT. TIK XYZ)',
                'ancaman' => 'Rugi secara finansial, waktu, tenaga dalam perbaikan infrastruktur yang hancur',
                'potensi_sebab' => 'Pembangunan yang Memutuskan kabel tanpa izin yang jelas',
                'potensi_efek' => 'Kerugian Secara Finansial, waktu, tenaga dalam perbaikan infrastruktur yang hancur'
            ],        
        ];

        foreach ($risikos as $risiko) {
            Risiko::create([
                'kode' => $risiko['kode'],
                'id_aset' => $risiko['id_aset'],
                'kerentanan' => $risiko['kerentanan'],
                'ancaman' => $risiko['ancaman'],
                'potensi_sebab' => $risiko['potensi_sebab'],
                'potensi_efek' => $risiko['potensi_efek'],
                'severity' => random_int(1, 8),
                'occurrence' => random_int(1, 8),
                'detection' =>  random_int(1, 8),
                'mitigation' => $risiko['mitigation'] ?? null,
                'mitigation_date' => isset($risiko['mitigation']) ? date('Y-m-d H:i:s') : null
            ]);
        }
    }
}
