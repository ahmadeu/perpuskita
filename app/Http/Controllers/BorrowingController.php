<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->paginate(10);
        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function create(Book $book)
    {
        // Cek apakah user memiliki role 'user' atau 'admin'
        if (!in_array(Auth::user()->role, ['user', 'admin'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk meminjam buku.');
        }

        // Jika admin, tampilkan form dengan daftar user dan buku
        if (Auth::user()->role === 'admin') {
            $users = User::where('role', 'user')->get();
            $books = Book::all();
            return view('admin.borrowings.create', compact('books', 'users'));
        }

        // Jika user biasa, cek stok buku
        if ($book->quantity <= 0) {
            return redirect()->back()->with('error', 'Maaf, buku ini sedang tidak tersedia.');
        }

        // Cek apakah user sudah meminjam buku yang sama
        $existingBorrowing = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved', 'borrowed'])
            ->first();

        if ($existingBorrowing) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan peminjaman buku ini sebelumnya.');
        }

        // Jika user biasa, tampilkan form biasa
        return view('user.borrow-form', compact('book'));
    }

    public function store(Request $request)
    {
        try {
            // Cek apakah user memiliki role 'user' atau 'admin'
            if (!in_array(Auth::user()->role, ['user', 'admin'])) {
                Log::warning('User dengan role ' . Auth::user()->role . ' mencoba mengakses store peminjaman');
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk meminjam buku.');
            }

            Log::info('Mencoba menyimpan peminjaman baru', [
                'user_id' => Auth::id(),
                'book_id' => $request->book_id,
                'user_notes' => $request->user_notes
            ]);

            // Validasi berbeda untuk admin dan user
            if (Auth::user()->role === 'admin') {
                $request->validate([
                    'book_id' => 'required|exists:books,id',
                    'user_id' => 'required|exists:users,id',
                    'borrow_date' => 'required|date',
                    'due_date' => 'required|date|after:borrow_date',
                    'notes' => 'nullable|string|max:500'
                ]);

                // Buat peminjaman baru untuk admin
                $borrowing = Borrowing::create([
                    'user_id' => $request->user_id,
                    'book_id' => $request->book_id,
                    'request_date' => now(),
                    'borrow_date' => $request->borrow_date,
                    'due_date' => $request->due_date,
                    'notes' => $request->notes,
                    'status' => 'borrowed'
                ]);

                // Update stok buku
                $book = Book::findOrFail($request->book_id);
                $book->quantity = max(0, $book->quantity - 1);
                $book->total_borrowed += 1;
                $book->save();

                Log::info('Peminjaman berhasil dibuat oleh admin', ['borrowing_id' => $borrowing->id]);
                return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dibuat.');
            } else {
                // Validasi untuk user biasa
                $request->validate([
                    'book_id' => 'required|exists:books,id',
                    'user_notes' => 'nullable|string|max:500'
                ]);

                $book = Book::findOrFail($request->book_id);

                // Cek stok buku untuk user biasa
                if ($book->quantity <= 0) {
                    Log::warning('Buku tidak tersedia', ['book_id' => $book->id]);
                    return redirect()->back()->with('error', 'Maaf, buku ini sedang tidak tersedia.');
                }

                // Cek apakah user sudah meminjam buku yang sama
                $existingBorrowing = Borrowing::where('user_id', Auth::id())
                    ->where('book_id', $request->book_id)
                    ->whereIn('status', ['pending', 'approved', 'borrowed'])
                    ->first();

                if ($existingBorrowing) {
                    Log::warning('User sudah meminjam buku yang sama', [
                        'user_id' => Auth::id(),
                        'book_id' => $request->book_id
                    ]);
                    return redirect()->back()->with('error', 'Anda sudah mengajukan peminjaman buku ini sebelumnya.');
                }

                // Buat peminjaman baru untuk user biasa
                $borrowing = Borrowing::create([
                    'user_id' => Auth::id(),
                    'book_id' => $request->book_id,
                    'request_date' => now(),
                    'user_notes' => $request->user_notes,
                    'status' => 'pending'
                ]);

                Log::info('Peminjaman berhasil dibuat oleh user', ['borrowing_id' => $borrowing->id]);
                return redirect()->route('user.borrowings')->with('success', 'Pengajuan peminjaman berhasil dikirim. Silakan tunggu persetujuan dari admin.');
            }
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan peminjaman:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengajukan peminjaman: ' . $e->getMessage());
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
                'borrow_date' => 'required|date',
                'due_date' => 'required|date|after:borrow_date',
                'return_date' => 'nullable|date|after:borrow_date',
                'status' => 'required|in:pending,approved,borrowed,returned,rejected,overdue',
                'notes' => 'nullable|string'
            ]);

            // Update status buku jika diperlukan
            if ($validated['status'] === 'approved' || $validated['status'] === 'borrowed') {
                $book = $borrowing->book;
                $book->quantity = max(0, $book->quantity - 1);
                if ($borrowing->status !== 'approved' && $borrowing->status !== 'borrowed') {
                    $book->total_borrowed += 1;
                }
                $book->save();
            } elseif ($validated['status'] === 'returned' || $validated['status'] === 'rejected') {
                $book = $borrowing->book;
                $book->quantity += 1;
                $book->save();
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
            // Kembalikan status buku jika masih dipinjam
            if ($borrowing->status === 'borrowed') {
                $book = $borrowing->book;
                $book->quantity += 1;
                $book->save();
            }

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

    public function indexUser()
    {
        // Cek apakah user memiliki role 'user'
        if (Auth::user()->role !== 'user') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat daftar peminjaman.');
        }

        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with(['book'])
            ->latest()
            ->paginate(10);

        return view('user.borrowings', compact('borrowings'));
    }

    public function show(Borrowing $borrowing)
    {
        // Cek apakah user memiliki role 'user'
        if (Auth::user()->role !== 'user') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat detail peminjaman.');
        }

        // Pastikan user hanya bisa melihat peminjaman miliknya
        if ($borrowing->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.borrowing-detail', compact('borrowing'));
    }

    public function return(Borrowing $borrowing)
    {
        try {
            // Update status peminjaman
            $borrowing->update([
                'status' => 'returned',
                'return_date' => now()
            ]);

            // Kembalikan stok buku
            $book = $borrowing->book;
            $book->quantity += 1;
            $book->save();

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