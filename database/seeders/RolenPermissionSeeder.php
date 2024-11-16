<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolenPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            //admin
            "kelola-role",
            "kelola-pengguna",

            //risk_owner
            "dashboard",
            "identifikasi-risiko",
            "analisis-risiko",
            "evaluasi-risiko",
            
            //operator
            "kelola-kategori-aset",
            "kelola-informasi-aset",
            "kelola-persyaratan-keamanan",

            //kepala_upt
            "lihat-profile-risiko"
        ];

        foreach ($permission as $value) {
            Permission::create(["name" => $value]);
        }
        
        $admin = Role::create(["name" => "admin"]);
        $admin->givePermissionTo(["kelola-role", "kelola-pengguna"]);

        Role::create(["name" => "risk_owner"]);
        Role::create(["name" => "operator"]);
        Role::create(["name" => "kepala_upt"]);
        Role::create(["name" => "dummy"]);

        // $admin->givePermissionTo(["kelola-pengguna"]);
        // $operator->givePermissionTo(["kelola-kategori-aset", "kelola-informasi-aset"]);
    }
}
