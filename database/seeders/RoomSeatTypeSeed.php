<?php

namespace Database\Seeders;

use App\Models\RoomSeatType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeatTypeSeed extends Seeder
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
                'name' => 'テーブル席あり',
            ],
            [
                'name' => 'カウンターあり',
            ],
            [
                'name' => '座敷あり',
            ],
            [
                'name' => '掘りごたつあり',
            ],
            [
                'name' => 'テラスあり',
            ],
            [
                'name' => 'フロア貸切可',
            ],
            [
                'name' => '店舗貸し切り可',
            ]
        ];
        RoomSeatType::query()->upsert($data, '', ['name']);
    }
}
