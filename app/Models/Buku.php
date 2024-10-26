<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'cover', 'title', 'author', 'publisher', 'year', 'isbn', 'category_id', 'available'
    ];

    public function category() {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class);
    }
}
