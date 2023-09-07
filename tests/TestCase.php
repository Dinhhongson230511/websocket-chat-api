<?php

namespace Tests;

use App\Models\TravelAgency;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected User $user;
    protected User $admin;
    protected TravelAgency $agency;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createAgency();
        $this->createUser();
        $this->createAdmin();
        $this->updateAgency();
    }

    protected function createAgency() : void
    {
        $this->agency = TravelAgency::factory()->create([
            'furigana_name' => '旅行会社名',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'post_code' => '000-111',
        ]);
    }

    protected function createUser(): void
    {
        $this->user = User::factory()->user()->create([
            'password' => 'User@123!',
            'first_name' => 'example',
            'last_name' => 'example',
            'furigana_first_name' => '旅行会社名',
            'furigana_last_name' => '旅行会社名',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'travel_agency_id' => $this->agency->id
        ]);
    }

    protected function createAdmin(): void
    {
        $this->admin = User::factory()->admin()->create([
            'password' => 'Admin@123!',
            'first_name' => 'example',
            'last_name' => 'example',
            'furigana_first_name' => '旅行会社名',
            'furigana_last_name' => '旅行会社名',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
        ]);
    }

    protected function updateAgency(): void
    {
        $this->agency->update([
            "manager_id" => $this->user->id
        ]);
    }
}
