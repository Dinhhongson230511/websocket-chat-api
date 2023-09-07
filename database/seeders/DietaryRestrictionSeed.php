<?php

namespace Database\Seeders;

use App\Models\DietaryRestriction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DietaryRestrictionSeed extends Seeder
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
                'name' => 'ハラル認証',
            ],
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
        DietaryRestriction::query()->upsert($data, '', ['name']);
    }
}
