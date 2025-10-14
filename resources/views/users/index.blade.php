@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <div class="card border-secondary shadow-sm" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0 fw-bold">Pengguna</h3>
                    <a href="#" class="btn btn-primary fw-bold px-4 py-2" data-bs-toggle="modal"
                        data-bs-target="#newModal">
                        Tambah Pengguna
                    </a>
                </div>

                <!-- Modal Tambah (newModal) -->
                <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newModalLabel">Tambah Pengguna</h5>
                            </div>

                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama:</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password:</label>
                                        <input name="password" id="password" type="password" class="form-control">
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

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <span>Showing {{ $users->count() }} entries</span>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex" method="GET" action="{{ route('users.index') }}">
                            <input class="form-control me-2" type="search" name="search"
                                placeholder="Cari nama atau email..." aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center fw-bold text-primary">No</th>
                                <th class="text-center fw-bold text-primary">Nama Pengguna</th>
                                <th class="text-center fw-bold text-primary">Email</th>
                                <th class="text-center fw-bold text-primary">Password</th>
                                <th class="text-center fw-bold text-primary">Tanggal Bergabung</th>
                                <th class="fw-bold text-primary text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->password }}</td>
                                    <td class="text-center">{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td class="text-center">

                                        <button type="button" class="btn btn-outline-success btn-sm me-1"
                                            data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Generate modal edit untuk setiap user -->
                @foreach ($users as $user)
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="editUserLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserLabel{{ $user->id }}">Edit Isi Pengguna</h5>
                                </div>

                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name-{{ $user->id }}" class="form-label">Nama:</label>
                                            <input type="text" name="name" id="name-{{ $user->id }}"
                                                value="{{ $user->name }}" class="form-control">
                                            @error('name')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email-{{ $user->id }}" class="form-label">Email:</label>
                                            <input type="email" name="email" id="email-{{ $user->id }}"
                                                value="{{ $user->email }}" class="form-control">
                                            @error('email')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password-{{ $user->id }}"
                                                class="form-label">Password:</label>
                                            <input type="password" name="password" id="password-{{ $user->id }}"
                                                class="form-control"
                                                placeholder="Kosongkan jika tidak ingin mengubah password">
                                            @error('password')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Letakkan bootstrap bundle di layout (atau di bawah) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
