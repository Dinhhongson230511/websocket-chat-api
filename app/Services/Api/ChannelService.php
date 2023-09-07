<?php

namespace App\Services\Api;

use App\Models\Channel;
use App\Models\ChannelMember;
use App\Models\ChannelMessage;
use App\Models\User;
use Illuminate\Support\Str;
use App\Enums\ChannelType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Company;
use App\Models\Store;
use Illuminate\Http\Request;
use Exception;
use App\Services\Api\UserService;
use App\Services\Api\CustomerService;
use Illuminate\Support\Facades\Log;

class ChannelService
{
    protected Channel $channel;

    protected ChannelMember $channelMember;

    protected ChannelMessage $channelMessage;

    protected User $user;

    protected Company $company;

    protected Store $store;

    protected UserService $userService;

    protected CustomerService $customerService;

    public function __construct(
        Channel $channel,
        ChannelMember $channelMember,
        ChannelMessage $channelMessage,
        User $user,
        Company $company,
        Store $store,
        UserService $userService,
        CustomerService $customerService,
    ) {
        $this->channel        = $channel;
        $this->channelMember  = $channelMember;
        $this->channelMessage = $channelMessage;
        $this->user           = $user;
        $this->company        = $company;
        $this->store          = $store;
        $this->userService    = $userService;
        $this->customerService = $customerService;
    }

    /***
     * Get list member of channel
     */
    public function getMemberOfChannel(Channel $channel, User $user)
    {
        $this->checkUserHasChannel($channel, $user);
        $channelUserInfos = [];
        $allChanelMembers = $this->channelMember->with(['user'])
            ->where('channel_id', $channel->id)
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($allChanelMembers as $channelUser) {
            $image = asset('assets/images/icon/avatar.svg');

            if ($channelUser->user->avatarUrl != null) {
                $image = $channelUser->user->avatarUrl;
            }

            $channelUserInfos[] = [
                'user_id' => $channelUser->user_id,
                'avatar'  => $image,
                'name'    => $channelUser->user->fullName,
            ];
        }

        return $channelUserInfos;
    }

    /**
     * get channels member by User.
     */
    public function getChannelMembersByUser($request, User $user)
    {
        $search = $request->search ?? '';
        $searchType = $request->searchType ?? '';

        $channelMemberModel = ChannelMember::query();
        // find all channels created store detail based on channel type CHANNEL_PERSONAL
        if ($searchType === 'searchType' && $search === ChannelType::CHANNEL_PERSONAL->value) {
            $channelMemberModel->WhereHas('channel', function (Builder $query) use ($search) {
                $query->where('type', $search);
            });
        }

        // find all channels after order based on channel type CHANNEL_ORDER
        if ($searchType === 'searchType' && $search === ChannelType::CHANNEL_ORDER->value) {
            $channelMemberModel->WhereHas('channel', function (Builder $query) use ($search) {
                $query->whereHas('messages')
                    ->orWhere('type', $search);
            });
        }

        if (!empty($search) && $search != 'ALL' && $searchType === 'searchText') {
            $channelMemberModel->WhereHas('channel', function (Builder $query) use ($search) {
                $query->where('display_name', 'like', '%' . $search . '%');
            });
        }

        return $channelMemberModel->with('channel')->where('user_id', $user->id)->orderBy('channel_id', 'DESC')->get();
    }

    /**
     * Find user channel and message.
     */
    public function initInfoChannel(Channel $channel, $user, $request)
    {
        $channelMember = $this->channelMember->where('user_id', $user->id)
            ->where('channel_id', $channel->id)
            ->first();

        //update Count To Read
        $this->channelMember->where('user_id', $user->id)
            ->where('channel_id', $channel->id)
            ->update([
                'msg_count' => 0,
            ]);

        $channels   = $this->getChannelMembersByUser($request, $user);
        $channelIds = $channels->pluck('channel_id');

        $allMessage = collect();
        if (count($channelIds)) {
            $allMessage = DB::select(DB::raw('
                SELECT * FROM channel_messages WHERE id IN ( SELECT MAX(id) FROM 
                channel_messages WHERE channel_id 
                in (' . implode(',', $channelIds->toArray()) . ') GROUP BY channel_id)
            '));

            $allMessage = collect($allMessage);
        }

        foreach ($channels as $channelInfo) {
            $channelUserInfos = [];
            $channelUsers     = $channelInfo->where('channel_id', $channelInfo->channel_id)->get();
            foreach ($channelUsers as $channelUser) {
                if ($channelUser->user_id != $user->id) {
                    $channelUserInfos[] = [
                        'avatar' => $channelUser->user->avatarUrl ?? asset('assets/images/icon/avatar.svg'),
                    ];
                }
                $channelInfo->name = $channelInfo->channel->display_name;
            }
            $channelInfo->users = $channelUserInfos;
            $channelInfo->msg   = $allMessage->where('channel_id', $channelInfo->channel_id)->first();
            if (!empty($channelInfo->msg)) {
                $channelInfo->msg->message = Str::limit($channelInfo->msg->message, 32);
            }
        }

        return [
            'channelMember' => $channelMember,
            'channels'      => $channels,
        ];
    }

    /**
     * Update count message.
     */
    public function updateCountToRead(Channel $channel)
    {
        $channelMemmbers = $this->channelMember->where('channel_id', $channel->id)->get();
        foreach ($channelMemmbers as $channelMember) {
            ChannelMember::query()
                ->where('channel_id', $channel->id)
                ->where('user_id', $channelMember->user_id)
                ->update([
                    'msg_count' => $channelMember->msg_count + 1,
                ]);
        }

        return true;
    }

    public function getChannelById(int $channelId)
    {
        return Channel::query()->where('id', $channelId)->first() ?? '';
    }

    /**
     * get All Channel By User Agency Company
     */
    public function getAllChannelByUserAgencyCompany(User $user, $request)
    {
        $search = $request->search ?? '';
        $channelIds = $this->channelMember->select('channel_id')
            ->where('user_id', $user->id)
            ->groupBy('channel_id')->pluck('channel_id');

        $channel = Channel::query();
        if (!empty($search)) {
            $channel->where('display_name', 'like', '%' . $search . '%');
        }

        return $channel->whereIn('id', $channelIds)->paginate(config('const.common_per_page'));
    }

    /**
     * create a new channel
     */
    public function createChannel(Request $request, User $user)
    {
        $initResponse = [
            'status' => false,
            'data' => null,
        ];
        $store = $this->store->where('id', $request->store_id ?? null)->first();
        if (!$store) {
            return $initResponse;
        };
        DB::beginTransaction();
        try {
            $dataChannel = [
                'type' => $request->type,
                'store_id' => $store->id,
            ];
            if ($request->type === ChannelType::CHANNEL_PERSONAL->value) {
                $dataChannel['display_name'] = $store->name;
            }

            if ($request->type === ChannelType::CHANNEL_ORDER->value) {
                $getCustomer = $this->customerService->getCustomerByIdAndAgencyId($request->customer_id, $user->travel_agency_id);
                $dataChannel['display_name'] = $getCustomer->name . '-' . $store->name;
            }

            $channel = $this->channel->create($dataChannel);

            // push users into channel
            $this->pushUsersToChannelMember($channel, $user, $store);
            DB::commit();
            return [
                'status' => true,
                'data' => $channel,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning('create channel error: ' . $e);
            return $initResponse;
        }
    }

    public function pushUsersToChannelMember(Channel $channel, User $user, Store $store)
    {
        //push travel agence users to channel members
        $travelAgenceUsers = $this->userService->getAllUsersByTravelAgencyId($user->travel_agency_id);
        $this->insertChannelMembers($channel, $travelAgenceUsers);

        //push store users to channel members
        $storeUsers = $this->userService->getAllUsersByStoreIdAndCompanyId($store->id, $store->company_id);
        $this->insertChannelMembers($channel, $storeUsers);
    }

    private function insertChannelMembers($channel, $users)
    {
        $channelMembers = $users->map(function (User $user) use ($channel) {
            return [
                'channel_id' => $channel->id,
                'user_id' => $user->id,
                'msg_count' => 0,
                'created_at' => date(config('const.format_date_Y-m-d_H_i_s')),
                'updated_at' => date(config('const.format_date_Y-m-d_H_i_s'))
            ];
        })->toArray();

        //insert channel members multiple
        ChannelMember::query()->insert($channelMembers);
    }

    public function getNewestChannelById(int $channelId)
    {
        $channel = Channel::query();
        if ($channelId === config('const.channel_has_zero_value')) {
            return $channel->latest()->first();
        }
        return $channel->where('id', $channelId)->first() ?? '';
    }

    public function checkUserHasChannel(Channel $channel, User $user)
    {
        $channelMember = $this->channelMember->checkUserHasChannel($channel, $user)->first();
        if (!$channelMember) {
            throw new Exception(__('api/messages.errors.channel_not_found'));
        }
    }
}
