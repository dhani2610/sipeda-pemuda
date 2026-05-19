<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
