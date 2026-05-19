<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::orderBy('ordering', 'asc')->get();
        return view('kategori.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'ordering' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        Kategori::create($validated);
        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'ordering' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $kategori->update($validated);
        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
