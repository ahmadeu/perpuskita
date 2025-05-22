<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
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
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
                'isbn' => 'nullable|string|max:20',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
                'publish_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
                'quantity' => 'required|integer|min:1',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:available,unavailable'
        ]);
        
        if ($request->hasFile('cover_image')) {
                $path = $request->file('cover_image')->store('book-covers', 'public');
                $validated['cover_image'] = $path;
        }
        
            Log::info('Data yang akan disimpan:', $validated);
        $book = Book::create($validated);
            Log::info('Buku berhasil dibuat:', ['id' => $book->id]);
        
            return redirect()->route('books.index')
                ->with('success', 'Buku berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error saat membuat buku:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menambahkan buku: ' . $e->getMessage());
        }
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
        return view('admin.books.edit', compact('book', 'categories'));
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
        try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
                'isbn' => 'nullable|string|max:20',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
                'publish_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
                'quantity' => 'required|integer|min:1',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:available,unavailable'
        ]);
        
        if ($request->hasFile('cover_image')) {
                // Hapus gambar lama jika ada
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
                $path = $request->file('cover_image')->store('book-covers', 'public');
                $validated['cover_image'] = $path;
        }
        
            Log::info('Data yang akan diupdate:', $validated);
        $book->update($validated);
            Log::info('Buku berhasil diupdate:', ['id' => $book->id]);
        
            return redirect()->route('books.index')
                ->with('success', 'Buku berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate buku:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat memperbarui buku: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return redirect()->route('books.index')
                ->with('success', 'Buku berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error saat menghapus buku:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus buku: ' . $e->getMessage());
        }
    }
}