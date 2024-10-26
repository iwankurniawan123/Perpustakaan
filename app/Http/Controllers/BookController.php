<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Buku::all();
        return view('buku.view_buku', compact('books'));
    }

    public function create() {
        $categories = Kategori::all();
        return view('buku.create_buku', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:kategoris,id',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'year' => 'nullable|date', // 'nullable' jika tahun tidak wajib
            'isbn' => 'required|string',
            'available' => 'required|integer|min:1', // Mengharuskan available berupa integer minimal 1
        ]);
    
        $coverName = null; // Inisialisasi variabel untuk cover
    
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $coverName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/buku', $coverName);
        }
    
        try {
            // Membuat data buku
            $books = Buku::create([
                'category_id' => $request->category_id,
                'cover' => $coverName,
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
                'isbn' => $request->isbn,
                'available' => $request->available,
            ]);
        
            // Menambahkan pesan sukses atau redirect ke halaman tertentu
            return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
            } catch (\Throwable $th) {
                return back()->with('gagal'. $th->getMessage());
            }
    }

    public function edit($id) {
        $books = Buku::findOrFail($id);
        $categories = Kategori::all();
        return view('buku.edit_buku', compact('books', 'categories'));
    }

    public function update(Request $request, $id) {
    $request->validate([
        'category_id' => 'required|exists:kategoris,id',
        'cover' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'title' => 'required|string',
        'author' => 'required|string',
        'publisher' => 'required|string',
        'year' => 'nullable|date',
        'isbn' => 'required|string',
        'available' => 'required|integer|min:1',
    ]);

    $books = Buku::findOrFail($id);

    $coverName = $books->cover; // Default to existing cover

    if ($request->hasFile('cover')) {
        $image = $request->file('cover');
        $coverName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/buku', $coverName);

        // Delete old cover if exists and is different from new cover
        if ($books->cover && $books->cover !== $coverName) {
            Storage::delete('public/buku/'.$books->cover);
        }
    }

    try {
        $books->update([
            'category_id' => $request->category_id,
            'cover' => $coverName,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'isbn' => $request->isbn,
            'available' => $request->available,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate.');
    } catch (\Throwable $th) {
        return back()->with('gagal', 'Gagal memperbarui buku: ' . $th->getMessage());
    }
}

public function delete($id) {
    $books = Buku::findOrFail($id);

    try {
        // Delete cover image if it exists
        if ($books->cover) {
            Storage::delete('public/buku/'.$books->cover);
        }

        // Delete the book
        $books->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    } catch (\Throwable $th) {
        return back()->with('gagal', 'Gagal menghapus buku: ' . $th->getMessage());
    }
}

}
