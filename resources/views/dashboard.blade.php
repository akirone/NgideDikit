@extends('layouts.admin.app')

@section('content')
    <h4 class="page-title">DashBoard</h4>

    <div class="row pb-3 mb-3">
        <div class="col-md-4">
            <div class="card card-stats card-info h-100 border-bottom" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Jumlah Pengguna</p>
                                <h4 class="card-title">{{ \App\Models\User::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-success h-100 border-bottom" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="bi bi-lightbulb-fill"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Total Kategori</p>
                                <h4 class="card-title">{{ \App\Models\Kategori::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-warning h-100 border-bottom" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="bi bi-newspaper"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Total Ide</p>
                                <h4 class="card-title">{{ \App\Models\Ide::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-card-no-pd" style="border-radius: 12px;">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="fw-bold mt-1">Progress User</p>
                    @if ($selectedUser)
                        <h4><b>{{ $selectedUser->name }}</b></h4>
                        <p class="text-muted">{{ $userIdeCount }} Ide dibuat</p>
                    @else
                        <h4><b>Pilih User</b></h4>
                        <p class="text-muted">Belum ada user</p>
                    @endif
                </div>
                <div class="card-footer">
                    <form method="GET" action="{{ route('dashboard') }}" id="userSwitchForm">
                        <div class="form-group mb-2">
                            <label class="text-muted small mb-1">Pilih User:</label>
                            <select name="user_id" class="form-control form-control-sm" onchange="this.form.submit()">
                                <option value="">-- Pilih User --</option>
                                @foreach ($allUsers as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $selectedUser && $selectedUser->id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ ucfirst($user->role) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if ($selectedUser)
                        <div class="progress-card">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Ide Dibuat</span>
                                <span class="text-muted fw-bold">{{ $userIdeCount }}/20</span>
                            </div>
                            <div class="progress mb-2" style="height: 7px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $userIdePercent }}%" aria-valuenow="{{ $userIdePercent }}"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top"
                                    title="{{ $userIdePercent }}%"></div>
                            </div>
                        </div>
                        <div class="progress-card">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Ide Favorit User</span>
                                <span class="text-muted fw-bold">{{ $userFavoriteCount }}/{{ $userIdeCount }}</span>
                            </div>
                            <div class="progress mb-2" style="height: 7px;">
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: {{ $userFavoritePercent }}%" aria-valuenow="{{ $userFavoritePercent }}"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top"
                                    title="{{ $userFavoritePercent }}%"></div>
                            </div>
                        </div>
                        <div class="progress-card">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Kategori Digunakan</span>
                                <span class="text-muted fw-bold">{{ $userKategoriCount }}/{{ $totalKategori }}</span>
                            </div>
                            <div class="progress mb-2" style="height: 7px;">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ $userKategoriPercent }}%" aria-valuenow="{{ $userKategoriPercent }}"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top"
                                    title="{{ $userKategoriPercent }}%"></div>
                            </div>
                        </div>
                        <div class="progress-card">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Activity Rate</span>
                                <span class="text-muted fw-bold">{{ $activityRate }} ide/hari</span>
                            </div>
                            <div class="progress mb-2" style="height: 7px;">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ $activityPercent }}%" aria-valuenow="{{ $activityPercent }}"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top"
                                    title="{{ $activityPercent }}%"></div>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-person-x" style="font-size: 3rem;"></i>
                            <p class="mt-2">Pilih user untuk melihat progress</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card h-100" style="border-radius: 12px;">
                <div class="card-header">
                    <h4 class="card-title">Ide Favorit</h4>
                    <p class="card-category">Persentase</p>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                        <div class="text-center">
                            <h1 class="display-3 fw-bold text-primary">{{ $taskComplete }}%</h1>
                            <p class="text-muted">{{ $totalFavorites }} dari {{ $totalIde }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="legend"><i class="la la-circle text-primary"></i>Ide Favorit</div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card h-100" style="border-radius: 12px;">
                <div class="card-header">
                    <h4 class="card-title mb-0">Pengguna Terbaru</h4>
                    <p class="card-category mb-0">5 Pengguna Terakhir Terdaftar</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border-radius: 8px;">
                        <table class="table table-head-bg-success table-striped table-hover mb-0">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Terdaftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentUsers as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at ? $user->created_at->diffForHumans() : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada pengguna</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
