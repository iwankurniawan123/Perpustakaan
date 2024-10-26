<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index() {
        $peminjaman = Peminjaman::with(['buku', 'user'])->get();
        return view('peminjaman.index', compact('peminjaman'));
    }
}
