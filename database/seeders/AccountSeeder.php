<?php

namespace Database\Seeders;

use App\Models\TravelAgency;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        User::factory()->admin()->create([
            'first_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'Admin@123'
        ]);
        $travelAgency = TravelAgency::factory()->create([
            'furigana_name' => '国内一般',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'post_code' => '000-111',
        ]);
        User::factory()->user()->create([
            'first_name' => 'User',
            'email' => 'user@gmail.com',
            'password' => 'User@123',
            'travel_agency_id' => $travelAgency->id
        ]);
    }
}
