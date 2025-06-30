<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;         // <-- Import model User
use App\Models\Role;          // <-- Import model Role
use Illuminate\Support\Facades\Hash; // <-- Import Hash

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Cari role 'admin'
        $adminRole = Role::where('name', 'admin')->first();

        // Jika role 'admin' tidak ditemukan, seeder ini tidak akan melakukan apa-apa.
        // Pastikan Anda sudah menjalankan RoleSeeder terlebih dahulu.
        if ($adminRole) {
            // 2. Buat user admin
            // Menggunakan firstOrCreate untuk menghindari duplikat jika seeder dijalankan berkali-kali
            $adminUser = User::firstOrCreate(
            ['email' => 'admin@travel.com'], // Kunci untuk mencari
                [
                    'name' => 'Administrator',
                    'password' => Hash::make('admin123'), // Ganti 'password' dengan password yang aman
                ]
            );

            // 3. Hubungkan user dengan role admin
            // `syncRoles` akan menghapus role lain dan hanya menetapkan role 'admin'
            $adminUser->roles()->sync($adminRole);
        }
    }
}