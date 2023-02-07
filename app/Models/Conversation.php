<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    const LIMIT = 5000;
    const PATH = 'conversation';
    const MEDIA_IMAGE = 1;
    const MEDIA_PDF = 2;
    const MEDIA_DOC = 3;
    const MEDIA_VOICE = 4;
    const MEDIA_VIDEO = 5;
    const YOUTUBE_URL = 6;
    const MEDIA_TXT = 7;
    const MEDIA_XLS = 8;
    const MESSAGE_TYPE_BADGES = 9;

    public $fillable = [
        'from_id',
        'to_id',
        'message',
        'message_type',
        'status',
        'file_name',
        'to_type',
        'reply_to',
        'url_details',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'from_id'      => 'integer',
        'reply_to'     => 'integer',
        'to_id'        => 'string',
        'message'      => 'string',
        'message_type' => 'integer',
        'file_name'    => 'string',
        'to_type'      => 'string',
        'url_details'  => 'json',
        'status'       => 'integer',
    ];

    public static $rules = [
        'to_id'   => 'required|string',
        'message' => 'required|string',
    ];

    protected $appends = ['time_from_now_in_min', 'is_group'];

    public function getTimeFromNowInMinAttribute()
    {
        return Carbon::now()->diffInMinutes($this->created_at);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_id');
    }

    public function scopeMessage(Builder $query)
    {
        return $query->where('to_type', Conversation::class);
    }

    public function replyMessage()
    {
        return $this->belongsTo(Conversation::class, 'reply_to');
    }


}
