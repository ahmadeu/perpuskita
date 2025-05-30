<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;

class AksesController extends Controller
{

    function index()
    {
        return view('admin.dashboard');
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
