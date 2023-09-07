<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Services\Admin\ChannelMessageService;
use App\Services\Admin\ChannelService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Channel;
use App\Jobs\UnreadCountQueue;
use App\Services\Admin\ChannelMemberService;
use App\Http\Requests\Admin\Message\SendMessageRequest;

/**
 * Class MessageController.
 */
class MessageController extends Controller
{
    protected ChannelService $channelService;

    protected ChannelMessageService $channelMessageService;

    protected ChannelMemberService $channelMemberService;

    public function __construct(
        ChannelService $channelService,
        ChannelMessageService $channelMessageService,
        ChannelMemberService $channelMemberService,
    ) {
        $this->channelService         = $channelService;
        $this->channelMessageService  = $channelMessageService;
        $this->channelMemberService  = $channelMemberService;
    }

    /**
     * Index of message.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $user        = Auth::user();
        $channels = $this->channelService->getAllChannelByUser($user);
        return view('admin.pages.store.messages.index', ['channels' => $channels]);
    }

    /**
     * Index of message.
     *
     * @param Request $request
     */
    public function show($channelId)
    {
        $user = Auth::user() ?? abort(404);
        $channel = $this->channelService->getNewestChannelById($channelId);
        if ($channelId == config('const.channel_has_zero_value')) {
            return redirect()->route('admin.messages.show', $channel->id);
        }
        $members     = $this->channelService->getMemberOfChannel($channel, $user);
        return view('admin.pages.store.messages.show', ['channel' => $channel, 'members' => $members]);
    }

    public function showChannelList(Channel $channel, Request $request)
    {
        $user        = Auth::user();
        $channelInfo = $this->channelService->initInfoChannel($channel, $user, $request);
        $channels    = [];
        foreach ($channelInfo['channels'] as $cInfo) {
            $channels[] = [
                'id'         => $cInfo->id,
                'name'       => $cInfo->name,
                'channel_id' => $cInfo->channelId,
                'msg_count'  => $cInfo->msgCount,
                'url'        => route('admin.messages.show', $cInfo->channelId),
                'users'      => $cInfo->users,
                'msg'        => $cInfo->msg,
            ];
        }

        return [
            'channel'  => $channel,
            'channels' => $channels,
        ];
    }

    public function showMessage(Channel $channel, Request $request)
    {
        $user     = Auth::user();
        $messages = $this->channelMessageService->paginateByChannel($channel, $request);

        return array_merge($messages, ['user' => $user]);
    }

    /**
     * Persist message to database.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function sendMessage(SendMessageRequest $request, Channel $channel)
    {
        $user    = Auth::user();
        $message = $this->channelMessageService->create($channel, $request, $user);
        broadcast(new MessageSent($user, $message, $channel));
        UnreadCountQueue::dispatch($channel);

        return ['status' => 'Message Sent!'];
    }

    public function updateRead($channelId)
    {
        $user = Auth::user();
        $this->channelMemberService->updateCountToRead($channelId, $user->id);

        return [
            'success' => true,
        ];
    }
}
