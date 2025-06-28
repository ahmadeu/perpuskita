<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'book_id',
        'request_date',
        'borrow_date',
        'due_date',
        'return_date',
        'pickup_time',
        'status',
        'user_notes',
        'notes',
    ];

    protected $casts = [
        'request_date' => 'datetime',
        'borrow_date' => 'datetime',
        'due_date' => 'datetime',
        'return_date' => 'datetime',
        'pickup_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
