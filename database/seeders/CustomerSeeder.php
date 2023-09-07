<?php

namespace Database\Seeders;

use App\Enums\CustomerType;
use App\Models\Customer;
use App\Models\TravelAgency;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $travelAgency = TravelAgency::factory()->create([
            'furigana_name' => '国内一般',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'post_code' => '000-111',
        ]);
        $user = User::factory()->user()->create([
            'first_name' => 'User',
            'email' => 'example@gmail.com',
            'password' => 'User@123',
            'travel_agency_id' => $travelAgency->id
        ]);
        Customer::factory(50)->create([
            'agency_id' => $travelAgency->id,
            'agency_person_in_charge_id' => $user->id,
            'type_id' => CustomerType::DOMESTIC_GENERAL->value,
            'tel' => '000-111-222',
            'created_by_id' => $user->id
        ]);
    }
}
