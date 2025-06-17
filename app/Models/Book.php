<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'category_id',
        'author',
        'publisher',
        'publish_year',
        'quantity',
        'total_borrowed',
        'description',
        'cover_image',
        'status'
    ];

    protected $casts = [
        'publish_year' => 'integer',
        'quantity' => 'integer',
        'total_borrowed' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'book_id');
    }

    public function isAvailable()
    {
        return $this->status === 'available' && $this->quantity > 0;
    }
}