<?php

namespace App\Services\Admin;

use App\Models\Channel;
use App\Models\ChannelMember;
use App\Models\ChannelMessage;
use App\Models\User;
use Illuminate\Support\Str;
use App\Enums\ChannelType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Company;

class ChannelService
{
    protected Channel $channel;

    protected ChannelMember $channelMember;

    protected ChannelMessage $channelMessage;

    protected User $user;

    public function __construct(
        Channel $channel,
        ChannelMember $channelMember,
        ChannelMessage $channelMessage,
        User $user,
    ) {
        $this->channel        = $channel;
        $this->channelMember  = $channelMember;
        $this->channelMessage = $channelMessage;
        $this->user           = $user;
    }

    /***
     * Get list member of channel
     *
     *
     */
    public function getMemberOfChannel(Channel $channel, User $user)
    {
        $channelMember = $this->channelMember->checkUserHasChannel($channel, $user)->first();
        if (!$channelMember) {
            abort(404);
        }

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
     * Find user channel and message.
     */
    public function initInfoChannel(Channel $channel, $user, $request)
    {
        $channelMember = $this->channelMember->where('user_id', $user->id)
            ->where('channel_id', $channel->id)
            ->firstOrFail();

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
                $channelInfo->msg->message = Str::limit($channelInfo->msg->message, 25);
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

    /**
     * get All Channel By User
     */
    public function getAllChannelByUser(User $user)
    {
        $company = Company::query()->with('stores')->where('id', $user->company_id)->first();
        if (!$company) {
            abort(404);
        }
        $storeIds = $company->stores()->pluck('id')->toArray();
        return $this->channel->where('store_id', $storeIds)->paginate(10);
    }

    public function getNewestChannelById(int $channelId)
    {
        $channel = Channel::query();
        if ($channelId === config('const.channel_has_zero_value')) {
            return $channel->latest()->first() ?? abort(404);
        }
        return $channel->where('id', $channelId)->first() ?? abort(404);
    }

    /**
     * get channel members by User.
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
}
