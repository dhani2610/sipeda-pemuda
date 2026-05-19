<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi (kecuali ID) agar mempermudah proses Create/Update
    protected $guarded = ['id'];

    /**
     * Relasi ke model SubKategori (One to Many)
     * Artinya: 1 Kategori memiliki banyak Sub Kategori
     */
    public function subKategoris()
    {
        // Parameter: (NamaModelTarget::class, 'foreign_key', 'local_key')
        return $this->hasMany(SubKategori::class, 'kategori_id', 'id');
    }
}