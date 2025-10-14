@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <div class="card border-secondary shadow-sm" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0 fw-bold">Ide</h3>
                    <a href="#" class="btn btn-primary fw-bold px-4 py-2" data-bs-toggle="modal"
                        data-bs-target="#newModal">
                        Tambah Ide Baru
                    </a>
                </div>

                <!-- Modal Tambah Ide Baru -->
                <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="newModalLabel">Tambah Ide Baru</h5>
                            </div>

                            <form action="{{ route('ideas.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <!-- Input Judul Ide -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                            placeholder="Masukkan judul ide" required>
                                    </div>

                                    <!-- Dropdown Kategori -->
                                    <div class="mb-3">
                                        <label for="categori_id" class="form-label">Kategori</label>
                                        <select class="js-example-basic-multiple" name="category[]" id="category"
                                            multiple="multiple" style="width: 100%" required>
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach ($kategori as $kat)
                                                <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <span>Showing {{ $ide->count() }} entries</span>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex" method="GET" action="{{ route('ideas.index') }}">
                            <input class="form-control me-2" type="search" name="search" placeholder="Cari kategori..."
                                aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>

                <!-- Tabel Ide -->
                <div class="table-responsive mt-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ide as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $item->title }}</td>
                                    <td class="text-center">
                                        @forelse($item->categories as $category)
                                            <span class="badge bg-success">{{ $category->name }}</span>
                                        @empty
                                            -
                                        @endforelse
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('ideas.edit', $item->id) }}"
                                            class="btn btn-outline-success btn-sm me-1" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('ideas.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada ide</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
