@extends('layouts.app')


@section('content')

<style>
    /* Styling khusus menyerupai desain di gambar */
    .detail-wrapper {
        max-width: 1000px;
        margin: auto;
    }

    .btn-outline-back {
        border: 1px solid #e2e8f0;
        color: #475569;
        border-radius: 10px;
        font-weight: 500;
    }

    .btn-outline-back:hover {
        background: #f8fafc;
        color: #1e293b;
    }

    .detail-card {
        border-radius: 24px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #f1f5f9;
    }

    .detail-header {
        background: #10b981;
        height: 160px;
        position: relative;
    }

    .detail-badge {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
        padding: 6px 20px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        position: absolute;
        top: 20px;
        right: 20px;
        letter-spacing: 0.5px;
    }

    .profile-img-box {
        width: 130px;
        height: 130px;
        border-radius: 24px;
        background: #fff;
        padding: 6px;
        position: absolute;
        bottom: -65px;
        left: 40px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .profile-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 18px;
    }

    .profile-img-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 18px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #cbd5e1;
    }

    .detail-body {
        padding: 90px 40px 40px 40px;
    }

    .info-group {
        margin-bottom: 25px;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 1.1rem;
        float: left;
        margin-right: 15px;
        border: 1px solid #f1f5f9;
    }

    .info-label {
        font-size: 0.7rem;
        color: #94a3b8;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 2px;
    }

    .info-value {
        font-size: 1rem;
        color: #1e293b;
        font-weight: 600;
        margin: 0;
    }

    .info-value a {
        color: #10b981;
        text-decoration: none;
    }

    .section-title {
        font-size: 0.85rem;
        color: #94a3b8;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    /* Document Cards */
    .doc-card {
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        padding: 30px 15px;
        text-align: center;
        text-decoration: none;
        display: block;
        background: #fff;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        height: 100%;
    }

    .doc-card:hover {
        border-color: #10b981;
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.1);
        transform: translateY(-3px);
    }

    .doc-icon {
        font-size: 2.2rem;
        color: #10b981;
        margin-bottom: 15px;
        display: block;
    }

    .doc-title {
        font-size: 0.85rem;
        color: #475569;
        font-weight: 600;
        margin: 0;
        line-height: 1.4;
    }

    /* Action Bar Footer */
    .action-bar {
        background: #f8fafc;
        border-radius: 20px;
        padding: 25px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 40px;
    }

    .action-text h6 {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .action-text p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
    }

    .btn-tolak {
        border: 2px solid #fecdd3;
        color: #e11d48;
        background: #fff;
        font-weight: 700;
        padding: 10px 30px;
        border-radius: 12px;
        transition: all 0.2s;
    }

    .btn-tolak:hover {
        background: #e11d48;
        color: #fff;
        border-color: #e11d48;
    }

    .btn-setuju {
        background: #10b981;
        color: #fff;
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 12px;
        border: none;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-setuju:hover {
        background: #059669;
        transform: translateY(-2px);
    }
</style>
    <div class="detail-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('pemuda.index', ['type' => $pemuda->registration_type]) }}"
                class="btn btn-outline-back px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
            </a>
            <button class="btn btn-outline-back px-4 py-2" onclick="window.print()">
                Cetak Detail
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="detail-card mb-5">
            <div class="detail-header">
                <div class="detail-badge text-uppercase">
                    {{ $pemuda->registration_type }} - #{{ str_pad($pemuda->id, 5, '0', STR_PAD_LEFT) }}
                </div>

                <div class="profile-img-box">
                    @if ($pemuda->photo)
                        <img src="{{ asset($pemuda->photo) }}" alt="Foto">
                    @else
                        <div class="profile-img-placeholder"><i class="fas fa-user"></i></div>
                    @endif
                </div>
            </div>

            <div class="detail-body">
                <div class="d-flex justify-content-between align-items-start mb-5">
                    <div>
                        <h2 class="fw-bolder text-dark mb-1">{{ $pemuda->full_name_reg }}</h2>
                        <p class="text-muted mb-0">Terdaftar pada {{ $pemuda->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="text-end">
                        @if ($pemuda->status == 'PENDING')
                            <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fs-6">PENDING</span>
                        @elseif($pemuda->status == 'APPROVE')
                            <span class="badge bg-success px-4 py-2 rounded-pill fs-6">APPROVED</span>
                        @else
                            <span class="badge bg-danger px-4 py-2 rounded-pill fs-6">REJECTED</span>
                        @endif
                        <p class="text-muted mt-2 mb-0"
                            style="font-size: 0.7rem; text-transform: uppercase; font-weight:bold;">Status Pendaftaran</p>
                    </div>
                </div>

                <h6 class="section-title">Informasi Pribadi</h6>
                <div class="row mb-4">
                    <div class="col-md-6 info-group">
                        <div class="info-icon"><i class="far fa-calendar-alt"></i></div>
                        <div class="overflow-hidden">
                            <div class="info-label">Tempat, Tanggal Lahir</div>
                            <p class="info-value">{{ $pemuda->place_of_birth }},
                                {{ \Carbon\Carbon::parse($pemuda->date_of_birth)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 info-group">
                        <div class="info-icon"><i class="fas fa-praying-hands"></i></div>
                        <div class="overflow-hidden">
                            <div class="info-label">Agama</div>
                            <p class="info-value">{{ $pemuda->religion }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 info-group">
                        <div class="info-icon"><i class="far fa-clock"></i></div>
                        <div class="overflow-hidden">
                            <div class="info-label">Umur</div>
                            <p class="info-value">{{ $pemuda->age }} Tahun</p>
                        </div>
                    </div>
                    <div class="col-md-6 info-group">
                        <div class="info-icon"><i class="far fa-envelope"></i></div>
                        <div class="overflow-hidden">
                            <div class="info-label">Email</div>
                            <p class="info-value"><a href="mailto:{{ $pemuda->email }}">{{ $pemuda->email }}</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 info-group">
                        <div class="info-icon"><i class="fab fa-instagram"></i></div>
                        <div class="overflow-hidden">
                            <div class="info-label">Media Sosial</div>
                            <p class="info-value"><a href="#">{{ $pemuda->social_media ?? '-' }}</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 info-group">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="overflow-hidden">
                            <div class="info-label">Alamat</div>
                            <p class="info-value">{{ $pemuda->address }}</p>
                        </div>
                    </div>
                </div>

                <h6 class="section-title">Berkas Dokumen</h6>
                <div class="row g-3">
                    @foreach ($docLabels as $field => $label)
                        @if ($pemuda->$field)
                            <div class="col-md-3 col-sm-6">
                                <a href="{{ asset($pemuda->$field) }}" target="_blank" class="doc-card">
                                    <i class="far fa-file-alt doc-icon"></i>
                                    <p class="doc-title">{{ $label }}</p>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                @if (auth()->user()->role == 'admin')
                    @if ($pemuda->status == 'PENDING')
                        <div class="action-bar shadow-sm">
                            <div class="action-text">
                                <h6>Verifikasi Pendaftaran</h6>
                                <p>Tinjau seluruh berkas sebelum memberikan keputusan.</p>
                            </div>

                            <div class="d-flex gap-3">
                                <form action="{{ route('pemuda.status', $pemuda->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="REJECT">
                                    <button type="submit" class="btn btn-tolak"
                                        onclick="return confirm('Yakin ingin MENOLAK pendaftar ini?')">Tolak</button>
                                </form>

                                <form action="{{ route('pemuda.status', $pemuda->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="APPROVE">
                                    <button type="submit" class="btn btn-setuju"
                                        onclick="return confirm('Yakin ingin MENYETUJUI pendaftar ini?')">Setujui
                                        Pendaftaran</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="mt-5 text-center p-4 bg-light rounded-4">
                            <p class="text-muted mb-0 fw-bold">
                                <i class="fas fa-info-circle me-2"></i> Pendaftaran ini telah diproses
                                ({{ $pemuda->status }}).
                            </p>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection
