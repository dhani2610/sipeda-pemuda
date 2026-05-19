<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemuda extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom untuk mass-assignment
    protected $guarded = ['id'];
}
