<?php

namespace Database\Seeders;

use App\Models\LineProduksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineproduksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineProduksi::create([
            'name' => 'CF1'
        ]);

        LineProduksi::create([
            'name' => 'CF2'
        ]);

        LineProduksi::create([
            'name' => 'CF3'
        ]);

        LineProduksi::create([
            'name' => 'CF4'
        ]);

        LineProduksi::create([
            'name' => 'CF5'
        ]);

        LineProduksi::create([
            'name' => 'CBE'
        ]);

        LineProduksi::create([
            'name' => 'Packaging'
        ]);
    }
}
