@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <div class="card border-info shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0 fw-bold text-primary">Monitoring Pengguna</h3>
                </div>

                {{-- Rata-rata progres seluruh pengguna --}}
                @php
                    $average = $users->count()
                        ? round(
                            $users
                                ->map(function ($u) {
                                    $ideas = $u->ideas;
                                    $total = $ideas->count();
                                    $done = $ideas->where('status', 'selesai')->count();
                                    return $total ? ($done / $total) * 100 : 0;
                                })
                                ->avg(),
                        )
                        : 0;
                @endphp

                <div class="alert alert-info shadow-sm mb-4">
                    <strong>{{ $users->count() }}</strong> pengguna terdaftar |
                    Rata-rata progres: <strong>{{ $average }}%</strong>
                </div>

                <div class="mb-3 p-3 bg-white rounded shadow-sm">
                    <p class="mb-1 fw-semibold text-secondary">Rata-rata seluruh pengguna:</p>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ $average }}%; transition: width 0.8s;">
                        </div>
                    </div>
                    <small class="text-muted">{{ $average }}% rata-rata progres semua pengguna</small>
                </div>

                {{-- Daftar progres tiap user --}}
                @foreach ($users as $user)
                    @php
                        $ideas = $user->ideas;
                        $total = $ideas->count();
                        $done = $ideas->where('status', 'selesai')->count();
                        $progress = $total ? round(($done / $total) * 100) : 0;
                        $badge =
                            $progress >= 75
                                ? '<span class="badge bg-success">Aktif</span>'
                                : ($progress >= 40
                                    ? '<span class="badge bg-warning text-dark">Perlu Dorongan</span>'
                                    : '<span class="badge bg-danger">Kurang Aktif</span>');
                    @endphp

                    <div class="p-3 mb-3 bg-white rounded shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-semibold text-dark">{{ $user->name }}</h6>
                            <div>
                                <small class="text-muted me-2">{{ $user->email }}</small>
                                {!! $badge !!}
                            </div>
                        </div>

                        <div class="mt-2">
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar
                                {{ $progress >= 75 ? 'bg-success' : ($progress >= 40 ? 'bg-warning' : 'bg-danger') }}"
                                    style="width: {{ $progress }}%; transition: width 0.8s;">
                                </div>
                            </div>
                            <small class="text-muted">{{ $progress }}% selesai</small>
                        </div>

                        <div class="mt-2 d-flex justify-content-between text-secondary">
                            <small>Total Ide: {{ $total }}</small>
                            <small>Selesai: {{ $done }}</small>
                        </div>

                        <div class="mt-2">
                            <small class="text-muted">
                                Bergabung: {{ $user->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
