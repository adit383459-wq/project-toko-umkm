@extends('admin.categories.layout')

@section('content')
<div class="wrap">
    <div class="head">
        <div>
            <h1>Tambah Kategori</h1>
            <div class="sub">Buat kategori baru untuk produk toko.</div>
        </div>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <label>Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Makanan Ringan" required>
            @error('nama') <div class="error">{{ $message }}</div> @enderror

            <label>Deskripsi</label>
            <textarea name="deskripsi" placeholder="Deskripsi singkat kategori...">{{ old('deskripsi') }}</textarea>

            <label class="check">
                <input type="checkbox" name="aktif" value="1" checked>
                Kategori aktif
            </label>

            <button class="btn primary" type="submit">Simpan Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn" style="background:#eef1f5;color:#536071">Batal</a>
        </form>
    </div>
</div>
@endsection
