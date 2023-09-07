<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_types')->truncate();
        $foodTypes = [
            1 => 'メインコース',
            2 => '飲み放題',
            3 => 'サブコース',
        ];

        foreach ($foodTypes as $id => $name) {
            DB::table('food_types')->insert([
                'id' => $id,
                'name' => $name,
            ]);
        }
    }
}
