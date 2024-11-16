<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolenPermissionSeeder::class,
            UserSeeder::class,
            KategoriAsetSeeder::class,
            AsetSeeder::class,
            PersyaratanKeamananSeeder::class,
            RisikoSeeder::class
        ]);
    }
}
