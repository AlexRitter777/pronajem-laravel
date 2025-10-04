<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meterTypes = [
            ['name' => 'Teplá užitková voda'],
            ['name' => 'Studená užitková voda'],
            ['name' => 'Topení'],
        ];

        DB::table('meter_types')->insert($meterTypes);

    }
}
