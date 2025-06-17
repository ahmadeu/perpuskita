<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;

class AksesController extends Controller
{

    function index()
    {
        // Statistik Umum
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();
        $activeBorrowings = Borrowing::whereIn('status', ['pending', 'approved'])->count();
        
        // Perhitungan keterlambatan yang lebih akurat
        $lateReturns = Borrowing::whereIn('status', ['approved', 'borrowed'])
            ->where('due_date', '<', now())
            ->whereNull('return_date')
            ->get()
            ->map(function($borrowing) {
                $daysLate = max(0, now()->diffInDays($borrowing->due_date));
                
                // Update status, late_fee, dan days_late dalam satu query
                Borrowing::where('id', $borrowing->id)->update([
                    'status' => 'overdue',
                    'late_fee' => $daysLate * 1000,
                    'days_late' => $daysLate
                ]);
                
                return $borrowing;
            });
        
        // Hitung total denda dari semua peminjaman yang terlambat
        $totalLateFee = Borrowing::where('status', 'overdue')
            ->sum('late_fee');
        $lateReturnsCount = Borrowing::where('status', 'overdue')
            ->count();

        // Peminjaman Terbaru
        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        // Buku Populer
        $popularBooks = Book::orderBy('total_borrowed', 'desc')
            ->take(5)
            ->get();

        // Stok Menipis
        $lowStockBooks = Book::where('quantity', '<=', 3)
            ->orderBy('quantity', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalUsers',
            'activeBorrowings',
            'lateReturnsCount',
            'totalLateFee',
            'recentBorrowings',
            'popularBooks',
            'lowStockBooks'
        ));
    }
    function user()
    {
        $categories = Category::all();
        $books = Book::with('category')
            ->when(request('search'), function ($query) {
                $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('author', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%')
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    });
            })
            ->when(request('category'), function($query) {
                $query->where('category_id', request('category'));
            })
            ->latest()
            ->paginate(12);
            
        return view('user.dashboard', compact('books', 'categories'));
    }
    function guest()
    {
        $categories = Category::all();
        $books = Book::with('category')
            ->when(request('search'), function ($query) {
                $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('author', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%')
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    });
            })
            ->when(request('category'), function($query) {
                $query->where('category_id', request('category'));
            })
            ->latest()
            ->paginate(12);
            
        return view('guest.dashboard', compact('books', 'categories'));
    }

    public function showBook(Book $book)
    {
        
        return view('user.book-detail', compact('book'));
    }

    public function showGuestBook(Book $book)
    {
        return view('guest.book-detail', compact('book'));
    }
}
