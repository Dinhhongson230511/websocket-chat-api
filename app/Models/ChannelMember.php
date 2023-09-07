<?php
namespace App\Models;

use App\Constant\MediaContant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Class ChannelMember.
 */
class ChannelMember extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id',
        'user_id',
        'type',
        'msg_count'
    ];

    public function channel()
    {
        return $this->belongsTo(
            Channel::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function getAvatar()
    {
        $user = $this->user()->first();
        if (!empty($user)) {
            return $user->avatar;
        } else {
            return '';
        }
    }

    /**
     * get channel_id
     *
     * @return Attribute
     */
    public function channelId(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['channel_id'],
        );
    }

    /**
     * get msg_count
     *
     * @return Attribute
     */
    public function msgCount(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['msg_count'],
        );
    }

    /**
     * check user has channel by channel and user
     *
     * @param $query
     * @param $channel
     * @param $user
     * @return mixed
     */
    public function scopeCheckUserHasChannel($query, $channel, $user)
    {
        return $query->whereHas('channel', function ($q) use ($channel) {
            $q->where('store_id', $channel->store_id);
        })->where('user_id', $user->id);
    }
}
