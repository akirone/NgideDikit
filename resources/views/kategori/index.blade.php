@extends('layouts.admin.app')

@section('hide.footer', true)

@section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-lg" style="border-radius: 14px; background-color: #fafafa;">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0 fw-bold d-flex align-items-center text-secondary">
                        <i class="ti ti-tags text-success icon-spaced fs-3"></i>
                        <span class="fw-semibold">Kategori</span>
                    </h3>
                    <button type="button"
                        class="btn btn-primary fw-bold px-4 py-2 btn-animated shadow-sm d-flex align-items-center"
                        data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-circle icon-spaced"></i>
                        <span>Tambah Kategori</span>
                    </button>
                </div>

                <!-- Alert -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm rounded-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Search -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <span class="text-muted">Menampilkan {{ $kategori->count() }} entri</span>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex" method="GET" action="{{ route('kategori.index') }}">
                            <input class="form-control me-2 rounded-3" type="search" name="search"
                                placeholder="Cari kategori..." aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success btn-animated d-flex align-items-center rounded-3"
                                type="submit">
                                <i class="bi bi-search icon-spaced"></i>
                                <span>Cari</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive rounded-4 shadow-sm">
                    <table class="table table-bordered mb-0 align-middle custom-table rounded-4 overflow-hidden">
                        <thead>
                            <tr>
                                <th class="fw-bold text-center bg-success-soft">Nama Kategori</th>
                                <th class="fw-bold text-center bg-warning-soft">Deskripsi</th>
                                <th class="fw-bold text-center bg-info-soft">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategori as $item)
                                <tr>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->description }}</td>
                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-outline-success btn-sm me-1 btn-animated rounded-3 shadow-sm"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm btn-animated rounded-3 shadow-sm"
                                                onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                                title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Tidak ada data kategori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 bg-light rounded-top-4">
                        <h5 class="modal-title d-flex align-items-center text-secondary" id="createModalLabel">
                            <i class="bi bi-folder-plus text-success icon-spaced"></i>
                            <span>Tambah Kategori</span>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" class="form-control rounded-3" placeholder="Masukkan nama kategori"
                                name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="description" class="form-control rounded-3" placeholder="(opsional) deskripsi kategori"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-secondary btn-animated d-flex align-items-center px-3"
                            data-bs-dismiss="modal">
                            <i class="bi bi-x-circle icon-spaced"></i>
                            <span>Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-animated d-flex align-items-center px-3">
                            <i class="bi bi-save2 icon-spaced"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Render edit modals AFTER the table (ke valid HTML) -->
    @foreach ($kategori as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow-lg border-0">
                    <form action="{{ route('kategori.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 bg-light rounded-top-4">
                            <h5 class="modal-title d-flex align-items-center text-secondary"
                                id="editModalLabel{{ $item->id }}">
                                <i class="bi bi-pencil-square text-success icon-spaced"></i>
                                <span>Edit Kategori</span>
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Kategori</label>
                                <input type="text" class="form-control rounded-3" name="name"
                                    value="{{ $item->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="description" class="form-control rounded-3">{{ $item->description ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-light rounded-bottom-4">
                            <button type="button" class="btn btn-secondary btn-animated d-flex align-items-center px-3"
                                data-bs-dismiss="modal">
                                <i class="bi bi-x-circle icon-spaced"></i>
                                <span>Batal</span>
                            </button>
                            <button type="submit" class="btn btn-primary btn-animated d-flex align-items-center px-3">
                                <i class="bi bi-save2 icon-spaced"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Script Bootstrap Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS -->
    <style>
        .bg-success-soft {
            background-color: #cbe8d8 !important;
            color: #155724 !important;
        }

        .bg-warning-soft {
            background-color: #f8e7b0 !important;
            color: #7c5e00 !important;
        }

        .bg-info-soft {
            background-color: #cfe5f5 !important;
            color: #0c5460 !important;
        }

        .btn-animated {
            display: inline-block;
            will-change: transform;
            transition: transform .18s ease-in-out, box-shadow .18s ease-in-out;
        }

        .btn-animated:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, .15);
        }

        .btn-animated:active,
        .btn-animated:focus {
            transform: translateY(0);
            outline: none;
        }

        .modal {
            z-index: 1055;
        }

        .modal-backdrop {
            z-index: 1050;
            background-color: rgba(0, 0, 0, .55);
        }

        .icon-spaced {
            margin-right: .5rem;
            vertical-align: middle;
        }

        .btn .bi {
            vertical-align: middle;
        }

        /* ADDED: border-radius for table and cells */
        .table-responsive.rounded-4 {
            border-radius: 12px;
            overflow: hidden;
            /* ensures rounded corners clip table */
        }

        .custom-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            background: #fff;
        }

        /* round top corners on header */
        .custom-table thead th:first-child {
            border-top-left-radius: 12px;
        }

        .custom-table thead th:last-child {
            border-top-right-radius: 12px;
        }

        /* round bottom corners on last row cells */
        .custom-table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        .custom-table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        /* prevent content overflow inside rounded cells */
        .custom-table th,
        .custom-table td {
            overflow: hidden;
        }

                .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12);
        }

    </style>
@endsection
