@extends('layouts.app')


@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<style>
    .setting-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid #f1f5f9;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Aksen Judul Section */
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
    }

    .accent-line {
        width: 6px;
        height: 24px;
        border-radius: 10px;
        margin-right: 15px;
    }

    .accent-purple {
        background-color: #8b5cf6;
    }

    .accent-green {
        background-color: #10b981;
    }

    .section-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    /* Custom Inputs */
    .form-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .custom-input {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 0.95rem;
        color: #1e293b;
        width: 100%;
        transition: all 0.2s;
    }

    .custom-input:focus {
        background-color: #ffffff;
        border-color: #10b981;
        outline: none;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }

    /* Divider */
    .divider {
        height: 1px;
        background-color: #f1f5f9;
        margin: 40px 0;
    }

    /* Button */
    .btn-simpan {
        background-color: #10b981;
        color: #ffffff;
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 30px;
        border: none;
        transition: all 0.3s;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-simpan:hover {
        background-color: #059669;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.25);
        color: #ffffff;
    }

    /* Dropify Customization untuk Logo */
   .dropify-wrapper {
            border: 2px dashed #cbd5e1 !important;
            /* Warna border abu-abu terang */
            border-radius: 12px !important;
            /* Sudut membulat */
            background-color: #f8fafc !important;
            /* Background abu-abu sangat muda */
            transition: all 0.3s ease-in-out;
            padding: 5px !important;
            /* Mengurangi padding dalam agar tidak sempit */
        }

        .dropify-wrapper:hover {
            border-color: #10b981 !important;
            /* Border hijau emerald saat dihover */
            background-color: #ecfdf5 !important;
            /* Background hijau muda saat dihover */
        }

        /* Mengatur posisi container pesan agar lebih ke tengah */
        .dropify-wrapper .dropify-message {
            top: 50% !important;
            transform: translateY(-50%) !important;
        }

        /* Mengecilkan tulisan "Tarik file / Klik" */
        .dropify-wrapper .dropify-message p {
            font-size: 11px !important;
            /* Dikecilkan drastis dari default */
            color: #64748b !important;
            font-weight: 600;
            margin-top: 5px !important;
            line-height: 1.2 !important;
        }

        /* Mengecilkan ikon awan */
        .dropify-wrapper .dropify-message span.file-icon {
            color: #10b981 !important;
            font-size: 24px !important;
            /* Dikecilkan agar pas */
        }

        /* Memperbaiki ukuran ikon awan bawaan dropify (bukan class file-icon) */
        .dropify-wrapper .dropify-message .dropify-font-upload:before,
        .dropify-font-upload:before {
            font-size: 24px !important;
            color: #10b981 !important;
        }

        /* Mengecilkan font nama file saat ada file yang dipilih */
        .dropify-wrapper .dropify-preview .dropify-infos .dropify-infos-inner p.dropify-filename {
            font-size: 10px !important;
            margin-bottom: 2px !important;
        }

        .dropify-wrapper .dropify-preview .dropify-infos .dropify-infos-inner p.dropify-infos-message {
            font-size: 9px !important;
            padding-top: 2px !important;
        }

        /* Mempercantik tombol hapus (silang) */
        .dropify-wrapper .dropify-clear {
            background-color: #ef4444 !important;
            /* Warna merah modern */
            border-radius: 50% !important;
            padding: 4px 8px !important;
            /* Dikecilkan sedikit */
            top: 5px !important;
            right: 5px !important;
            font-weight: bold;
            font-size: 10px !important;
            transition: transform 0.2s;
        }

        .dropify-wrapper .dropify-clear:hover {
            transform: scale(1.1);
        }

    .logo-helper-text {
        font-size: 0.7rem;
        color: #94a3b8;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 38px;
        text-align: center;
        letter-spacing: 0.5px;
    }
</style>
<div class="container-fluid py-4">

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 mx-auto" style="max-width: 900px;">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="setting-card">
        <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section-header">
                <div class="accent-line accent-purple"></div>
                <h4 class="section-title">Identitas Instansi</h4>
            </div>

            <div class="row mb-3">
                <div class="col-md-7 mb-4">
                    <label class="form-label">Nama Instansi</label>
                    <input type="text" name="nama_instansi" class="custom-input"
                        value="{{ $setting->nama_instansi ?? '' }}"
                        placeholder="Contoh: Pendaftaran Pemuda Sulawesi Tengah">
                </div>

                <div class="col-md-4 offset-md-1 mb-4 d-flex flex-column align-items-center">
                    <label class="form-label text-center w-100">Logo Instansi</label>
                    <div style="width: 180px; height: 180px;">
                        <input type="file" name="logo_instansi" class="dropify-logo"
                            data-default-file="{{ isset($setting->logo_instansi) ? asset($setting->logo_instansi) : '' }}"
                            data-max-file-size="2M" />
                    </div>
                    <p class="logo-helper-text">Rekomendasi: PNG Transparan (512x512)</p>
                </div>
            </div>

            <div class="divider"></div>

            <div class="section-header">
                <div class="accent-line accent-green"></div>
                <h4 class="section-title">Informasi Publik</h4>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" class="custom-input" rows="4"
                        placeholder="Tuliskan deskripsi singkat instansi di sini...">{{ $setting->deskripsi_singkat ?? '' }}</textarea>
                </div>
            </div>

            <div class="text-end mt-4 pt-2">
                <button type="submit" class="btn btn-simpan">
                    <i class="fas fa-download"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi Dropify khusus untuk kotak logo
        $('.dropify-logo').dropify({
            messages: {
                'default': 'Pilih Logo',
                'replace': 'Ganti',
                'remove': 'Hapus',
                'error': 'Error'
            }
        });
    });
</script>
@endpush
