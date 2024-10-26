<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'borrow_date', 'return_date', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function buku() {
        return $this->belongsTo(Buku::class, 'book_id');
    }
}
