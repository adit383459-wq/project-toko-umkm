@extends('admin.categories.layout')

@section('content')
<div class="wrap">
    <div class="head">
        <div>
            <h1>Edit Kategori</h1>
            <div class="sub">Perbarui informasi kategori.</div>
        </div>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')

            <label>Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama', $category->nama) }}" required>
            @error('nama') <div class="error">{{ $message }}</div> @enderror

            <label>Deskripsi</label>
            <textarea name="deskripsi">{{ old('deskripsi', $category->deskripsi) }}</textarea>

            <label class="check">
                <input type="checkbox" name="aktif" value="1" {{ old('aktif', $category->aktif) ? 'checked' : '' }}>
                Kategori aktif
            </label>

            <button class="btn primary" type="submit">Simpan Perubahan</button>
            <a href="{{ route('admin.categories.index') }}" class="btn" style="background:#eef1f5;color:#536071">Batal</a>
        </form>
    </div>
</div>
@endsection
