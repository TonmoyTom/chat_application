<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    const ROLE_MEMBER = 1;
    const ROLE_ADMIN = 2;

    protected $fillable = [
        'group_id', 'user_id', 'added_by', 'role', 'removed_by', 'deleted_at'
    ];

    public static $rules = [
        'group_id'   => 'required|integer',
        'user_id'    => 'required|integer',
        'is_removed' => 'nullable|integer',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
