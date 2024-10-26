<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['role:admin']], function() {
    Route::get('/admin', [RoleController::class, 'adminDashboard'])->name('admin.dashboard');

    // master
    Route::prefix('categories')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
    // route buku
    Route::prefix('buku')->group(function() {
        Route::get('/', [BookController::class, 'index'])->name('books.index');
        Route::get('/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/store', [BookController::class, 'store'])->name('books.store');
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::post('/update/{id}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/delete/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    });

    Route::prefix('pinjam')->group(function() {
        Route::get('/', [PeminjamanController::class, 'index'])->name('pinjam');
    });
});

Route::group(['middleware' => ['role:mahasiswa']], function() {
    Route::get('/mahasiswa', [RoleController::class, 'mahasiswaDashboard'])->name('mahasiswa.dashboard');

    // Peminjaman
    Route::prefix('peminjaman')->group(function() {
        Route::get('/', [BorrowingController::class, 'index'])->name('pinjam.index');
        Route::post('/pinjam-buku', [BorrowingController::class, 'store'])->name('pinjam.buku.store');
    });
});
