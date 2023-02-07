<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRequest extends Model
{
    use HasFactory;

    public const STATUS_ACCEPTED = 1;
    public const STATUS_PENDING = 0;
    public const STATUS_DECLINE = 2;
    public $table = 'chat_requests';
    public $fillable = [
        'from_id',
        'owner_id',
        'owner_type',
        'status',
    ];

    protected $casts = [
        'from_id'    => 'integer',
        'owner_id'   => 'string',
        'owner_type' => 'string',
        'status'     => 'integer',
    ];


    public function receiver()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function myContact()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
