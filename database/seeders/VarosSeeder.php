<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VarosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('varos')->insert([
            'nev' => 'Baja',
            'megye_id' => '1'
        ]);

        DB::table('varos')->insert([
            'nev' => 'Bácsalmás',
            'megye_id' => '1'
        ]);
    }
}
