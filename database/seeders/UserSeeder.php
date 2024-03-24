<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'Admin IP',
            'email' => 'admin@intanpariwara.com',
            'password' => Hash::make('@dMIN123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        DB::table('users')->insert([
            'username' => 'Pengurus IP',
            'email' => 'pengurus@intanpariwara.com',
            'password' => Hash::make('@IP_pengurus'),
            'role' => 'pengurus',
            'status' => 'active',
        ]);

        DB::table('users')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}