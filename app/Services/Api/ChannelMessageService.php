<?php
namespace App\Services\Api;

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
        $this->channelMember  = $channelMember;
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
    public function paginateByChannel(int $channelId, Request $request)
    {
        $messageData = $this->channelMessage
            ->with('user')
            ->where('channel_id', $channelId)
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
        $data = [
            'channel_id' => $channel->id,
            'user_id'    => $user->id,
            'message'    => null,
            'type'       => $type,
        ];
        
        if ($type == 'images') {
            $inputKey = 'images';
            $uploadDirectory = config('const.message_upload_image_directory');
        } elseif ($type == 'attachments') {
            $inputKey = 'attachments';
            $uploadDirectory = config('const.message_upload_attachment_directory');
        } else {
            $data['message'] = $request->input('message');
            $inputKey = null;
        }
        
        if ($inputKey) {
            $inputFiles = $request->file($inputKey);
            if (empty($inputFiles)) {
                throw new NotFoundHttpException(ucfirst($type) . ' empty');
            }
        
            $items = [];
            foreach ($inputFiles as $inputFile) {
                $fileInfo = upLoadImageOrAttachmentToS3($inputFile, $uploadDirectory);
        
                if ($type == 'images') {
                    $items[] = $fileInfo['status'] ? $fileInfo['fullPath'] : '';
                } elseif ($type == 'attachments') {
                    $items[] = [
                        'name' => $fileInfo['fileName'],
                        'url'  => $fileInfo['status'] ? $fileInfo['fullPath'] : '',
                    ];
                }
            }
        
            if ($type == 'images') {
                $data['images'] = $items;
            } elseif ($type == 'attachments') {
                $data['attachments'] = $items;
            }
        }

        return $this->channelMessage->create($data);
    }
}
