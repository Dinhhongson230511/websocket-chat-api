<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            'mon' => '月',
            'tue' => '火',
            'wed' => '水',
            'thu' => '木',
            'fri' => '金',
            'sat' => '土',
            'sun' => '日',
            'holiday' => '祝日',
            'eve' => '祝前日',
        ];

        foreach ($days as $slug => $name) {
            DB::table('days')->insert([
                'slug' => $slug,
                'name' => $name,
            ]);
        }
    }
}
