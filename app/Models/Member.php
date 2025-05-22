<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'name',
        'email',
        'phone',
        'address',
        'join_date',
        'expire_date',
        'status',
        'profile_image'
    ];

    // public function borrows()
    // {
    //     return $this->hasMany(Borrow::class);
    // }

    public function activeBorrows()
    {
        return $this->borrows()->where('status', 'borrowed');
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}