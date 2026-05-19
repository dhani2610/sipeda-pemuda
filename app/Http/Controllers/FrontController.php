<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Sipeda;
use App\Models\Setting;
use Hamcrest\Core\Set;

class FrontController extends Controller
{
    /**
     * Menampilkan halaman utama dengan menu dinamis
     */
    public function index()
    {
        $setting = Setting::first();

        return view('welcome', compact('setting'));
    }


}
