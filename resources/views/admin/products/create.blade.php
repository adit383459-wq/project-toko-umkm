<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Produk - Admin</title>

<style>
*{box-sizing:border-box}
body{
    margin:0;
    background:#f5f7fb;
    color:#172033;
    font-family:Arial,sans-serif;
}
.top{
    background:#fff;
    border-bottom:1px solid #e8edf4;
    padding:15px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.brand{
    color:#1769ff;
    font-size:19px;
    font-weight:800;
}
.back{
    color:#667085;
    text-decoration:none;
    font-size:13px;
    font-weight:700;
}
.wrap{
    max-width:850px;
    margin:30px auto;
    padding:0 18px;
}
.title{
    margin-bottom:20px;
}
.title h1{
    margin:0;
    font-size:27px;
}
.title p{
    color:#7b8494;
    font-size:14px;
}
.card{
    background:#fff;
    border:1px solid #e7ebf2;
    border-radius:18px;
    padding:25px;
    box-shadow:0 8px 30px rgba(20,35,70,.05);
}
.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}
.full{
    grid-column:1/-1;
}
label{
    display:block;
    margin-bottom:7px;
    font-size:13px;
    font-weight:800;
}
input,select,textarea{
    width:100%;
    border:1px solid #dfe4ec;
    border-radius:10px;
    padding:12px 13px;
    font:inherit;
    outline:none;
    background:#fff;
}
input:focus,select:focus,textarea:focus{
    border-color:#1769ff;
}
textarea{
    min-height:120px;
    resize:vertical;
}
.help{
    margin-top:6px;
    font-size:11px;
    color:#8791a1;
}
.checks{
    display:flex;
    gap:18px;
    flex-wrap:wrap;
    margin-top:3px;
}
.check{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:13px;
    font-weight:700;
}
.check input{
    width:auto;
}
.file{
    padding:10px;
}
.actions{
    margin-top:23px;
    display:flex;
    gap:9px;
}
.btn{
    border:0;
    border-radius:10px;
    padding:12px 17px;
    font-size:13px;
    font-weight:800;
    cursor:pointer;
    text-decoration:none;
}
.primary{
    background:#1769ff;
    color:#fff;
}
.secondary{
    background:#eef1f5;
    color:#536071;
}
.error{
    color:#d43b3b;
    font-size:12px;
    margin-top:5px;
}
@media(max-width:650px){
    .grid{
        grid-template-columns:1fr;
    }
    .full{
        grid-column:auto;
    }
    .card{
        padding:18px;
    }
}
</style>
</head>

<body>

<header class="top">
    <div class="brand">Toko UMKM Pro</div>
    <a class="back" href="{{ route('admin.products.index') }}">← Produk</a>
</header>

<div class="wrap">

    <div class="title">
        <h1>Tambah Produk</h1>
        <p>Masukkan informasi produk yang akan dijual.</p>
    </div>

    <div class="card">

        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data">

            @csrf

            <div class="grid">

                <div class="full">
                    <label>Nama Produk</label>
                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Keripik Pisang"
                        required
                    >
                    @error('nama')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label>Harga</label>
                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga') }}"
                        min="0"
                        placeholder="10000"
                        required
                    >
                </div>

                <div>
                    <label>Harga Coret</label>
                    <input
                        type="number"
                        name="harga_coret"
                        value="{{ old('harga_coret') }}"
                        min="0"
                        placeholder="15000"
                    >
                </div>

                <div>
                    <label>Stok</label>
                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok', 0) }}"
                        min="0"
                        required
                    >
                </div>

                <div>
                    <label>Kategori</label>

                    <select name="kategori">
                        <option value="">-- Pilih Kategori --</option>

                        @foreach($categories as $category)
                            <option
                                value="{{ $category->nama }}"
                                {{ old('kategori') === $category->nama ? 'selected' : '' }}
                            >
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>

                    <div class="help">
                        Kategori diambil dari menu Kategori Admin.
                    </div>
                </div>

                <div class="full">
                    <label>Deskripsi Produk</label>
                    <textarea
                        name="deskripsi"
                        placeholder="Jelaskan produk secara singkat..."
                    >{{ old('deskripsi') }}</textarea>
                </div>

                <div class="full">
                    <label>Foto Produk</label>

                    <input
                        class="file"
                        type="file"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <div class="help">
                        JPG, JPEG, PNG atau WEBP. Maksimal 3 MB.
                    </div>
                </div>

                <div class="full">
                    <div class="checks">

                        <label class="check">
                            <input
                                type="checkbox"
                                name="aktif"
                                value="1"
                                checked
                            >
                            Produk aktif
                        </label>

                        <label class="check">
                            <input
                                type="checkbox"
                                name="unggulan"
                                value="1"
                            >
                            Produk unggulan ⭐
                        </label>

                    </div>
                </div>

            </div>

            <div class="actions">
                <button class="btn primary" type="submit">
                    Simpan Produk
                </button>

                <a
                    class="btn secondary"
                    href="{{ route('admin.products.index') }}"
                >
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>
