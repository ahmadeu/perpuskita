<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ Tambahkan ini
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = User::where('role', 'user')->count();
        $totalCategories = Category::count();
        // $totalBorrows = Borrow::count();
        
        // $activeBorrows = Borrow::where('status', 'borrowed')->count();
        // $overdueBooks = Borrow::where('status', 'borrowed')
        //                     ->where('return_date', '<', Carbon::today())
        //                     ->count();
        
        // $recentBorrows = Borrow::with(['book', 'member'])
        //                     ->orderBy('created_at', 'desc')
        //                     ->take(5)
        //                     ->get();
                            
        $popularBooks = Book::withCount('borrows')
                            ->orderBy('borrows_count', 'desc')
                            ->take(5)
                            ->get();

        $user = Auth::user(); // ✅ Pakai Auth::user() bukan auth()->user()

        return view('user.dashboard', compact(
            'totalBooks',
            'totalMembers',
            'totalCategories',
            'totalBorrows',
            'activeBorrows',
            'overdueBooks',
            'recentBorrows',
            'popularBooks',
            'user'
        ));
    }

    public function welcome()
    {
        $totalBooks = Book::count();
        $totalMembers = User::where('role', 'user')->count();
        $recentBooks = Book::orderBy('created_at', 'desc')->take(6)->get();
        $categories = Category::all();

        $user = Auth::user(); // ✅ Sama di sini

        return view('welcome', compact(
            'totalBooks',
            'totalMembers',
            'recentBooks',
            'categories',
            'user'
        ));
    }
}
