<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sipeda extends Model
{

    protected $guarded = [];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class);
    }
}
