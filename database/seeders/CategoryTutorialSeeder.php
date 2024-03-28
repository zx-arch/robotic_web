<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_tutorial')->insert([
            'category' => 'product video',
        ]);

        DB::table('category_tutorial')->insert([
            'category' => 'software requirement',
        ]);

        DB::table('category_tutorial')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}