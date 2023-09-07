<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Channel;
use App\Models\User;
use App\Models\ChannelMember;
use Illuminate\Database\Seeder;
use App\Enums\ChannelType;
use App\Enums\Role;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store1 = Store::query()->where('email', 'store1@gmail.com')->first();
        
        //user agency created channel
        $userAgency = User::query()->where('email', 'useragency1@gmail.com')->first();

        //user company manager
        $userCompanyManager = User::query()->where('email', 'company1@gmail.com')->first();

        $channelPersonal = Channel::query()->create([
            'store_id' => $store1->id,
            'display_name' => $store1->name.' - '.$userAgency->fullName,
            'type' => ChannelType::CHANNEL_PERSONAL->value,
        ]);

        $channelOrder = Channel::query()->create([
            'store_id' => $store1->id,
            'display_name' => $store1->name.' - '.'テストグループ',
            'type' => ChannelType::CHANNEL_ORDER->value,
        ]);

        // add user store for channel
        $userStores = User::query()->where('store_id', $store1->id)->where('role_id', Role::STORE->value)->get();

        foreach ($userStores as $user) {
            ChannelMember::query()->create([
                'channel_id' => $channelPersonal->id,
                'user_id' => $user->id,
                'msg_count' => 0,
            ]);
            ChannelMember::query()->create([
                'channel_id' => $channelOrder->id,
                'user_id' => $user->id,
                'msg_count' => 0,
            ]);
        }

        // add user manager store for channel
        ChannelMember::query()->create([
            'channel_id' => $channelPersonal->id,
            'user_id' => $userCompanyManager->id,
            'msg_count' => 0,
        ]);
        ChannelMember::query()->create([
            'channel_id' => $channelOrder->id,
            'user_id' => $userCompanyManager->id,
            'msg_count' => 0,
        ]);

        // add user agency for channel
        $userAgencies = User::query()->where('travel_agency_id', $userAgency->travelAgencyId)->where('role_id', Role::AGENCY->value)->get();
        foreach ($userAgencies as $user) {
            ChannelMember::query()->create([
                'channel_id' => $channelPersonal->id,
                'user_id' => $user->id,
                'msg_count' => 0,
            ]);
            ChannelMember::query()->create([
                'channel_id' => $channelOrder->id,
                'user_id' => $user->id,
                'msg_count' => 0,
            ]);
        }
    }
}
