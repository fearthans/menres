<?php

namespace Database\Seeders;

use App\Models\KategoriAsetKritis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriAsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriAsetData = ['Data', 'Sistem', 'Hardware', 'Orang'];

        foreach ($kategoriAsetData as $kategori) {
            KategoriAsetKritis::create([
                'name' => $kategori,
            ]);
        }
    }
}
