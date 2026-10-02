@extends('admin.categories.layout')

@section('content')
<div class="wrap">
    <div class="head">
        <div>
            <h1>📁 Kategori Produk</h1>
            <div class="sub">Kelola kategori agar produk toko lebih teratur.</div>
        </div>

        <a href="{{ route('admin.categories.create') }}" class="btn primary">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div style="background:#eaf8f0;color:#16834b;padding:12px 15px;border-radius:11px;margin-bottom:18px;font-size:13px;font-weight:700">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        @if($categories->count())
            <table>
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Slug</th>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <strong>{{ $category->nama }}</strong>
                            @if($category->deskripsi)
                                <div style="font-size:12px;color:#8791a1;margin-top:4px">
                                    {{ $category->deskripsi }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            <span class="badge {{ $category->aktif ? 'on' : 'off' }}">
                                {{ $category->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a class="btn edit" href="{{ route('admin.categories.edit', $category) }}">Edit</a>

                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                      onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="empty">
                <div style="font-size:38px;margin-bottom:10px">📁</div>
                Belum ada kategori.<br>
                Tambahkan kategori pertama untuk toko kamu.
            </div>
        @endif
    </div>
</div>
@endsection
