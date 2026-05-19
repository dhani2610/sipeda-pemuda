@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-dark">Manajemen Kategori</h4>
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="fas fa-plus"></i> Tambah Kategori
    </button>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ordering</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->ordering }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                            {{ $item->is_active ? 'Active' : 'Non Active' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn text-white" 
                            data-id="{{ $item->id }}" 
                            data-nama="{{ $item->nama_kategori }}" 
                            data-ord="{{ $item->ordering }}" 
                            data-desk="{{ $item->deskripsi }}" 
                            data-active="{{ $item->is_active }}" 
                            data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')"><i class="fas fa-trash"></i></button>
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
    <div class="modal-dialog">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordering</label>
                        <input type="number" name="ordering" class="form-control" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
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
    <div class="modal-dialog">
        <form id="editForm" method="POST">
            @csrf @method('PUT')
            <div class="modal-content border-0">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordering</label>
                        <input type="number" name="ordering" id="edit_ord" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="edit_desk" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="is_active" id="edit_active" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning text-white">Update Data</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('.edit-btn').on('click', function() {
        $('#editForm').attr('action', '/kategori/' + $(this).data('id'));
        $('#edit_nama').val($(this).data('nama'));
        $('#edit_ord').val($(this).data('ord'));
        $('#edit_desk').val($(this).data('desk'));
        $('#edit_active').val($(this).data('active'));
    });
</script>
@endpush