<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengaturan Toko - {{ $store->nama_toko }}</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #172033;
        }

        .topbar {
            height: 72px;
            background: #ffffff;
            border-bottom: 1px solid #e7ebf2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #1769ff, #6c5ce7);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 800;
        }

        .brand-text strong {
            display: block;
            font-size: 16px;
        }

        .brand-text span {
            color: #8a94a6;
            font-size: 12px;
        }

        .back-btn {
            text-decoration: none;
            color: #172033;
            background: #f0f3f8;
            padding: 11px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
        }

        .container {
            max-width: 1180px;
            margin: 30px auto;
            padding: 0 18px 60px;
        }

        .hero {
            background: linear-gradient(135deg, #1769ff, #6c5ce7);
            color: white;
            padding: 30px;
            border-radius: 24px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            background: rgba(255,255,255,.10);
            right: -70px;
            top: -100px;
        }

        .hero h1 {
            font-size: 30px;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .hero p {
            opacity: .88;
            position: relative;
            z-index: 2;
        }

        .alert {
            padding: 15px 18px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .success {
            background: #e9f9ef;
            color: #187a3d;
            border: 1px solid #bdebcf;
        }

        .error {
            background: #fff0f0;
            color: #b42318;
            border: 1px solid #ffcaca;
        }

        .error ul {
            margin-left: 20px;
            margin-top: 8px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 22px;
        }

        .card {
            background: white;
            border: 1px solid #e7ebf2;
            border-radius: 22px;
            padding: 24px;
            margin-bottom: 22px;
            box-shadow: 0 10px 35px rgba(23, 32, 51, .05);
        }

        .card-title {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .card-desc {
            color: #8a94a6;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 17px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid #dfe4ec;
            border-radius: 13px;
            padding: 13px 14px;
            outline: none;
            font-size: 14px;
            background: #fbfcfe;
            transition: .2s;
        }

        input:focus,
        textarea:focus {
            border-color: #1769ff;
            background: white;
            box-shadow: 0 0 0 4px rgba(23,105,255,.08);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .file-box {
            border: 2px dashed #dce3ee;
            border-radius: 16px;
            padding: 18px;
            background: #fafcff;
        }

        .file-box input {
            border: none;
            background: transparent;
            padding: 0;
        }

        .preview-img {
            width: 100%;
            max-height: 180px;
            object-fit: cover;
            border-radius: 15px;
            margin-top: 14px;
        }

        .logo-preview {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 22px;
            margin-top: 14px;
            border: 1px solid #e5e9f0;
        }

        .color-row {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .color-row input[type="color"] {
            width: 58px;
            height: 48px;
            padding: 4px;
            cursor: pointer;
        }

        .save-area {
            position: sticky;
            bottom: 15px;
            z-index: 10;
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(15px);
            border: 1px solid #e5e9f0;
            border-radius: 18px;
            padding: 14px;
            display: flex;
            justify-content: flex-end;
            margin-top: 5px;
            box-shadow: 0 12px 35px rgba(0,0,0,.08);
        }

        .save-btn {
            border: none;
            cursor: pointer;
            padding: 14px 24px;
            border-radius: 13px;
            color: white;
            background: linear-gradient(135deg, #1769ff, #4d7dff);
            font-size: 14px;
            font-weight: 800;
            box-shadow: 0 8px 20px rgba(23,105,255,.25);
        }

        .preview-card {
            position: sticky;
            top: 100px;
        }

        .store-preview {
            border: 1px solid #e8ecf2;
            border-radius: 20px;
            overflow: hidden;
            background: white;
        }

        .preview-banner {
            height: 145px;
            background: linear-gradient(135deg, #1769ff, #ffd400);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .preview-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-content {
            padding: 20px;
            text-align: center;
        }

        .preview-logo {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 20px;
            margin-top: -55px;
            border: 4px solid white;
            background: white;
            position: relative;
        }

        .preview-content h3 {
            margin-top: 10px;
            font-size: 20px;
        }

        .preview-content p {
            color: #8a94a6;
            font-size: 13px;
            margin-top: 7px;
        }

        .preview-info {
            text-align: left;
            margin-top: 18px;
        }

        .info-item {
            display: flex;
            gap: 10px;
            margin-bottom: 11px;
            font-size: 13px;
            color: #5d6677;
        }

        .info-icon {
            width: 28px;
            height: 28px;
            border-radius: 9px;
            background: #eef4ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 850px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .preview-card {
                position: static;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                padding: 0 15px;
            }

            .container {
                margin-top: 18px;
            }

            .hero {
                padding: 23px;
            }

            .hero h1 {
                font-size: 24px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }

            .card {
                padding: 18px;
            }

            .save-area {
                justify-content: stretch;
            }

            .save-btn {
                width: 100%;
            }

            .brand-text {
                display: none;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-logo">🛍️</div>

        <div class="brand-text">
            <strong>Admin Toko UMKM Pro</strong>
            <span>Pengaturan Toko</span>
        </div>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="back-btn">
        ← Kembali ke Dashboard
    </a>
</header>

<main class="container">

    <section class="hero">
        <h1>Pengaturan Toko</h1>
        <p>
            Kelola identitas, tampilan, kontak, dan informasi toko kamu dari satu tempat.
        </p>
    </section>

    @if(session('success'))
        <div class="alert success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert error">
            <strong>❌ Ada data yang belum benar:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.store-settings.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="grid">

            <div>

                {{-- IDENTITAS --}}
                <div class="card">
                    <div class="card-title">🏪 Identitas Toko</div>
                    <div class="card-desc">
                        Informasi utama yang akan ditampilkan di halaman toko.
                    </div>

                    <div class="form-grid">

                        <div>
                            <label>Nama Toko *</label>

                            <input
                                type="text"
                                name="nama_toko"
                                value="{{ old('nama_toko', $store->nama_toko) }}"
                                placeholder="Contoh: Toko Adit"
                                required
                            >
                        </div>

                        <div>
                            <label>Slogan</label>

                            <input
                                type="text"
                                name="slogan"
                                value="{{ old('slogan', $store->slogan) }}"
                                placeholder="Belanja Hemat Cuan Nikmat"
                            >
                        </div>

                        <div class="full">
                            <label>Deskripsi Toko</label>

                            <textarea
                                name="deskripsi"
                                placeholder="Ceritakan tentang toko kamu..."
                            >{{ old('deskripsi', $store->deskripsi) }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- GAMBAR --}}
                <div class="card">
                    <div class="card-title">🖼️ Logo & Banner</div>
                    <div class="card-desc">
                        Upload gambar yang akan digunakan di halaman toko.
                    </div>

                    <div class="form-grid">

                        <div>
                            <label>Logo Toko</label>

                            <div class="file-box">
                                <input
                                    type="file"
                                    name="logo"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                @if($store->logo)
                                    <img
                                        src="{{ asset('storage/'.$store->logo) }}"
                                        class="logo-preview"
                                        alt="Logo Toko"
                                    >
                                @endif
                            </div>
                        </div>

                        <div>
                            <label>Banner Toko</label>

                            <div class="file-box">
                                <input
                                    type="file"
                                    name="banner"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                @if($store->banner)
                                    <img
                                        src="{{ asset('storage/'.$store->banner) }}"
                                        class="preview-img"
                                        alt="Banner Toko"
                                    >
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                {{-- KONTAK --}}
                <div class="card">
                    <div class="card-title">📞 Kontak & Sosial Media</div>
                    <div class="card-desc">
                        Masukkan informasi yang bisa digunakan pelanggan untuk menghubungi toko.
                    </div>

                    <div class="form-grid">

                        <div>
                            <label>WhatsApp</label>

                            <input
                                type="text"
                                name="whatsapp"
                                value="{{ old('whatsapp', $store->whatsapp) }}"
                                placeholder="628123456789"
                            >
                        </div>

                        <div>
                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $store->email) }}"
                                placeholder="tokomu@email.com"
                            >
                        </div>

                        <div>
                            <label>Instagram</label>

                            <input
                                type="text"
                                name="instagram"
                                value="{{ old('instagram', $store->instagram) }}"
                                placeholder="@tokomu"
                            >
                        </div>

                        <div>
                            <label>TikTok</label>

                            <input
                                type="text"
                                name="tiktok"
                                value="{{ old('tiktok', $store->tiktok) }}"
                                placeholder="@tokomu"
                            >
                        </div>

                        <div class="full">
                            <label>Alamat Toko</label>

                            <textarea
                                name="alamat"
                                placeholder="Alamat lengkap toko..."
                            >{{ old('alamat', $store->alamat) }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- WARNA --}}
                <div class="card">
                    <div class="card-title">🎨 Warna Toko</div>
                    <div class="card-desc">
                        Atur warna utama dan warna aksen untuk identitas toko.
                    </div>

                    <div class="form-grid">

                        <div>
                            <label>Warna Utama</label>

                            <div class="color-row">
                                <input
                                    type="color"
                                    name="warna_utama"
                                    value="{{ old('warna_utama', $store->warna_utama ?: '#1769ff') }}"
                                >

                                <input
                                    type="text"
                                    value="{{ old('warna_utama', $store->warna_utama ?: '#1769ff') }}"
                                    readonly
                                >
                            </div>
                        </div>

                        <div>
                            <label>Warna Kedua</label>

                            <div class="color-row">
                                <input
                                    type="color"
                                    name="warna_kedua"
                                    value="{{ old('warna_kedua', $store->warna_kedua ?: '#ffd400') }}"
                                >

                                <input
                                    type="text"
                                    value="{{ old('warna_kedua', $store->warna_kedua ?: '#ffd400') }}"
                                    readonly
                                >
                            </div>
                        </div>

                    </div>
                </div>

                {{-- TOMBOL SIMPAN --}}
                <div class="save-area">
                    <button type="submit" class="save-btn">
                        💾 Simpan Perubahan
                    </button>
                </div>

            </div>

            {{-- PREVIEW --}}
            <aside>

                <div class="card preview-card">

                    <div class="card-title">👁️ Preview Toko</div>

                    <div class="card-desc">
                        Gambaran identitas toko kamu.
                    </div>

                    <div class="store-preview">

                        <div class="preview-banner">

                            @if($store->banner)
                                <img
                                    src="{{ asset('storage/'.$store->banner) }}"
                                    alt="Banner"
                                >
                            @else
                                <span style="font-size:42px;">🛍️</span>
                            @endif

                        </div>

                        <div class="preview-content">

                            @if($store->logo)
                                <img
                                    src="{{ asset('storage/'.$store->logo) }}"
                                    class="preview-logo"
                                    alt="Logo"
                                >
                            @else
                                <div
                                    class="preview-logo"
                                    style="
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        font-size:30px;
                                    "
                                >
                                    🛍️
                                </div>
                            @endif

                            <h3>
                                {{ $store->nama_toko ?: 'Nama Toko' }}
                            </h3>

                            <p>
                                {{ $store->slogan ?: 'Slogan toko kamu' }}
                            </p>

                            <div class="preview-info">

                                @if($store->whatsapp)
                                    <div class="info-item">
                                        <div class="info-icon">📱</div>
                                        <span>{{ $store->whatsapp }}</span>
                                    </div>
                                @endif

                                @if($store->email)
                                    <div class="info-item">
                                        <div class="info-icon">📧</div>
                                        <span>{{ $store->email }}</span>
                                    </div>
                                @endif

                                @if($store->alamat)
                                    <div class="info-item">
                                        <div class="info-icon">📍</div>
                                        <span>{{ $store->alamat }}</span>
                                    </div>
                                @endif

                                @if($store->instagram)
                                    <div class="info-item">
                                        <div class="info-icon">📸</div>
                                        <span>{{ $store->instagram }}</span>
                                    </div>
                                @endif

                                @if($store->tiktok)
                                    <div class="info-item">
                                        <div class="info-icon">🎵</div>
                                        <span>{{ $store->tiktok }}</span>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>

                </div>

            </aside>

        </div>

    </form>

</main>

</body>
</html>
