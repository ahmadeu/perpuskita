<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AksesController extends Controller
{

    function index()
    {
        return view('admin.dashboard');
    }
    function user()
    {
        return view('user.dashboard');
    }
    function guest()
    {
        return view('guest.dashboard');
    }
}
