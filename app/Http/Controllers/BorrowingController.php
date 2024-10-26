<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index() {
        $books = Buku::all();
        return view('pinjam.pinjam', compact('books'));
    }

    public function store(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:bukus,id', // Make sure the table name is pluralized to match your migration
            'borrow_date' => 'required|date',
        ]);
    
        // Find the book by ID
        $book = Buku::find($request->book_id);
        
        // Check if the book is available for borrowing
        if ($book->available <= 0) {
            return redirect()->route('pinjam.index')->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }
    
        // Logic to record the book borrowing
        $borrow = new Peminjaman();
        $borrow->book_id = $book->id;
        $borrow->user_id = Auth::user()->id; // Get logged-in student ID
        $borrow->borrow_date = $request->borrow_date;

        $borrow->return_date = date('Y-m-d', strtotime($request->borrow_date . ' + 7 days'));
        $borrow->save();
    
        // Update the book's available count
        $book->available -= 1; // Decrease stock by 1
        $book->save();
    
        return redirect()->route('pinjam.index')->with('success', 'Buku berhasil dipinjam!');
    }
}
