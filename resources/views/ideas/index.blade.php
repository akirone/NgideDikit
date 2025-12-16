@extends('layouts.admin.app')

@section('hide.footer', true)

@section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-lg" style="border-radius: 14px; background-color: #fafafa;">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0 fw-bold d-flex align-items-center text-secondary">
                        <i class="ti ti-bulb text-warning icon-spaced fs-3"></i>
                        <span class="fw-semibold">Ide</span>
                    </h3>
                    <button type="button"
                        class="btn btn-primary fw-bold px-4 py-2 btn-animated shadow-sm d-flex align-items-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#newModal">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Ide Baru</span>
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
                        <span class="text-muted">Menampilkan {{ $ide->count() }} entri</span>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex" method="GET" action="{{ route('ideas.index') }}">
                            <input class="form-control me-2 rounded-3" type="search" name="search"
                                placeholder="Cari ide..." aria-label="Search" value="{{ request('search') }}">
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
                                <th class="text-center fw-bold bg-success-soft">No</th>
                                <th class="text-center fw-bold bg-warning-soft">Judul</th>
                                <th class="text-center fw-bold bg-info-soft">Kategori</th>
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
                                        <button type="button"
                                            class="btn btn-outline-success btn-sm me-1 btn-animated rounded-3 shadow-sm"
                                            data-bs-toggle="modal" data-bs-target="#editModal1{{ $item->id }}"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Button Hapus -->
                                        <form action="{{ route('ideas.destroy', $item->id) }}" method="POST"
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
                                    <td colspan="4" class="text-center text-muted py-3">Belum ada ide</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $ide->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <form action="{{ route('ideas.store') }}" method="POST">
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
                            <input type="text" class="form-control rounded-3 shadow-sm" placeholder="Masukkan judul ide"
                                name="title" required>
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

    <!-- JS: Bootstrap & Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#newModal').on('shown.bs.modal', function() {
                $(this).find('.js-example-basic-multiple').select2({
                    dropdownParent: $('#newModal'),
                    placeholder: "Pilih kategori",
                    allowClear: true
                });
            });
        });
    </script>

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
