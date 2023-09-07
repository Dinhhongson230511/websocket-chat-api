<?php
namespace App\Services\Admin;

use App\Models\Channel;
use App\Models\ChannelMember;
use App\Models\ChannelMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChannelMessageService
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
        $this->channel = $channel;
        $this->channelMember = $channelMember;
        $this->channelMessage = $channelMessage;
        $this->user           = $user;
    }

    /**
     * Pagging channel list.
     *
     * @param int $channelId
     * @param Illuminate\Http\Request $request
     *
     * @return array
     */
    public function paginateByChannel(Channel $channel, Request $request)
    {
        $messageData = $this->channelMessage
            ->with('user')
            ->where('channel_id', $channel->id)
            ->orderBy('id', 'DESC')
            ->paginate($request->get('limit', 40));
        
        $messages = [];
        foreach ($messageData as $msg) {
            $enKey  = count($messages) - 1;
            $endMsg = $messages[$enKey] ?? [];
            if (!isset($endMsg['user_id']) || $msg->user_id !== $endMsg['user_id']) {
                $messages[] = [
                    'name'    => $msg->name(),
                    'user_id' => $msg->user_id,
                    'msgs'    => [
                        $msg->toArray(),
                    ],
                    'created_at' => $msg->created_at,
                    'avatar'   => $msg->getAvatar(),
                    'isCompanyUser' => !empty($msg->user->company_id) ? true : false
                ];
            } else {
                $endMsg['msgs']          = array_merge([$msg->toArray()], $endMsg['msgs']);
                $endMsg['created_at']    = $msg->created_at;
                $endMsg['isCompanyUser'] = !empty($msg->user->company_id) ? true : false;
                $messages[$enKey]        = $endMsg;
            }
        }

        return [
            'messages' => array_reverse($messages),
            'total'    => $messageData->total(), 'last_page' => $messageData->lastPage(), 'current_page' => $messageData->currentPage(),
        ];
    }

    /**
     * Create new message.
     *
     * @param App\Models\Channel      $channel
     * @param Illuminate\Http\Request $request
     * @param App\Models\User         $user
     *
     * @return App\Models\ChannelMessage
     */
    public function create($channel, $request, $user)
    {
        $type = $request->input('type', 'message');
        // message, images, attachments
        if ($type == 'images') {
            $imagesInput = $request->file('images');
            if (empty($imagesInput)) {
                throw new NotFoundHttpException('Images empty');
            }
            $images = [];
            foreach ($imagesInput as $img) {
                $imageInfo = upLoadImageOrAttachmentToS3($img, config('const.message_upload_image_directory'));
                $images[] = $imageInfo['status'] ? $imageInfo['fullPath'] : '';
            }

            return $this->channelMessage->create([
                'channel_id' => $channel->id,
                'user_id'    => $user->id,
                'message'    => null,
                'type'       => 'images',
                'images'     => $images,
            ]);
        }
        if ($type == 'attachments') {
            $attachmentInputs = $request->file('attachments');
            if (empty($attachmentInputs)) {
                throw new NotFoundHttpException('Attachments empty');
            }
            $attachments = [];
            foreach ($attachmentInputs as $attachment) {
                $attachmentInfo = upLoadImageOrAttachmentToS3($attachment, config('const.message_upload_attachment_directory'));
                $attachments[] = [
                    'name' => $attachmentInfo['fileName'],
                    'url'  => $attachmentInfo['status'] ? $attachmentInfo['fullPath'] : '',
                ];
            }

            return $this->channelMessage->create([
                'channel_id'  => $channel->id,
                'user_id'     => $user->id,
                'message'     => null,
                'type'        => 'attachments',
                'attachments' => $attachments,
            ]);
        }
        if ($type == 'message') {
            return $this->channelMessage->create([
                'channel_id' => $channel->id,
                'user_id'    => $user->id,
                'message'    => $request->input('message'),
                'type'       => 'message',
            ]);
        }
    }
}
