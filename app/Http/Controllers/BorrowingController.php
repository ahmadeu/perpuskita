<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->paginate(10);
        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::where('status', 'available')->get();
        $users = User::where('role', 'user')->get();
        return view('admin.borrowings.create', compact('books', 'users'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'book_id' => 'required|exists:books,id',
                'borrow_date' => 'required|date',
                'due_date' => 'required|date|after:borrow_date',
                'notes' => 'nullable|string'
            ]);

            $validated['status'] = 'borrowed';

            $book = Book::findOrFail($validated['book_id']);
            if ($book->status !== 'available') {
                return back()->with('error', 'Buku tidak tersedia untuk dipinjam');
            }

            $borrowing = Borrowing::create($validated);
            
            // Update status buku
            $book->update(['status' => 'unavailable']);

            return redirect()->route('borrowings.index')
                ->with('success', 'Peminjaman berhasil dibuat');
        } catch (\Exception $e) {
            Log::error('Error saat membuat peminjaman:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat membuat peminjaman: ' . $e->getMessage());
        }
    }

    public function edit(Borrowing $borrowing)
    {
        $books = Book::all();
        $users = User::where('role', 'user')->get();
        return view('admin.borrowings.edit', compact('borrowing', 'books', 'users'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'book_id' => 'required|exists:books,id',
                'borrow_date' => 'required|date',
                'due_date' => 'required|date|after:borrow_date',
                'return_date' => 'nullable|date|after:borrow_date',
                'status' => 'required|in:borrowed,returned,overdue',
                'notes' => 'nullable|string'
            ]);

            // Jika buku diubah
            if ($borrowing->book_id !== $validated['book_id']) {
                // Kembalikan status buku lama
                $oldBook = Book::find($borrowing->book_id);
                $oldBook->update(['status' => 'available']);

                // Update status buku baru
                $newBook = Book::find($validated['book_id']);
                $newBook->update(['status' => 'unavailable']);
            }

            $borrowing->update($validated);

            return redirect()->route('borrowings.index')
                ->with('success', 'Peminjaman berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate peminjaman:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat memperbarui peminjaman: ' . $e->getMessage());
        }
    }

    public function destroy(Borrowing $borrowing)
    {
        try {
            // Kembalikan status buku
            $book = Book::find($borrowing->book_id);
            $book->update(['status' => 'available']);

            $borrowing->delete();
            return redirect()->route('borrowings.index')
                ->with('success', 'Peminjaman berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error saat menghapus peminjaman:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus peminjaman: ' . $e->getMessage());
        }
    }

    public function return(Borrowing $borrowing)
    {
        try {
            if ($borrowing->status === 'returned') {
                return back()->with('error', 'Buku sudah dikembalikan');
            }

            $borrowing->update([
                'return_date' => now(),
                'status' => 'returned'
            ]);

            // Update status buku
            $book = Book::find($borrowing->book_id);
            $book->update(['status' => 'available']);

            return redirect()->route('borrowings.index')
                ->with('success', 'Buku berhasil dikembalikan');
        } catch (\Exception $e) {
            Log::error('Error saat mengembalikan buku:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat mengembalikan buku: ' . $e->getMessage());
        }
    }
}