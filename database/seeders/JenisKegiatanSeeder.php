<?php

namespace Database\Seeders;

use App\Models\JenisKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKegiatan::create([
            'name' => 'Cek Kebersihan Area Mesin',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek Level Grease Tank',
            'standart' => 'Licin'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek Low Pressure Gauge dan Buang',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek Oli Pneumatic Pada Generator',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek High Pressure Gauge',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek dari Kebocoran pada Area High Pressure',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek Lubrication Gripper, Variable Pitch, Mandril',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek Lubrication Guide Clamping Mold, Gear Penggerak',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek Mekanisme Gripper, Variable Pitch',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek Temperature Chiller Unit',
            'standart' => 'Bersih'
        ]);

        JenisKegiatan::create([
            'name' => 'Cek Jalur Preform Rail dari Macet',
            'standart' => 'Bersih'
        ]);
    }
}
