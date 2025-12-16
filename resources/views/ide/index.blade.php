@extends('layouts.user.app')

@section('hide.footer', true)

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    {{-- Ide Section --}}
    <div class="container mt-4">
        <div class="card border-0 shadow-lg" style="border-radius: 14px; background-color: #fafafa;">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0 fw-bold d-flex align-items-center text-secondary">
                        <i class="ti ti-bulb text-warning icon-spaced fs-3"></i>
                        <span class="fw-bold">Ide</span>
                    </h3>
                    <div class="d-flex gap-2">
                        <!-- Tombol Export -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exportIdeModal">
                            <i class="bi bi-download"></i> Export
                        </button>

                        <!-- Tombol Import -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#importIdeModal">
                            <i class="bi bi-upload"></i> Import
                        </button>

                        <!-- Tombol Tambah -->
                        <button type="button"
                            class="btn btn-primary fw-bold px-4 py-2 btn-animated shadow-sm d-flex align-items-center gap-2"
                            data-bs-toggle="modal" data-bs-target="#newModal">
                            <i class="bi bi-plus-circle"></i>
                            <span>Tambah Ide Baru</span>
                        </button>
                    </div>
                </div>

                <!-- Alert -->
                @if (session('successide'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm rounded-3" role="alert">
                        {{ session('successide') }}
                    </div>
                @endif

                <!-- Search -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <span class="text-muted">Menampilkan {{ $ide->count() }} entri</span>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex" method="GET" action="{{ route('ide.index') }}">
                            <input class="form-control me-2 rounded-3" type="search" name="searchide"
                                placeholder="Cari ide..." aria-label="Search" value="{{ request('searchide') }}">
                            <button class="btn btn-outline-success btn-animated d-flex align-items-center gap-2 rounded-3"
                                type="submit">
                                <i class="bi bi-search"></i>
                                <span>Cari</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="table-responsive rounded-4 shadow-sm">
                    <table class="table table-bordered mb-0 align-middle rounded-4 overflow-hidden custom-table">
                        <thead>
                            <tr>
                                <th class="text-center fw-bold bg-success-soft">
                                    <a href="{{ sortLink('name') }}"
                                        class="text-decoration-none text-dark d-inline-flex align-items-center gap-1">
                                        No
                                        <span class="d-flex flex-column lh-1 ms-1">
                                            <i
                                                class="bi bi-caret-up-fill
                {{ request('sortide') === 'name' && request('orderide') === 'asc' ? 'text-success fw-bold' : 'text-muted' }}">
                                            </i>
                                            <i
                                                class="bi bi-caret-down-fill
                {{ request('sortide') === 'name' && request('orderide') === 'desc' ? 'text-success fw-bold' : 'text-muted' }}">
                                            </i>
                                        </span>
                                    </a>
                                </th>
                                <th class="text-center fw-bold bg-warning-soft">Judul</th>
                                <th class="fw-bold text-center bg-info-soft">Kategori</th>
                                <th class="fw-bold text-center bg-info-soft">Favorit</th>
                                <th class="text-center fw-bold bg-primary-soft">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ide as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $item->title }}</td>
                                    <td class="text-center">
                                        @forelse($item->categories as $category)
                                            <span class="badge bg-success shadow-sm">{{ $category->name }}</span>
                                        @empty
                                            <span class="text-muted">-</span>
                                        @endforelse
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('ide.toggleFavorite', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-sm {{ $item->is_favorite ? 'btn-warning' : 'btn-outline-warning' }} btn-animated rounded-3 shadow-sm"
                                                title="{{ $item->is_favorite ? 'Hapus dari favorit' : 'Tambah ke favorit' }}">
                                                <i class="bi bi-star{{ $item->is_favorite ? '-fill' : '' }}"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-outline-success btn-sm me-1 btn-animated rounded-3 shadow-sm"
                                            data-bs-toggle="modal" data-bs-target="#editModal1{{ $item->id }}"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('ide.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm btn-animated rounded-3 shadow-sm d-inline-flex align-items-center justify-content-center"
                                                onclick="return confirm('Yakin ingin menghapus ide ini?')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Belum ada ide</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Ide -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $ide->appends(request()->except('ide_page'))->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Tambah Ide -->
    <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <form action="{{ route('ide.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 bg-light rounded-top-4">
                        <h5 class="modal-title d-flex align-items-center text-secondary" id="newModalLabel">
                            <i class="bi bi-lightbulb text-warning icon-spaced"></i>
                            <span>Tambah Ide Baru</span>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul</label>
                            <input type="text" class="form-control rounded-3 shadow-sm"
                                placeholder="Masukkan judul ide" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select class="js-example-basic-multiple" name="category[]" multiple="multiple"
                                style="width: 100%" required>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-secondary btn-animated d-flex align-items-center gap-2 px-3"
                            data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i>
                            <span>Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-animated d-flex align-items-center gap-2 px-3">
                            <i class="bi bi-save2"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Ide -->
    @foreach ($ide as $item)
        <div class="modal fade" id="editModal1{{ $item->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow-lg border-0">
                    <form action="{{ route('ide.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 bg-light rounded-top-4">
                            <h5 class="modal-title d-flex align-items-center text-secondary"
                                id="editModalLabel{{ $item->id }}">
                                <i class="bi bi-pencil-square text-success icon-spaced"></i>
                                <span>Edit Ide</span>
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul</label>
                                <input type="text" class="form-control rounded-3 shadow-sm" name="title"
                                    value="{{ $item->title }}" placeholder="Masukkan judul ide" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kategori</label>
                                <select class="js-example-basic-multiple-edit" name="category[]" multiple="multiple"
                                    style="width: 100%" required>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}"
                                            {{ in_array($kat->id, $item->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $kat->name }}</option>
                                    @endforeach
                                </select>
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

    {{-- Kategori Section --}}
    <div class="container mt-4">
        <div class="card border-0 shadow-lg" style="border-radius: 14px; background-color: #fafafa;">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0 fw-bold d-flex align-items-center text-secondary">
                        <i class="ti ti-tags text-success icon-spaced fs-3"></i>
                        <span class="fw-bold">Kategori</span>
                    </h3>
                    <div class="d-flex gap-2">
                        <!-- Tombol Export Kategori -->
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exportKategoriModal">
                            <i class="bi bi-download"></i> Export
                        </button>
                        <!-- Tombol Import Kategori -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#importKategoriModal">
                            <i class="bi bi-upload"></i> Import
                        </button>

                        <!-- Tombol Tambah -->
                        <button type="button"
                            class="btn btn-primary fw-bold px-4 py-2 btn-animated shadow-sm d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="bi bi-plus-circle icon-spaced"></i>
                            <span>Tambah Kategori</span>
                        </button>
                    </div>
                </div>

                <!-- Alert -->
                @if (session('successkategori'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm rounded-3" role="alert">
                        {{ session('successkategori') }}
                    </div>
                @endif

                <!-- Search -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <span class="text-muted">Menampilkan {{ $kategori->count() }} entri</span>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex" method="GET" action="{{ route('ide.index') }}">
                            <input class="form-control me-2 rounded-3" type="search" name="searchkategori"
                                placeholder="Cari kategori..." aria-label="Search"
                                value="{{ request('searchkategori') }}">
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
                                <th class="fw-bold text-center bg-success-soft">
                                    <a href="{{ sortLink('name') }}"
                                        class="text-decoration-none text-dark d-inline-flex align-items-center gap-1">
                                        Nama Kategori
                                        <span class="d-flex flex-column lh-1 ms-1">
                                            <i
                                                class="bi bi-caret-up-fill
                {{ request('sortkategori') === 'name' && request('orderkategori') === 'asc' ? 'text-success fw-bold' : 'text-muted' }}">
                                            </i>
                                            <i
                                                class="bi bi-caret-down-fill
                {{ request('sortkategori') === 'name' && request('orderkategori') === 'desc' ? 'text-success fw-bold' : 'text-muted' }}">
                                            </i>
                                        </span>
                                    </a>
                                </th>

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

                                        <form action="{{ route('kat.destroy', $item->id) }}" method="POST"
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

                <!-- Pagination Kategori -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $kategori->appends(request()->except('kategori_page'))->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <form action="{{ route('kat.store') }}" method="POST">
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

    <!-- Modal Edit Kategori -->
    @foreach ($kategori as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow-lg border-0">
                    <form action="{{ route('kat.update', $item->id) }}" method="POST">
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

    <!-- Modal Export Ide -->
    <div class="modal fade" id="exportIdeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-download"></i> Export Data Ide</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('ide.export.excel') }}" class="btn btn-outline-success btn-lg">
                            <i class="bi bi-file-earmark-excel fs-4"></i>
                            <div class="mt-2">
                                <strong>Export ke Excel</strong>
                                <small class="d-block text-muted">Download data dalam format .xlsx</small>
                            </div>
                        </a>
                        <a href="{{ route('ide.export.pdf') }}" class="btn btn-outline-danger btn-lg">
                            <i class="bi bi-file-earmark-pdf fs-4"></i>
                            <div class="mt-2">
                                <strong>Export ke PDF</strong>
                                <small class="d-block text-muted">Download data dalam format .pdf</small>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import Ide -->
    <div class="modal fade" id="importIdeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('ide.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-upload"></i> Import Data Ide</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">File Excel</label>
                            <input type="file" class="form-control" name="file" accept=".xlsx,.xls,.csv" required>
                            <small class="text-muted">Format: Excel (.xlsx, .xls, .csv)</small>
                        </div>
                        <div class="alert alert-info">
                            <strong>Format Excel:</strong><br>
                            Kolom: ID | Judul | Kategori (pisah dengan koma) | Favorit (Ya/Tidak) | Tanggal Dibuat
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Export Kategori -->
    <div class="modal fade" id="exportKategoriModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-download"></i> Export Data Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('kat.export.excel') }}" class="btn btn-outline-success btn-lg">
                            <i class="bi bi-file-earmark-excel fs-4"></i>
                            <div class="mt-2">
                                <strong>Export ke Excel</strong>
                                <small class="d-block text-muted">Download data dalam format .xlsx</small>
                            </div>
                        </a>
                        <a href="{{ route('kat.export.pdf') }}" class="btn btn-outline-danger btn-lg">
                            <i class="bi bi-file-earmark-pdf fs-4"></i>
                            <div class="mt-2">
                                <strong>Export ke PDF</strong>
                                <small class="d-block text-muted">Download data dalam format .pdf</small>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import Kategori -->
    <div class="modal fade" id="importKategoriModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('kat.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-upload"></i> Import Data Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">File Excel</label>
                            <input type="file" class="form-control" name="file" accept=".xlsx,.xls,.csv" required>
                            <small class="text-muted">Format: Excel (.xlsx, .xls, .csv)</small>
                        </div>
                        <div class="alert alert-info">
                            <strong>Format Excel:</strong><br>
                            Kolom: ID | Nama | Deskripsi | Tanggal Dibuat
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        .bg-primary-soft {
            background-color: #d2dcf8 !important;
            color: #0d3c6e !important;
        }

        .btn-animated {
            transition: all 0.25s ease-in-out;
        }

        .btn-animated:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12);
        }

        .custom-table {
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .icon-spaced {
            margin-right: 0.5rem;
            vertical-align: middle;
        }

        .btn .bi {
            vertical-align: middle;
        }

        .d-flex.gap-2>* {
            margin-right: 0.4rem;
        }
    </style>
@endsection

@php
    function sortLink($column)
    {
        $isActive = request('sortkategori') === $column;
        $nextOrder = $isActive && request('orderkategori') === 'asc' ? 'desc' : 'asc';

        return route(
            'ide.index',
            array_merge(request()->query(), [
                'sortkategori' => $column,
                'orderkategori' => $nextOrder,
            ]),
        );
    }

    function sortIcon($column)
    {
        if (request('sortkategori') !== $column) {
            return '';
        }
        return request('orderkategori') === 'asc'
            ? '<i class="bi bi-caret-up-fill ms-1"></i>'
            : '<i class="bi bi-caret-down-fill ms-1"></i>';
    }
@endphp

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // init select2 for NEW modal
            $('#newModal').on('shown.bs.modal', function() {
                $(this).find('.js-example-basic-multiple').select2({
                    dropdownParent: $('#newModal'),
                    placeholder: "Pilih kategori",
                    allowClear: true
                });
            });

            // init select2 for EDIT modals when shown, destroy on hidden
            $('[id^=editModal1]').on('shown.bs.modal', function() {
                var $modal = $(this);
                $modal.find('.js-example-basic-multiple-edit').each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2({
                            dropdownParent: $modal,
                            placeholder: "Pilih kategori",
                            allowClear: true
                        });
                    }
                });
            }).on('hidden.bs.modal', function() {
                var $modal = $(this);
                $modal.find('.js-example-basic-multiple-edit').each(function() {
                    if ($(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2('destroy');
                    }
                });
            });
        });
    </script>
@endsection
