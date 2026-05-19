<?php
namespace App\Http\Controllers;

use App\Models\Sipeda;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SipedaController extends Controller
{
    public function index()
    {
        $data = Sipeda::with(['kategori', 'subKategori'])->get();
        $kategoris = Kategori::where('is_active', 1)->get();
        return view('sipeda.index', compact('data', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required',
            'sub_kategori_id' => 'required',
            'title' => 'required',
            'deskripsi' => 'nullable',
            'is_active' => 'required',
            'file' => 'nullable|file|max:5120'
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('sipeda_files', 'public');
        }

        Sipeda::create($validated);
        return back()->with('success', 'Data Sipeda berhasil ditambahkan.');
    }

    public function update(Request $request, Sipeda $sipeda)
    {
        $validated = $request->except(['_token', '_method', 'file']);

        if ($request->hasFile('file')) {
            if ($sipeda->file) {
                Storage::disk('public')->delete($sipeda->file);
            }
            $validated['file'] = $request->file('file')->store('sipeda_files', 'public');
        }

        $sipeda->update($validated);
        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Sipeda $sipeda)
    {
        if ($sipeda->file) { Storage::disk('public')->delete($sipeda->file); }
        $sipeda->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    // Fungsi untuk AJAX
    public function getSubKategori($id)
    {
        $subKategori = \App\Models\SubKategori::where('kategori_id', $id)->orderBy('ordering')->get();
        return response()->json($subKategori);
    }
}
