@extends('layouts.app')



@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <style>
        /* Custom Styling untuk Dropify agar lebih modern */
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
    </style>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark">Data Pemuda ({{ $types[$currentType] }})</h4>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#pemudaModal" onclick="resetForm()">
            <i class="fas fa-plus"></i> Tambah Pendaftar
        </button>
    </div>

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle text-nowrap">
                <thead class="table-light">
                    <tr>
                        <th>Pas Photo</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Lahir</th>
                        <th>Umur</th>
                        <th>Agama</th>
                        <th>No HP / Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                @if ($item->photo)
                                    <img src="{{ asset($item->photo) }}" class="rounded" width="50" height="60"
                                        style="object-fit:cover">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $item->full_name_reg }}</td>
                            <td>{{ $item->place_of_birth }}, {{ date('d-m-Y', strtotime($item->date_of_birth)) }}</td>
                            <td>{{ $item->age }} Tahun</td>
                            <td>{{ $item->religion }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if ($item->status == 'PENDING')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">PENDING</span>
                                @elseif($item->status == 'APPROVE')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">APPROVE</span>
                                @else
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">REJECT</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pemuda.show', $item->id) }}" class="btn btn-sm btn-info text-white">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-warning text-white edit-btn"
                                    data-data="{{ json_encode($item) }}" data-bs-toggle="modal"
                                    data-bs-target="#pemudaModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('pemuda.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="pemudaModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form id="pemudaForm" action="{{ route('pemuda.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="registration_type" value="{{ $currentType }}">

                <div class="modal-content border-0">
                    <div class="modal-header bg-primary text-white" id="modalHeader">
                        <h5 class="modal-title" id="modalTitle">Tambah Pendaftar</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body bg-light">

                        <h6 class="fw-bold mb-3">Data Diri</h6>
                        <div class="row g-3 bg-white p-3 rounded shadow-sm mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="full_name_reg" id="full_name_reg" class="form-control" required
                                    placeholder="Sesuai KTP">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required
                                    onchange="calculateAge()">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Agama</label>
                                <input type="text" name="religion" id="religion" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Umur (Otomatis)</label>
                                <input type="number" name="age" id="age" class="form-control bg-light" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Akun Media Sosial</label>
                                <input type="text" name="social_media" id="social_media" class="form-control"
                                    placeholder="@username">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3">Dokumen Persyaratan</h6>
                        <div class="row g-3 bg-white p-3 rounded shadow-sm">
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Pas Photo 3x4</label>
                                <input type="file" name="photo" id="photo" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Scan KTP</label>
                                <input type="file" name="document_ktp" id="document_ktp" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Ijazah Terakhir</label>
                                <input type="file" name="doc_ijazah" id="doc_ijazah" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Ket. Sehat</label>
                                <input type="file" name="doc_sehat" id="doc_sehat" class="dropify"
                                    data-max-file-size="2M" />
                            </div>

                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Bebas Narkoba</label>
                                <input type="file" name="doc_narkoba" id="doc_narkoba" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">SKCK Aktif</label>
                                <input type="file" name="doc_skck" id="doc_skck" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Kartu BPJS</label>
                                <input type="file" name="doc_bpjs" id="doc_bpjs" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">TOEFL</label>
                                <input type="file" name="doc_toefl" id="doc_toefl" class="dropify"
                                    data-max-file-size="2M" />
                            </div>

                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Surat Rekomendasi</label>
                                <input type="file" name="doc_rekomendasi" id="doc_rekomendasi" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Karya Nyata</label>
                                <input type="file" name="doc_karya_nyata" id="doc_karya_nyata" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Rekom. Kab/Kota</label>
                                <input type="file" name="doc_rekomendasi_kab" id="doc_rekomendasi_kab"
                                    class="dropify" data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Aktif Sekolah/Kuliah</label>
                                <input type="file" name="doc_aktif_pendidikan" id="doc_aktif_pendidikan"
                                    class="dropify" data-max-file-size="2M" />
                            </div>

                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Izin Orang Tua</label>
                                <input type="file" name="doc_izin_ortu" id="doc_izin_ortu" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">NIB / SKU</label>
                                <input type="file" name="doc_nib" id="doc_nib" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Bukti Omset</label>
                                <input type="file" name="doc_omset" id="doc_omset" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-bold text-xs">Bukti Tempat Usaha</label>
                                <input type="file" name="doc_tempat_usaha" id="doc_tempat_usaha" class="dropify"
                                    data-max-file-size="2M" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100" id="btnSubmit">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        // 1. Simpan konfigurasi ke dalam variabel agar seragam dipakai di mana-mana
        const dropifyConfig = {
            height: 120, // Tinggi kotak minimalis
            messages: {
                'default': 'Tarik file / Klik',
                'replace': 'Timpa file',
                'remove': 'Hapus',
                'error': 'Ops, terjadi kesalahan.'
            }
        };

        // 2. Inisialisasi awal saat halaman dimuat
        $('.dropify').dropify(dropifyConfig);

        // 3. Kalkulasi umur otomatis
        function calculateAge() {
            var birthDate = new Date(document.getElementById('date_of_birth').value);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        }

        // 4. Fungsi Reset Form (Bersihkan form input & Dropify)
        function resetForm() {
            $('#pemudaForm')[0].reset();
            $('#pemudaForm').attr('action', '{{ url('pemuda') }}');
            $('#formMethod').val('POST');
            $('#modalTitle').text('Tambah Pendaftar');
            $('#modalHeader').removeClass('bg-warning').addClass('bg-primary');
            $('#btnSubmit').removeClass('btn-warning').addClass('btn-primary').text('Simpan Data');

            // Looping semua Dropify untuk dikosongkan dengan benar
            $('.dropify').each(function() {
                var drEvent = $(this).data('dropify');
                if (drEvent) {
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    drEvent.settings.defaultFile = ''; // Hapus jejak defaultFile dari edit sebelumnya
                    drEvent.destroy();
                    drEvent.init();
                }
            });
        }

        // 5. Fungsi saat tombol Edit ditekan
        $('.edit-btn').on('click', function() {
            resetForm(); // Panggil reset dulu agar form bersih

            var data = $(this).data('data');

            // Ubah Action & Method form ke UPDATE
            $('#pemudaForm').attr('action', '{{ url('pemuda') }}/' + data.id);
            $('#formMethod').val('PUT');

            // Ubah tampilan Header & Tombol Modal
            $('#modalTitle').text('Edit Pendaftar');
            $('#modalHeader').removeClass('bg-primary').addClass('bg-warning');
            $('#btnSubmit').removeClass('btn-primary').addClass('btn-warning text-white').text('Update Data');

            // Isi Data Text (Data Diri)
            $('#full_name_reg').val(data.full_name_reg);
            $('#place_of_birth').val(data.place_of_birth);
            $('#date_of_birth').val(data.date_of_birth);
            $('#religion').val(data.religion);
            $('#age').val(data.age);
            $('#email').val(data.email);
            $('#social_media').val(data.social_media);
            $('#address').val(data.address);

            // Isi Data File/Gambar (Dropify)
            const fileFields = [
                'photo', 'document_ktp', 'doc_ijazah', 'doc_sehat', 'doc_narkoba',
                'doc_skck', 'doc_bpjs', 'doc_toefl', 'doc_rekomendasi', 'doc_karya_nyata',
                'doc_rekomendasi_kab', 'doc_aktif_pendidikan', 'doc_izin_ortu', 'doc_nib',
                'doc_omset', 'doc_tempat_usaha'
            ];

            fileFields.forEach(function(field) {
                if (data[field]) { // Jika field memiliki data path file dari database
                    var assetUrl = "{{ asset('') }}" + data[field];
                    var $el = $('#' + field);

                    // Ambil instance dropify dari elemen ini
                    var drEvent = $el.data('dropify');
                    if (drEvent) {
                        drEvent.settings.defaultFile = assetUrl; // Masukkan file lama
                        drEvent.destroy(); // Hancurkan inisiasi lama
                        drEvent.init(); // Bangun kembali dengan file baru
                    }
                }
            });
        });
    </script>
@endpush
