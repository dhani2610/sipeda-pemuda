@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-dark">Manajemen Sub Kategori</h4>
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="fas fa-plus"></i> Tambah Sub Kategori
    </button>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Induk Kategori</th>
                    <th>Ordering</th>
                    <th>Nama Sub Kategori</th>
                    <th>Deskripsi</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td><span class="badge bg-secondary">{{ $item->kategori->nama_kategori ?? 'N/A' }}</span></td>
                    <td>{{ $item->ordering }}</td>
                    <td>{{ $item->nama_sub_kategori }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn text-white" 
                            data-id="{{ $item->id }}" 
                            data-kat="{{ $item->kategori_id }}"
                            data-nama="{{ $item->nama_sub_kategori }}" 
                            data-ord="{{ $item->ordering }}" 
                            data-desk="{{ $item->deskripsi }}" 
                            data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('subkategori.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus sub kategori ini?')"><i class="fas fa-trash"></i></button>
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
        <form action="{{ route('subkategori.store') }}" method="POST">
            @csrf
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Sub Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori Induk --</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Sub Kategori</label>
                        <input type="text" name="nama_sub_kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordering</label>
                        <input type="number" name="ordering" class="form-control" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
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
                    <h5 class="modal-title text-white">Edit Sub Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Kategori</label>
                        <select name="kategori_id" id="edit_kat" class="form-select" required>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Sub Kategori</label>
                        <input type="text" name="nama_sub_kategori" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordering</label>
                        <input type="number" name="ordering" id="edit_ord" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="edit_desk" class="form-control" rows="3"></textarea>
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
        $('#editForm').attr('action', '/subkategori/' + $(this).data('id'));
        $('#edit_kat').val($(this).data('kat'));
        $('#edit_nama').val($(this).data('nama'));
        $('#edit_ord').val($(this).data('ord'));
        $('#edit_desk').val($(this).data('desk'));
    });
</script>
@endpush