<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const BLOCK_UNBLOCK_EVENT = 1;
    const NEW_PRIVATE_CONVERSATION = 2;
    const ADDED_TO_GROUP = 3;
    const PRIVATE_MESSAGE_READ = 4;
    const MESSAGE_DELETED = 5;
    const MESSAGE_NOTIFICATION = 6;
    const CHAT_REQUEST = 7;
    const CHAT_REQUEST_ACCEPTED = 8;

    const PROFILE_UPDATES = 1;
    const STATUS_UPDATE = 2;
    const STATUS_CLEAR = 3;

    const FILTER_UNARCHIVE = 1;
    const FILTER_ARCHIVE = 2;
    const FILTER_ACTIVE = 3;
    const FILTER_INACTIVE = 4;
    const FILTER_ALL = 5;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'last_seen',
        'is_online',
        'about',
        'photo_url',
        'activation_code',
        'is_active',
        'is_system',
        'email_verified_at',
        'player_id',
        'is_subscribed',
        'gender',
        'privacy',
        'address',
        'is_photo_see',
        'is_seen_show',
        'is_subscribed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chatRequest()
    {
        return $this->hasMany(ChatRequest::class, 'from_id');
    }

    public function conversationSenderUser()
    {
        return $this->hasMany(Conversation::class, 'from_id');
    }

    public function conversationReceiverUser()
    {
        return $this->hasMany(Conversation::class, 'to_id');
    }

    public function conversationReplyMessage()
    {
        return $this->hasMany(Conversation::class, 'reply_to');
    }

}
