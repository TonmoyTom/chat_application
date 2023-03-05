<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

//    const LIMIT = 5000;
//    const PATH = 'conversation';
    const MEDIA_IMAGE = 1;
    const MEDIA_PDF = 2;
    const MEDIA_DOC = 3;
    const MEDIA_VOICE = 4;
    const MEDIA_VIDEO = 5;
    const YOUTUBE_URL = 6;
    const MEDIA_TXT = 7;
    const MEDIA_XLS = 8;
    const MESSAGE_TYPE_BADGES = 9;

    protected $guarded = ['id'];






//    protected $appends = ['time_from_now_in_min', 'is_group'];

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
