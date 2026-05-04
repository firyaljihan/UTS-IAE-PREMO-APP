<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::insert([
        ['nama_app' => 'Netflix Premium', 'harga' => 54000],
        ['nama_app' => 'Spotify Premium', 'harga' => 49990],
        ['nama_app' => 'Disney+ Hotstar', 'harga' => 39000],
    ]);
    }
}
