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
        'description',
        'cover_image',
        'status'
    ];

    protected $casts = [
        'publish_year' => 'integer',
        'quantity' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available' && $this->quantity > 0;
    }
}