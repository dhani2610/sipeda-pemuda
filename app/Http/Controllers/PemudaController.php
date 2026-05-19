<?php

namespace App\Http\Controllers;

use App\Models\Pemuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PemudaController extends Controller
{
    // Daftar semua input file untuk dilooping
    private $fileFields = [
        'photo',
        'document_ktp',
        'doc_ijazah',
        'doc_sehat',
        'doc_narkoba',
        'doc_skck',
        'doc_bpjs',
        'doc_toefl',
        'doc_rekomendasi',
        'doc_karya_nyata',
        'doc_rekomendasi_kab',
        'doc_aktif_pendidikan',
        'doc_izin_ortu',
        'doc_nib',
        'doc_omset',
        'doc_tempat_usaha'
    ];

    public function index(Request $request)
    {
        // Ambil filter type dari parameter URL (Default: ppan)
        $currentType = $request->query('type', 'ppan');

        $data = Pemuda::where('registration_type', $currentType)->latest()->get();

        // Data array tipe yang sudah disesuaikan dengan gambar
        $types = [
            'ppan'      => 'PPAN',
            'ppap'      => 'PPAP',
            'pelopor'   => 'Pemuda Pelopor',
            'pkpi'      => 'PKPI',
            'wirausaha' => 'Wirausaha Muda'
        ];

        return view('pemuda.index', compact('data', 'currentType', 'types'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        // Looping untuk upload file
        foreach ($this->fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->extension();
                $file->move(public_path('uploads/pemuda'), $filename);
                $data[$field] = 'uploads/pemuda/' . $filename;
            }
        }

        Pemuda::create($data);
        return back()->with('success', 'Data pemuda berhasil ditambahkan.');
    }

    public function update(Request $request, Pemuda $pemuda)
    {
        $data = $request->except(['_token', '_method']);

        // Looping untuk upload file baru & hapus yang lama jika ada
        foreach ($this->fileFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika ada
                if ($pemuda->$field && File::exists(public_path($pemuda->$field))) {
                    File::delete(public_path($pemuda->$field));
                }

                // Upload file baru
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->extension();
                $file->move(public_path('uploads/pemuda'), $filename);
                $data[$field] = 'uploads/pemuda/' . $filename;
            }
        }

        $pemuda->update($data);
        return back()->with('success', 'Data pemuda berhasil diperbarui.');
    }

    public function destroy(Pemuda $pemuda)
    {
        // Hapus semua file yang terkait
        foreach ($this->fileFields as $field) {
            if ($pemuda->$field && File::exists(public_path($pemuda->$field))) {
                File::delete(public_path($pemuda->$field));
            }
        }

        $pemuda->delete();
        return back()->with('success', 'Data pemuda berhasil dihapus.');
    }

    public function show($id)
    {
        $pemuda = Pemuda::findOrFail($id);

        // Label rapi untuk dokumen sesuai gambar
        $docLabels = [
            'doc_ijazah' => 'Ijazah Terakhir',
            'doc_sehat' => 'Surat Ket. Sehat',
            'doc_narkoba' => 'Surat Bebas Narkoba',
            'doc_skck' => 'SKCK Aktif',
            'doc_bpjs' => 'Kartu BPJS',
            'doc_toefl' => 'Sertifikat TOEFL',
            'photo' => 'Pas Photo 3x4',
            'document_ktp' => 'Kartu Tanda Penduduk (KTP)',
            'doc_rekomendasi' => 'Surat Rekomendasi',
            'doc_karya_nyata' => 'Bukti Karya Nyata',
            'doc_rekomendasi_kab' => 'Rekom. Kab/Kota',
            'doc_aktif_pendidikan' => 'Aktif Pendidikan',
            'doc_izin_ortu' => 'Izin Orang Tua',
            'doc_nib' => 'NIB / SKU',
            'doc_omset' => 'Bukti Omset',
            'doc_tempat_usaha' => 'Bukti Tempat Usaha'
        ];

        return view('pemuda.show', compact('pemuda', 'docLabels'));
    }

    // Proses Approve / Reject
    public function updateStatus(Request $request, $id)
    {
        $pemuda = Pemuda::findOrFail($id);

        // Validasi input status
        $request->validate([
            'status' => 'required|in:APPROVE,REJECT'
        ]);

        $pemuda->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pendaftaran berhasil diubah menjadi ' . $request->status);
    }
}
