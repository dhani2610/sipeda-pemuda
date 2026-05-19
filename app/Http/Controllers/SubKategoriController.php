<?php
namespace App\Http\Controllers;

use App\Models\SubKategori;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    public function index()
    {
        $data = SubKategori::with('kategori')->orderBy('kategori_id')->orderBy('ordering')->get();
        $kategoris = Kategori::where('is_active', 1)->get();
        return view('subkategori.index', compact('data', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_sub_kategori' => 'required|string|max:255',
            'ordering' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        SubKategori::create($validated);
        return back()->with('success', 'Sub Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, SubKategori $subkategori)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_sub_kategori' => 'required|string|max:255',
            'ordering' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        $subkategori->update($validated);
        return back()->with('success', 'Sub Kategori berhasil diperbarui.');
    }

    public function destroy(SubKategori $subkategori)
    {
        $subkategori->delete();
        return back()->with('success', 'Sub Kategori berhasil dihapus.');
    }
}