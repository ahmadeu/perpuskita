<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('category')->paginate(12);
        $categories = Category::all();
        
        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Search for books based on query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        // Query books based on title, author, or category name
        $books = Book::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('author', 'LIKE', "%{$search}%")
            ->orWhereHas('category', function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->with('category')
            ->paginate(12);
        
        $categories = Category::all();
        
        return view('books.index', compact('books', 'categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('book-covers', 'public');
        }
        
        $book = Book::create($validated);
        
        return redirect()->route('books.show', $book)
                         ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book->load('category');
        
        // Get similar books in the same category
        $similarBooks = Book::where('category_id', $book->category_id)
                           ->where('id', '!=', $book->id)
                           ->limit(4)
                           ->get();
        
        return view('books.show', compact('book', 'similarBooks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            
            $validated['cover_image'] = $request->file('cover_image')->store('book-covers', 'public');
        }
        
        $book->update($validated);
        
        return redirect()->route('books.show', $book)
                         ->with('success', 'Buku berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        // Delete the book cover if exists
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        
        $book->delete();
        
        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil dihapus!');
    }
}