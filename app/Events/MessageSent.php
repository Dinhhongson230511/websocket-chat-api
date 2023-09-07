<?php
namespace App\Events;

use App\Models\Channel as ChannelModel;
use App\Models\ChannelMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * User that sent the message.
     *
     * @var User
     */
    public $user;

    /**
     * Message details.
     *
     * @var ChannelMessage
     */
    public $message;

    /**
     * Channel details.
     *
     * @var Channel
     */
    public $channelOn;

    /**
     * get avatar of user chaating
     *
     * @var Channel
     */
    public $avatar;

    /**
     * get name of user chaating
     *
     * @var Channel
     */
    public $userChatting;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $message, ChannelModel $channelOn)
    {
        $this->user      = $user;
        $this->message   = $message;
        if ($message->type === 'images') {
            $this->message->images = json_decode(json_encode($this->message->images), true);
        }
        if ($message->type === 'attachments') {
            if (!is_array($this->message->attachments)) {
                $this->message->attachments = json_decode($this->message->attachments);
            }
        }

        $this->avatar = $this->message->getAvatar();
        $this->userChatting = $this->message->name();
        $this->channelOn = $channelOn;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return ['chat'];
        return new PrivateChannel('chat-'.$this->channelOn->id);
    }
}
