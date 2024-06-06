<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Siswaseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswa = [
            [
                'sis' => '111',
                'nama' => 'hisyam'
            ],
            [
                'sis' => '222',
                'nama' => 'zubair'
            ]
            ];
            Siswa::insert($siswa);
    }
}
