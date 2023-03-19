<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'photo_url', 'group_type', 'privacy', 'created_by',
    ];

    public static $rules = [
        'name'        => 'required|string|max:100',
        'description' => 'nullable|string',
        'privacy'     => 'nullable|integer',
        'group_type'  => 'nullable|integer',
        'users'       => 'required|array',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users', 'group_id', 'user_id')->wherePivot('deleted_at', '=',
            null)->withPivot(['role', 'deleted_at', 'created_at'])->orderByDesc('role')->orderBy('users.name', 'asc');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getGroupCreatedByAttribute()
    {
        return $this->createdByUser->name;
    }
}
