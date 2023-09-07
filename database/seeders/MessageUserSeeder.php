<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Store;
use App\Models\TravelAgency;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\Role;

class MessageUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $travelAgency = TravelAgency::factory()->create([
            'furigana_name' => '国内一般般般',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'post_code' => '000-111',
        ]);

        for ($i = 0; $i <= 3; $i++) {
            // user agency
            User::factory()->user()->create([
                'first_name' => 'User',
                'email' => 'useragency'.$i.'@gmail.com',
                'password' => 'Useragency@123',
                'travel_agency_id' => $travelAgency->id
            ]);
        }

        // seed data and user for company sample 1
        $company1 = Company::factory()->create([
            'furigana_name' => '国内一般 1',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'post_code' => '000-111',
        ]);
        $store1 = Store::factory()->create([
            'furigana' => '国内一般 1',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'post_code' => '000-111',
            'email' => 'store1@gmail.com',
            'company_id' => $company1->id
        ]);
        // user manager company 1
        User::factory()->create([
            'first_name' => 'User company manager 1',
            'email' => 'company1@gmail.com',
            'password' => 'Company@123',
            'role_id' => Role::COMPANY->value,
            'company_id' => $company1->id,
        ]);

        // store user
        for ($i = 0; $i <= 3; $i++) {
            User::factory()->create([
                'first_name' => 'User store-'.$i,
                'email' => 'store'.$i.'@gmail.com',
                'password' => 'Store@123',
                'role_id' => Role::STORE->value,
                'company_id' => $company1->id,
                'store_id' => $store1->id
            ]);
        }

        // seed data and user for company sample 2
        $company2 = Company::factory()->create([
            'furigana_name' => '国内一般 2',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'post_code' => '000-111',
        ]);

        $store2 = Store::factory()->create([
            'furigana' => '国内一般 2',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'post_code' => '000-111',
            'email' => 'store2@gmail.com',
            'company_id' => $company2->id
        ]);

        // user manager company 2
        User::factory()->create([
            'first_name' => 'User company manager 2',
            'email' => 'company2@gmail.com',
            'password' => 'Company@123',
            'role_id' => Role::COMPANY->value,
            'company_id' => $company2->id,
        ]);

        // store user
        for ($i = 4; $i <= 7; $i++) {
            User::factory()->create([
                'first_name' => 'User store-2-'.$i,
                'email' => 'store'.$i.'@gmail.com',
                'password' => 'Store@123',
                'role_id' => Role::STORE->value,
                'company_id' => $company2->id,
                'store_id' => $store2->id
            ]);
        }
    }
}
