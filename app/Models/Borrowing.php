<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'request_date',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
        'notes',
        'user_notes'
    ];

    protected $casts = [
        'request_date' => 'date',
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
