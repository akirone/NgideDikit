@extends('layouts.admin.app')

@section('hide.footer', true)

@section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-lg" style="border-radius: 12px;">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0 fw-bold">
                        <i class="ti ti-users me-2 text-primary"></i>Pengguna
                    </h3>
                    <button type="button" class="btn btn-primary fw-bold px-4 py-2 shadow animate-btn" data-bs-toggle="modal"
                        data-bs-target="#newModal">
                        <i class="bi bi-person-plus"></i>
                        <span>Tambah Pengguna</span>
                    </button>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content shadow-lg" style="border-radius: 10px;">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold text-secondary" id="newModalLabel">
                                    <i class="bi bi-person-plus-fill me-2 text-primary"></i>Tambah Pengguna
                                </h5>
                            </div>

                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-semibold">Nama:</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control shadow-sm rounded-3" placeholder="Masukkan nama pengguna"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold">Email:</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control shadow-sm rounded-3" placeholder="Masukkan email pengguna"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-semibold">Password:</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control shadow-sm rounded-3" placeholder="Masukkan password"
                                            required>
                                    </div>
                                </div>

                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary shadow animate-btn"
                                        data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle"></i>
                                        <span>Batal</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary shadow animate-btn">
                                        <i class="bi bi-save2"></i>
                                        <span>Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Alert -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm rounded-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Search -->
                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <span>Menampilkan {{ $users->count() }} pengguna</span>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex" method="GET" action="{{ route('users.index') }}">
                            <input class="form-control me-2 shadow-sm" type="search" name="search"
                                placeholder="Cari nama atau email..." aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success shadow animate-btn" type="submit">
                                <i class="bi bi-search"></i>
                                <span>Cari</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Tabel Pengguna -->
                <div class="table-responsive mt-3 shadow-lg rounded">
                    <table class="table table-bordered align-middle mb-0" style="border-radius: 10px; overflow: hidden;">
                        <thead>
                            <tr>
                                <th class="text-center fw-bold" style="background-color: #d4edda;">No</th>
                                <th class="text-center fw-bold" style="background-color: #fff3cd;">Nama Pengguna</th>
                                <th class="text-center fw-bold" style="background-color: #d1ecf1;">Email</th>
                                <th class="text-center fw-bold" style="background-color: #ded1f1;">Peran</th>
                                <th class="text-center fw-bold" style="background-color: #f8d7da;">Password</th>
                                <th class="text-center fw-bold" style="background-color: #cfe2ff;">Tanggal Bergabung</th>
                                <th class="text-center fw-bold" style="background-color: #e2e3e5;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ ucfirst($user->role) }}</td>
                                    <td class="text-center text-muted">{{ Str::limit($user->password, 10, '...') }}</td>
                                    <td class="text-center">
                                        {{ $user->created_at ? $user->created_at->format('d-m-Y H:i') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        <!-- Tombol Edit -->
                                        <button type="button"
                                            class="btn btn-outline-success btn-sm shadow animate-btn me-1"
                                            data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm shadow animate-btn"
                                                onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                                                title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada pengguna</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- EDIT MODALS -->
    @foreach ($users as $user)
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
            aria-labelledby="editUserLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content shadow-lg" style="border-radius: 10px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold text-success" id="editUserLabel{{ $user->id }}">
                            <i class="bi bi-pencil-square me-2"></i>Edit Pengguna
                        </h5>
                    </div>

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama</label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="form-control shadow-sm rounded-3" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}"
                                    class="form-control shadow-sm rounded-3" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control shadow-sm rounded-3"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary shadow animate-btn" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i>
                                <span>Batal</span>
                            </button>
                            <button type="submit" class="btn btn-success shadow animate-btn">
                                <i class="bi bi-save2"></i>
                                <span>Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        /* --- Perbaikan Hover Tombol & Jarak Icon --- */
        .animate-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            will-change: transform;
            position: relative;
            z-index: 1;
        }

        .animate-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2) !important;
        }

        .animate-btn:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15) !important;
        }

        /* Hover Tabel Tetap */
        .table-responsive {
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease-in-out;
            overflow: hidden;
        }

        .table-responsive:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card {
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
        }

        .modal {
            z-index: 1055;
        }

        .modal-backdrop {
            z-index: 1050;
            background-color: rgba(0, 0, 0, .55);
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof bootstrap === 'undefined') {
                console.error(
                    'Bootstrap JS belum dimuat. Tambahkan bootstrap.bundle.min.js di layouts.admin.app (head atau before closing body).'
                );
                return;
            }

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const target = btn.getAttribute('data-bs-target') || btn.getAttribute('data-target');
                    if (!target) return;
                    const modalEl = document.querySelector(target);
                    if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).show();
                });
            });
        });
    </script>
@endsection
