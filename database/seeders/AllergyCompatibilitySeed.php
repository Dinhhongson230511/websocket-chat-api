<?php

namespace Database\Seeders;

use App\Models\AllergyCompatibility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergyCompatibilitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => '除去食',
            ],
            [
                'name' => '専用メニュー',
            ],
            [
                'name' => '持ち込み',
            ]
        ];
        AllergyCompatibility::query()->upsert($data, '', ['name']);
    }
}
