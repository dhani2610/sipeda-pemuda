<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Data - {{ $subKategori->nama_sub_kategori }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .top-header {
            background: #fff;
            padding: 10px 0;
            border-bottom: 2px solid #e9ecef;
        }

        .main-navbar {
            background-color: #1e293b;
            padding: 10px 0;
        }

        .main-navbar .nav-link {
            color: #fff !important;
            font-weight: 500;
        }

        .main-navbar .nav-link:hover {
            color: #94a3b8 !important;
        }

        .card-custom {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .alert-info-custom {
            background-color: #f8f9fa;
            border-left: 4px solid #17a2b8;
            color: #495057;
            font-size: 0.9rem;
        }

        /* Dropdown Hover (Multi-level) */
        .dropdown-menu li {
            position: relative;
        }

        .dropdown-menu .dropdown-submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .dropdown-menu .dropdown-submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu>li:hover>.dropdown-submenu {
            display: block;
        }
    </style>
</head>

<body>

    <div class="top-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/sipeda.png') }}" alt="Logo SIPEDA" style="max-height: 60px;">
                </a>
            </div>
            <div class="d-none d-md-flex flex-column align-items-end">
                <div class="text-primary fw-bold mb-1">
                    <i class="far fa-calendar-alt"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y, H:i') }}
                </div>
            </div>
        </div>
    </div>

    <nav class="main-navbar">
        <div class="container">
            <ul class="nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-database me-1"></i> SIPEDA
                    </a>
                    <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                        @foreach ($kategoris as $kategori)
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="#">
                                    {{ $kategori->nama_kategori }} <i class="fas fa-caret-right text-muted"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    @foreach ($kategori->subKategoris as $sub)
                                        <li><a class="dropdown-item"
                                                href="{{ route('bankdata.show', $sub->id) }}">{{ $sub->nama_sub_kategori }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="row g-4">

            <div class="col-lg-12">
                <div class="card card-custom h-100">
                    <div class="card-header bg-white pt-3 pb-2 border-0">
                        <h5 class="fw-bold text-dark m-0">SIPEDA - {{ strtoupper($subKategori->nama_sub_kategori) }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info-custom p-3 mb-4 rounded">
                            Informasi mengenai peraturan, keputusan, dan/atau kebijakan yang mengikat dan/atau berdampak
                            bagi publik dapat diunduh pada list dibawah. Jika data yang dicari tidak ditemukan, Silahkan
                            klik <strong>disini</strong>, untuk melakukan permintaan informasi.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Nama File</th>
                                        <th width="25%">Tgl Posting</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataSipeda as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="fw-medium">{{ $item->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm text-white"
                                                    onclick="viewFile('{{ asset('storage/' . $item->file) }}', '{{ $item->title }}')">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="fileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalFileTitle">View File</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0" style="height: 75vh;">
                    <iframe id="fileViewer" src="" style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="#" id="downloadBtn" class="btn btn-success" download><i class="fas fa-download"></i>
                        Download</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#dataTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                }
            });
        });

        // Fungsi membuka Modal dan me-load File
        function viewFile(fileUrl, fileTitle) {
            // Ubah judul modal
            $('#modalFileTitle').text(fileTitle);

            // Masukkan URL file ke dalam iframe
            $('#fileViewer').attr('src', fileUrl);

            // Update link download
            $('#downloadBtn').attr('href', fileUrl);

            // Tampilkan Modal
            $('#fileModal').modal('show');
        }

        // Kosongkan iframe saat modal ditutup agar tidak berat/lag
        $('#fileModal').on('hidden.bs.modal', function() {
            $('#fileViewer').attr('src', '');
        });
    </script>
</body>

</html>