<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function buku() {
        return $this->hasMany(Buku::class);
    }
}
