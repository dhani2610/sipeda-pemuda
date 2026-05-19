@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Manajemen Sipeda</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="fas fa-plus"></i> Tambah Data
    </button>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->subKategori->nama_sub_kategori ?? '-' }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                            {{ $item->is_active ? 'Active' : 'Non Active' }}
                        </span>
                    </td>
                    <td>
                        <!-- Edit Button (Pass Data via Data Attributes) -->
                        <button class="btn btn-sm btn-warning edit-btn" 
                            data-id="{{ $item->id }}" data-kategori="{{ $item->kategori_id }}" data-sub="{{ $item->sub_kategori_id }}" data-title="{{ $item->title }}" data-desk="{{ $item->deskripsi }}" data-active="{{ $item->is_active }}" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fas fa-edit text-white"></i>
                        </button>

                        <!-- Delete Form -->
                        <form action="{{ route('sipeda.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('sipeda.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Sipeda</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sub Kategori</label>
                            <!-- Otomatis dari AJAX -->
                            <select name="sub_kategori_id" id="sub_kategori_id" class="form-select" required>
                                <option value="">-- Pilih Sub Kategori --</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Upload File / Foto</label>
                        <input type="file" name="file" class="dropify" data-height="150" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Sipeda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="is_active" id="edit_is_active" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Upload File Baru (Opsional)</label>
                        <input type="file" name="file" class="dropify" data-height="150" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update Data</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // AJAX Fetch Sub Kategori
    $('#kategori_id').change(function() {
        let kategoriID = $(this).val();
        if(kategoriID) {
            $.ajax({
                url: '/get-subkategori/' + kategoriID,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#sub_kategori_id').empty();
                    $('#sub_kategori_id').append('<option value="">-- Pilih Sub Kategori --</option>');
                    $.each(data, function(key, value) {
                        $('#sub_kategori_id').append('<option value="'+ value.id +'">'+ value.nama_sub_kategori +'</option>');
                    });
                }
            });
        } else {
            $('#sub_kategori_id').empty();
        }
    });

    // Handle Edit Modal Data Population
    $('.edit-btn').on('click', function() {
        let id = $(this).data('id');
        $('#editForm').attr('action', '/sipeda/' + id);
        $('#edit_title').val($(this).data('title'));
        $('#edit_deskripsi').val($(this).data('desk'));
        $('#edit_is_active').val($(this).data('active'));
        // Kategori dan Sub Kategori disesuaikan jika ingin diubah via edit
    });
</script>
@endpush