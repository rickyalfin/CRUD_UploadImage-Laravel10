<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\DataCustomer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DataCustomer::create([
            'nama' => 'Ali',
            'alamat' => 'Jl. Mangga Hijau No. 01',
            'no_telp' => '089012345672',
            'status' => 'Menikah',
        ]);

        DataCustomer::create([
            'nama' => 'budi',
            'alamat' => 'Jl. Apel Merah No. 02',
            'no_telp' => '0812012345678',
            'status' => 'Menikah',
        ]);

        DataCustomer::create([
            'nama' => 'Ceko',
            'alamat' => 'Jl. Nanas Kuning No. 03',
            'no_telp' => '081999888777',
            'status' => 'Belum Menikah',
        ]);
    }
}
