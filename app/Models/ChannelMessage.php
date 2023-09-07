<?php
namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChannelMessage.
 */
class ChannelMessage extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'images'      => Json::class,
        'attachments' => Json::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id',
        'user_id',
        'message',
        'images',
        'attachments',
        'type',
    ];

    protected $appends = ['isCompanyUser'];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function channel()
    {
        return $this->belongsTo(
            Channel::class
        );
    }

    public function name()
    {
        $user = $this->user()->first();
        return $user->first_name.' '.$user->last_name;
    }

    public function getAvatar()
    {
        $user = $this->user()->first();
        return $user->avatar;
    }

    public function getIsCompanyUserAttribute()
    {
        return $this->user()->first()->company_id ? true : false;
    }
}
