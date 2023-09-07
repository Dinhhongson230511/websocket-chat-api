<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AccountSeeder::class,
            CustomerSeeder::class,
            CategorySeeder::class,
            PrefectureSeeder::class,
            AllergyCompatibilitySeed::class,
            DietaryRestrictionSeed::class,
            RoomSeatTypeSeed::class,
            DefaultThreeStoreSeed::class,
            DaysTableSeeder::class,
            FoodTypesTableSeeder::class,
            MessageUserSeeder::class,
            MessageSeeder::class
        ]);
    }
}
