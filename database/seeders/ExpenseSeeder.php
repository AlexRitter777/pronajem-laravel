<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = [
            ['name' => 'Garáže'],
            ['name' => 'Odměny výboru SVJ'],
            ['name' => 'Odpad'],
            ['name' => 'Společná el. energie'],
            ['name' => 'Údržba zeleně'],
            ['name' => 'Údržba komunikaci, pozemků, zeleně'],
            ['name' => 'Úklid'],
            ['name' => 'Výtah'],
            ['name' => 'Záloha na PCO HZS Praha'],
            ['name' => 'Zimní úklid'],
            ['name' => 'Údržba společných prostor a revize'],
            ['name' => 'Opravy, údržba'],
            ['name' => 'Režie SVJ'],
            ['name' => 'Režie - správní'],
            ['name' => 'Provozní režie'],
            ['name' => 'Správa domu'],
            ['name' => 'Rozúčtování topných nákladů'],
            ['name' => 'Náklady na odečty a rozučtování'],
            ['name' => 'Havarijní služba'],
            ['name' => 'Recepce'],
            ['name' => 'Odměna správci'],
        ];

        DB::table('expenses')->insert($expenses);

    }
}
