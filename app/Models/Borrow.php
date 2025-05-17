<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'member_id',
        'borrow_date',
        'return_date',
        'actual_return_date',
        'fine',
        'status',
        'notes',
        'issued_by',
        'received_by'
    ];

    protected $dates = [
        'borrow_date',
        'return_date',
        'actual_return_date'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function receivedBy()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function calculateFine()
    {
        if ($this->status !== 'returned') {
            $dueDate = Carbon::parse($this->return_date);
            $today = Carbon::today();
            
            if ($today->gt($dueDate)) {
                $daysLate = $today->diffInDays($dueDate);
                // Assuming fine is 1000 per day
                $this->fine = $daysLate * 1000;
                $this->save();
            }
        }
        
        return $this->fine;
    }
}