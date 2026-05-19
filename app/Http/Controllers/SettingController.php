<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    // Menampilkan halaman form setting
    public function index()
    {
        // Ambil data pertama, jika kosong akan return null
        $setting = Setting::first();

        return view('setting.index', compact('setting'));
    }

    // Memproses Create atau Update
    public function update(Request $request)
    {
        $setting = Setting::first();
        $data = $request->except(['_token']);

        // Handle upload logo
        if ($request->hasFile('logo_instansi')) {
            // Hapus logo lama jika ada
            if ($setting && $setting->logo_instansi && File::exists(public_path($setting->logo_instansi))) {
                File::delete(public_path($setting->logo_instansi));
            }

            $file = $request->file('logo_instansi');
            $filename = time() . '_logo.' . $file->extension();
            $file->move(public_path('uploads/setting'), $filename);
            $data['logo_instansi'] = 'uploads/setting/' . $filename;
        }

        // Logika Create or Update
        if ($setting) {
            $setting->update($data);
            $pesan = 'Pengaturan berhasil diperbarui.';
        } else {
            Setting::create($data);
            $pesan = 'Pengaturan berhasil disimpan.';
        }

        return back()->with('success', $pesan);
    }
}
