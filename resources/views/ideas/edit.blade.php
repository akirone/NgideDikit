@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <div class="card border-secondary shadow-sm" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0 fw-bold">Edit Ide</h3>
                    <a href="{{ route('ideas.index') }}" class="btn btn-secondary fw-bold px-4 py-2">
                        Kembali
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('ideas.update', $idea->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" id="title"
                            value="{{ old('title', $idea->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="js-example-basic-multiple" name="category[]" id="category" multiple="multiple"
                            style="width: 100%" required>
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ in_array($kat->id, $idea->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $kat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary fw-bold px-4 py-2">Simpan Perubahan</button>
                </form>
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
