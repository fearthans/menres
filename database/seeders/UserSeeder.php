<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role 'admin' ada atau buat jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Membuat user baru dan menetapkan role 'admin'
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
        ]);

        $admin->assignRole($adminRole);

        $riskOwnerRole = Role::firstOrCreate(['name' => 'risk_owner']);
        $riskOwner = User::create([
            'name' => 'Risk Owner',
            'email' => 'riskOwner@email.com',
            'password' => bcrypt('123456'),
        ]);
        $riskOwner->assignRole($riskOwnerRole);
        
        $kepalaUptRole = Role::firstOrCreate(['name' => 'kepala_upt']);
        $kepalaUpt = User::create([
            'name' => 'Kepala UPT',
            'email' => 'kepalaUpt@email.com',
            'password' => bcrypt('123456'),
        ]);
        $kepalaUpt->assignRole($kepalaUptRole);

        $operatorRole = Role::firstOrCreate(['name' => 'operator']);
        $operator = User::create([
            'name' => 'Operator',
            'email' => 'operator@email.com',
            'password' => bcrypt('123456'),
        ]);
        $operator->assignRole($operatorRole);
    }
}
