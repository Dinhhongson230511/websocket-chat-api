<?php
namespace App\Services\Api;

use App\Models\Channel;
use App\Models\ChannelMember;
use App\Models\ChannelMessage;
use App\Models\User;

class ChannelMemberService
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

    /**
     * Update count message.
     */
    public function updateCountToRead($channelId, $userId)
    {
        return $this->channelMember
            ->where('user_id', $userId)
            ->where('channel_id', $channelId)
            ->update([
                'msg_count' => 0,
            ]);
    }
}
