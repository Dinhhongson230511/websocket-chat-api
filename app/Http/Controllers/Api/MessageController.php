<?php
namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Services\Api\ChannelMessageService;
use App\Services\Api\ChannelService;
use Illuminate\Http\Request;
use App\Jobs\UnreadCountQueue;
use App\Services\Api\ChannelMemberService;
use App\Http\Requests\Api\Message\SendMessageRequest;
use App\Traits\ResponseApiTrait;
use Exception;

/**
 * Class MessageController.
 */
class MessageController extends Controller
{
    use ResponseApiTrait;
    protected ChannelService $channelService;

    protected ChannelMessageService $channelMessageService;

    protected ChannelMemberService $channelMemberService;

    public function __construct(
        ChannelService $channelService,
        ChannelMessageService $channelMessageService,
        ChannelMemberService $channelMemberService,
    ) {
        $this->channelService        = $channelService;
        $this->channelMessageService = $channelMessageService;
        $this->channelMemberService  = $channelMemberService;
    }

    /**
     * Index of message.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $channels = $this->channelService->getAllChannelByUserAgencyCompany($user, $request);

        return $this->responseSuccess(
            $channels,
        );
    }

    /**
     * Index of message.
     *
     * @param Request $request
     */
    public function show(int $channelId)
    {
        $user = auth()->user();
        $channel = $this->channelService->getNewestChannelById($channelId);
        if (!$channel || !$user) {
            throw new Exception(__('api/messages.errors.channel_not_found'));
        }
        $members = $this->channelService->getMemberOfChannel($channel, $user);
        return $this->responseSuccess(
            [
                'channel' => $channel,
                'members' => $members
            ]
        );
    }

    public function showChannelList($channelId, Request $request)
    {
        $user = auth()->user();
        $channel = $this->channelService->getChannelById($channelId);
        if (!$channel) {
            throw new Exception(__('api/messages.errors.channel_not_found'));
        }
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

        $data = [
            'channel'  => $channel,
            'channels' => $channels,
        ];
        return $this->responseSuccess(
            $data,
        );
    }

    public function showMessage(int $channelId, Request $request)
    {
        $user = auth()->user();
        $channel = $this->channelService->getChannelById($channelId);
        if (!$channel) {
            throw new Exception(__('api/messages.errors.channel_not_found'));
        }
        $this->channelService->checkUserHasChannel($channel, $user);
        $messages = $this->channelMessageService->paginateByChannel($channelId, $request);

        $data = array_merge($messages, ['user' => $user]);
        return $this->responseSuccess(
            $data,
        );
    }

    /**
     * Persist message to database.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function sendMessage(SendMessageRequest $request, $channelId)
    {
        $user = auth()->user();
        $channel = $this->channelService->getChannelById($channelId);
        if (!$channel) {
            throw new Exception(__('api/messages.errors.channel_not_found'));
        }
        $message = $this->channelMessageService->create($channel, $request, $user);
        broadcast(new MessageSent($user, $message, $channel));
        UnreadCountQueue::dispatch($channel);

        $data = ['status' => 'Message Sent!'];
        return $this->responseSuccess(
            $data,
        );
    }

    public function updateRead($channelId)
    {
        $user = auth()->user();
        $this->channelMemberService->updateCountToRead($channelId, $user->id);

        return [
            'success' => true,
        ];
    }

    public function channelCreate(Request $request)
    {
        $user = auth()->user();
        $response = $this->channelService->createChannel($request, $user);
        if ($response['status']) {
            return $this->responseSuccess(
                $response['data'],
                __('common.success_message')
            );
        }
        return $this->responseBadRequest(__('common.error_message'));
    }
}
