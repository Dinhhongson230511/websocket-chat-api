<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Channel.
 */
class Channel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'display_name',
        'type',
    ];

    public function messages()
    {
        return $this->hasMany(ChannelMessage::class);
    }

    public function channelMembers()
    {
        return $this->hasMany(ChannelMember::class, 'channel_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}
