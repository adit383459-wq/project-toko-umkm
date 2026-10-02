<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $store->nama_toko ?? 'Toko UMKM Pro' }}</title>

    <style>
        :root {
            --primary: {{ $store->warna_utama ?? '#1769ff' }};
            --secondary: {{ $store->warna_kedua ?? '#ffd400' }};
            --dark: #111827;
            --muted: #6b7280;
            --light: #f8fafc;
            --white: #ffffff;
            --border: #e5e7eb;
            --shadow: 0 20px 50px rgba(15, 23, 42, .10);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: min(1150px, 92%);
            margin: auto;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0, 0, 0, .06);
        }

        .nav-inner {
            min-height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .brand-logo {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            object-fit: cover;
            background: var(--primary);
        }

        .brand-logo-placeholder {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: grid;
            place-items: center;
            font-size: 22px;
        }

        .brand-text {
            min-width: 0;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .brand-slogan {
            color: var(--muted);
            font-size: 12px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .nav-menu a {
            padding: 10px 13px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            transition: .25s;
        }

        .nav-menu a:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        .admin-login {
            background: var(--dark) !important;
            color: white !important;
        }

        .admin-login:hover {
            background: var(--primary) !important;
            transform: translateY(-2px);
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            padding: 70px 0 45px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 45px;
            align-items: center;
        }

        .badge {
            display: inline-flex;
            padding: 8px 13px;
            border-radius: 999px;
            background: rgba(23, 105, 255, .08);
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .hero h1 {
            font-size: clamp(38px, 6vw, 70px);
            line-height: 1.02;
            letter-spacing: -2px;
            margin-bottom: 18px;
        }

        .hero h1 span {
            color: var(--primary);
        }

        .hero-description {
            color: var(--muted);
            font-size: 17px;
            max-width: 600px;
            margin-bottom: 28px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 19px;
            border-radius: 13px;
            font-weight: 800;
            transition: .25s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 12px 25px rgba(23, 105, 255, .22);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
        }

        .btn-light {
            background: white;
            border: 1px solid var(--border);
        }

        .btn-light:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .hero-card {
            position: relative;
            min-height: 390px;
            border-radius: 30px;
            overflow: hidden;
            background: linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );
            box-shadow: var(--shadow);
        }

        .hero-card img {
            width: 100%;
            height: 100%;
            min-height: 390px;
            object-fit: cover;
            display: block;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(0, 0, 0, .65),
                rgba(0, 0, 0, .05) 65%
            );
        }

        .hero-card-content {
            position: absolute;
            bottom: 25px;
            left: 25px;
            right: 25px;
            color: white;
        }

        .hero-card-content h3 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .hero-card-content p {
            opacity: .9;
        }

        .empty-visual {
            min-height: 390px;
            display: grid;
            place-items: center;
            font-size: 100px;
        }

        /* =========================
           FEATURES
        ========================= */

        .features {
            padding: 30px 0 65px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .feature {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 23px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, .04);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(23, 105, 255, .09);
            display: grid;
            place-items: center;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .feature h3 {
            font-size: 17px;
            margin-bottom: 5px;
        }

        .feature p {
            color: var(--muted);
            font-size: 14px;
        }

        /* =========================
           SECTION
        ========================= */

        .section {
            padding: 65px 0;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .section-heading .small {
            color: var(--primary);
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .section-heading h2 {
            font-size: 34px;
            margin: 5px 0;
        }

        .section-heading p {
            color: var(--muted);
        }

        /* =========================
           CATEGORY
        ========================= */

        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .category {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            transition: .25s;
        }

        .category:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            border-color: var(--primary);
        }

        .category-icon {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .category h3 {
            font-size: 16px;
        }

        .category p {
            font-size: 13px;
            color: var(--muted);
        }

        /* =========================
           PRODUCTS
        ========================= */

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .product {
            background: white;
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            transition: .25s;
        }

        .product:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow);
        }

        .product-image {
            height: 190px;
            background: linear-gradient(
                135deg,
                rgba(23, 105, 255, .12),
                rgba(255, 212, 0, .18)
            );
            display: grid;
            place-items: center;
            font-size: 65px;
        }

        .product-body {
            padding: 18px;
        }

        .product-category {
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .product h3 {
            margin: 5px 0 8px;
            font-size: 18px;
        }

        .product-price {
            font-size: 19px;
            font-weight: 900;
        }

        .product-button {
            width: 100%;
            margin-top: 15px;
            border: 0;
            cursor: pointer;
        }


        /* =========================
           PREMIUM PRODUCT CARD
        ========================= */

        .product{
            position:relative;
            background:#fff;
            border:1px solid var(--border);
            border-radius:22px;
            overflow:hidden;
            transition:.25s ease;
        }

        .product:hover{
            transform:translateY(-5px);
            box-shadow:0 18px 45px rgba(23,105,255,.12);
        }

        .product-image{
            position:relative;
            height:210px;
            overflow:hidden;
            background:#f3f6fb;
        }

        .product-image img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
            transition:transform .4s ease;
        }

        .product:hover .product-image img{
            transform:scale(1.045);
        }

        .product-no-image{
            width:100%;
            height:100%;
            display:grid;
            place-items:center;
            font-size:55px;
            background:linear-gradient(
                135deg,
                rgba(23,105,255,.08),
                rgba(255,212,0,.12)
            );
        }

        .product-featured{
            position:absolute;
            top:11px;
            left:11px;
            padding:6px 9px;
            border-radius:999px;
            background:#fff;
            color:#1769ff;
            font-size:9px;
            font-weight:900;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .product-body{
            padding:17px;
        }

        .product-category{
            color:var(--primary);
            font-size:10px;
            font-weight:900;
            text-transform:uppercase;
            letter-spacing:.5px;
        }

        .product h3{
            margin:6px 0 7px;
            font-size:16px;
            line-height:1.35;
            min-height:43px;
        }

        .product-price{
            font-size:19px;
            font-weight:950;
            color:#172033;
        }

        .product-old-price{
            margin-top:3px;
            color:#a2a9b5;
            font-size:10px;
            text-decoration:line-through;
        }

        .product-stock{
            display:flex;
            align-items:center;
            gap:6px;
            margin-top:9px;
            color:#758094;
            font-size:10px;
            font-weight:700;
        }

        .stock-dot{
            width:7px;
            height:7px;
            border-radius:50%;
            background:#20a464;
            display:inline-block;
        }

        .stock-dot.empty{
            background:#e04a4a;
        }

        .product-actions{
            display:grid;
            grid-template-columns:45px 1fr;
            gap:8px;
            margin-top:14px;
        }

        .product-cart-btn,
        .product-buy-btn{
            min-height:42px;
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:11px;
            font-weight:900;
            text-decoration:none;
            transition:.2s;
        }

        .product-cart-btn{
            background:#eef4ff;
            color:#1769ff;
            border:1px solid #dce8ff;
        }

        .product-cart-btn:hover{
            background:#e4eeff;
            transform:translateY(-1px);
        }

        .product-cart-btn span{
            display:none;
        }

        .product-buy-btn{
            background:var(--primary);
            color:#fff;
            box-shadow:0 7px 18px rgba(23,105,255,.16);
        }

        .product-buy-btn:hover{
            transform:translateY(-1px);
            filter:brightness(.96);
        }

        .product-disabled{
            width:100%;
            min-height:42px;
            margin-top:14px;
            border:0;
            border-radius:12px;
            background:#f0f2f5;
            color:#9ba3b0;
            font-size:11px;
            font-weight:900;
        }

        @media(max-width:600px){

            .product-image{
                height:150px;
            }

            .product-body{
                padding:12px;
            }

            .product h3{
                font-size:13px;
                min-height:35px;
            }

            .product-price{
                font-size:16px;
            }

            .product-stock{
                font-size:9px;
            }

            .product-actions{
                grid-template-columns:42px 1fr;
            }

            .product-cart-btn{
                font-size:17px;
            }

            .product-buy-btn{
                font-size:10px;
            }

        }

        /* =========================
           PROMO
        ========================= */

        .promo {
            padding: 20px 0 70px;
        }

        .promo-card {
            position: relative;
            overflow: hidden;
            border-radius: 30px;
            padding: 45px;
            color: white;
            background: linear-gradient(
                120deg,
                var(--primary),
                #173b91
            );
        }

        .promo-card::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            right: -80px;
            top: -100px;
            background: rgba(255, 255, 255, .10);
        }

        .promo-card h2 {
            font-size: 35px;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .promo-card p {
            opacity: .9;
            max-width: 650px;
            margin-bottom: 22px;
            position: relative;
            z-index: 2;
        }

        .promo-card .btn {
            background: white;
            color: var(--dark);
            position: relative;
            z-index: 2;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #0f172a;
            color: white;
            padding: 50px 0 25px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr;
            gap: 40px;
            padding-bottom: 35px;
        }

        .footer-title {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .footer-text {
            color: #94a3b8;
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .footer-links a {
            color: #cbd5e1;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.1);
            padding-top: 20px;
            color: #94a3b8;
            font-size: 13px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* =========================
           WHATSAPP
        ========================= */

        .wa-floating {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #25d366;
            color: white;
            display: grid;
            place-items: center;
            font-size: 27px;
            box-shadow: 0 12px 30px rgba(37, 211, 102, .35);
            z-index: 999;
            transition: .25s;
        }

        .wa-floating:hover {
            transform: scale(1.08);
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {
            .nav-menu a:not(.admin-login) {
                display: none;
            }

            .hero-grid {
                grid-template-columns: 1fr;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .hero {
                padding-top: 45px;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero-card,
            .hero-card img,
            .empty-visual {
                min-height: 300px;
            }

            .category-grid,
            .product-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .product-image {
                height: 145px;
                font-size: 48px;
            }

            .product-body {
                padding: 14px;
            }

            .promo-card {
                padding: 30px 22px;
            }

            .promo-card h2 {
                font-size: 28px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .brand-slogan {
                display: none;
            }

            .brand-name {
                max-width: 150px;
            }
        }
    
<style>
.category-filter {
    appearance: none;
    -webkit-appearance: none;
    font: inherit;
    color: inherit;
    cursor: pointer;
    text-align: center;
    border: 1px solid transparent;
}

.category-filter.active {
    border-color: #1769ff;
    background: #f1f6ff;
    transform: translateY(-2px);
}

.category-filter:hover {
    border-color: #1769ff;
    transform: translateY(-2px);
}
</style>

</style>























\n



<style id="hero-banner-size-fix">
.hero-banner-image {
    width: 100% !important;
    height: auto !important;
    max-height: none !important;
    object-fit: contain !important;
    object-position: center !important;
    display: block !important;
    border-radius: 10px !important;
}

.hero-banner-wrapper {
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

@media (max-width: 768px) {
    .hero-banner-image {
        width: 100% !important;
        height: auto !important;
    }
}
</style>





<style id="store-brand-modern">
.store-brand {
    display: inline-flex;
    flex-direction: column;
    text-decoration: none;
    line-height: 1;
}

.store-brand-name {
    font-family: Georgia, "Times New Roman", serif;
    font-size: clamp(24px, 4vw, 36px);
    font-weight: 800;
    letter-spacing: -1.5px;
    background: linear-gradient(135deg, #111827 15%, #1769ff 55%, #4f8cff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    filter: drop-shadow(0 3px 8px rgba(23,105,255,.12));
    transition: .25s ease;
}

.store-brand:hover .store-brand-name {
    letter-spacing: -0.5px;
    transform: translateY(-1px);
}

.store-brand-slogan {
    margin-top: 6px;
    font-family: Arial, sans-serif;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #8a94a6;
}

@media (max-width: 768px) {
    .store-brand-name {
        font-size: 24px;
        letter-spacing: -1px;
    }

    .store-brand-slogan {
        font-size: 7px;
        letter-spacing: 1.3px;
    }
}
</style>


<style id="premium-listia-brand">
.brand-name.premium-brand-name {
    display: flex !important;
    align-items: center !important;
    gap: 5px !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: .95 !important;
    white-space: nowrap !important;
}

.brand-main-text {
    font-family: "Trebuchet MS", Arial, sans-serif !important;
    font-size: 29px !important;
    font-weight: 900 !important;
    letter-spacing: -1.6px !important;
    background: linear-gradient(100deg, #101828 0%, #173b82 48%, #1769ff 100%) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    background-clip: text !important;
    text-shadow: 0 4px 12px rgba(23,105,255,.10) !important;
}

.brand-spark {
    color: #1769ff !important;
    font-size: 14px !important;
    margin-top: -17px !important;
    filter: drop-shadow(0 2px 5px rgba(23,105,255,.35)) !important;
}

.brand-slogan {
    margin-top: 5px !important;
    font-size: 8px !important;
    font-weight: 700 !important;
    letter-spacing: 1.5px !important;
    color: #8a94a6 !important;
    text-transform: uppercase !important;
}

@media (max-width: 768px) {
    .brand-main-text {
        font-size: 22px !important;
        letter-spacing: -1px !important;
    }

    .brand-spark {
        font-size: 11px !important;
        margin-top: -12px !important;
    }

    .brand-slogan {
        font-size: 7px !important;
        letter-spacing: 1px !important;
    }
}
</style>
\n
<style id="admin-button-elegant">
.nav-menu .admin-login {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 5px !important;

    padding: 7px 11px !important;
    min-height: 32px !important;

    border: 1px solid rgba(23,105,255,.18) !important;
    border-radius: 9px !important;

    background: rgba(255,255,255,.9) !important;
    color: #173b82 !important;

    font-size: 12px !important;
    font-weight: 700 !important;
    line-height: 1 !important;

    text-decoration: none !important;
    box-shadow: 0 3px 12px rgba(23,105,255,.08) !important;

    transition: all .2s ease !important;
}

.nav-menu .admin-login:hover {
    background: #f4f8ff !important;
    border-color: rgba(23,105,255,.35) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 5px 15px rgba(23,105,255,.13) !important;
}

@media (max-width: 768px) {
    .nav-menu .admin-login {
        padding: 6px 9px !important;
        min-height: 29px !important;
        border-radius: 8px !important;
        font-size: 11px !important;
        gap: 3px !important;
    }
}
</style>


<style id="cart-navbar-style">
.nav-menu .cart-nav {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;

    padding: 7px 11px !important;
    min-height: 32px !important;

    border: 1px solid rgba(23,105,255,.16) !important;
    border-radius: 9px !important;

    background: rgba(255,255,255,.92) !important;
    color: #173b82 !important;

    font-family: Arial, sans-serif !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .1px !important;
    line-height: 1 !important;

    text-decoration: none !important;
    box-shadow: 0 3px 12px rgba(23,105,255,.07) !important;

    transition: all .2s ease !important;
}

.nav-menu .cart-nav:hover {
    background: linear-gradient(135deg, #f5f9ff, #eef5ff) !important;
    border-color: rgba(23,105,255,.3) !important;
    color: #1769ff !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 16px rgba(23,105,255,.12) !important;
}

.nav-menu .cart-nav:first-letter {
    font-size: 14px !important;
}

.nav-menu .cart-badge {
    min-width: 17px !important;
    height: 17px !important;
    padding: 0 4px !important;

    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;

    border-radius: 50% !important;
    background: linear-gradient(135deg, #1769ff, #4388ff) !important;
    color: #fff !important;

    font-family: Arial, sans-serif !important;
    font-size: 9px !important;
    font-weight: 800 !important;
    line-height: 1 !important;

    box-shadow: 0 2px 7px rgba(23,105,255,.28) !important;
}

@media (max-width: 768px) {
    .nav-menu .cart-nav {
        padding: 6px 9px !important;
        min-height: 29px !important;
        border-radius: 8px !important;
        font-size: 11px !important;
        gap: 4px !important;
    }

    .nav-menu .cart-badge {
        min-width: 16px !important;
        height: 16px !important;
        font-size: 8px !important;
    }
}
</style>


<style id="category-filter-force">
.category-grid .category-filter {
    position: relative !important;
    z-index: 20 !important;
    pointer-events: auto !important;
    cursor: pointer !important;
    touch-action: manipulation !important;
    user-select: none !important;
    -webkit-tap-highlight-color: transparent !important;
}

.category-grid .category-filter * {
    pointer-events: none !important;
}

.category-grid .category-filter.active {
    border-color: #1769ff !important;
    background: #f1f6ff !important;
    box-shadow: 0 8px 24px rgba(23,105,255,.12) !important;
}
</style>


<style id="homepage-final-polish">
/* =========================================================
   FINAL POLISH — hanya merapikan tampilan yang sudah ada
========================================================= */

html {
    scroll-padding-top: 85px;
}

body {
    overflow-x: hidden;
}

/* NAVBAR */
.navbar {
    box-shadow: 0 4px 20px rgba(15, 23, 42, .035);
}

.nav-inner {
    min-height: 70px;
}

.brand-logo,
.brand-logo-placeholder {
    flex: 0 0 auto;
}

.nav-menu {
    flex-wrap: wrap;
    justify-content: flex-end;
}

.nav-menu a {
    white-space: nowrap;
}

/* HERO */
.hero {
    padding: 58px 0 42px;
}

.hero-grid {
    gap: 38px;
}

.hero h1 {
    max-width: 700px;
    text-wrap: balance;
}

.hero-description {
    max-width: 560px;
    line-height: 1.75;
}

.hero-card {
    min-height: 360px;
    border: 1px solid rgba(255,255,255,.45);
}

.hero-card img {
    min-height: 360px;
}

.hero-card-content {
    z-index: 2;
}

.hero-card-content h3 {
    line-height: 1.2;
}

/* FEATURES */
.features {
    padding-top: 22px;
    padding-bottom: 48px;
}

.feature {
    transition: transform .22s ease, box-shadow .22s ease;
}

.feature:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(15,23,42,.07);
}

/* SECTION */
.section {
    padding: 55px 0;
}

.section-heading {
    max-width: 720px;
    margin-left: auto;
    margin-right: auto;
}

.section-heading h2 {
    line-height: 1.15;
}

/* CATEGORY */
.category-grid {
    gap: 14px;
}

.category {
    min-height: 135px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px 15px;
}

.category-icon {
    line-height: 1;
}

.category h3 {
    margin-bottom: 2px;
}

/* PRODUCTS */
.product-grid {
    gap: 18px;
    align-items: stretch;
}

.product {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.product-image {
    flex: 0 0 auto;
}

.product-image img {
    background: #f3f6fb;
}

.product-body {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.product-stock {
    min-height: 17px;
}

.product-actions {
    margin-top: auto;
    padding-top: 14px;
}

.product-buy-btn,
.product-cart-btn {
    min-width: 0;
}

/* BANNER */
.hero-banner-wrapper {
    border-radius: 16px;
    overflow: hidden;
}

.hero-banner-image {
    transition: transform .35s ease;
}

.hero-banner-wrapper:hover .hero-banner-image {
    transform: scale(1.01);
}

/* MOBILE */
@media (max-width: 900px) {
    .hero-grid {
        grid-template-columns: 1fr;
        gap: 28px;
    }

    .hero {
        padding-top: 42px;
    }

    .hero-card,
    .hero-card img {
        min-height: 320px;
    }

    .feature-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .category-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .container {
        width: min(100% - 24px, 1150px);
    }

    .nav-inner {
        min-height: 62px;
        gap: 8px;
    }

    .brand {
        gap: 8px;
        min-width: 0;
    }

    .brand-logo,
    .brand-logo-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 12px;
    }

    .brand-name {
        font-size: 15px;
    }

    .brand-slogan {
        font-size: 7px !important;
        letter-spacing: .8px !important;
    }

    .nav-menu {
        gap: 4px;
    }

    .nav-menu a {
        padding: 6px 8px;
    }

    .hero {
        padding: 32px 0 25px;
    }

    .hero-grid {
        gap: 22px;
    }

    .badge {
        font-size: 10px;
        padding: 7px 10px;
        margin-bottom: 13px;
    }

    .hero h1 {
        font-size: clamp(32px, 10vw, 48px);
        letter-spacing: -1.5px;
        margin-bottom: 13px;
    }

    .hero-description {
        font-size: 14px;
        line-height: 1.65;
        margin-bottom: 20px;
    }

    .hero-buttons {
        gap: 8px;
    }

    .btn {
        padding: 11px 14px;
        border-radius: 11px;
        font-size: 12px;
    }

    .hero-card,
    .hero-card img {
        min-height: 235px;
    }

    .hero-card-content {
        left: 17px;
        right: 17px;
        bottom: 17px;
    }

    .hero-card-content h3 {
        font-size: 19px;
    }

    .hero-card-content p {
        font-size: 12px;
    }

    .empty-visual {
        min-height: 235px;
        font-size: 70px;
    }

    .features {
        padding: 18px 0 35px;
    }

    .feature-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .feature {
        padding: 16px;
        border-radius: 16px;
    }

    .feature-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .feature h3 {
        font-size: 15px;
    }

    .feature p {
        font-size: 12px;
    }

    .section {
        padding: 40px 0;
    }

    .section-heading {
        margin-bottom: 22px;
    }

    .section-heading .small {
        font-size: 10px;
    }

    .section-heading h2 {
        font-size: 25px;
    }

    .section-heading p {
        font-size: 12px;
    }

    .category-grid {
        gap: 9px;
    }

    .category {
        min-height: 105px;
        padding: 14px 9px;
        border-radius: 16px;
    }

    .category-icon {
        font-size: 27px;
        margin-bottom: 7px;
    }

    .category h3 {
        font-size: 13px;
    }

    .category p {
        font-size: 10px;
    }

    .product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .product {
        border-radius: 16px;
    }

    .product-image {
        height: 145px;
    }

    .product-body {
        padding: 12px;
    }

    .product-category {
        font-size: 8px;
    }

    .product h3 {
        font-size: 13px;
        line-height: 1.3;
        margin: 5px 0;
    }

    .product-price {
        font-size: 15px;
    }

    .product-old-price {
        font-size: 9px;
    }

    .product-stock {
        font-size: 8px;
        gap: 4px;
    }

    .product-actions {
        grid-template-columns: 38px minmax(0, 1fr);
        gap: 6px;
        margin-top: 10px;
        padding-top: 10px;
    }

    .product-cart-btn,
    .product-buy-btn {
        min-height: 37px;
        border-radius: 9px;
    }

    .product-cart-btn {
        font-size: 15px;
    }

    .product-buy-btn {
        font-size: 9px;
        white-space: nowrap;
    }

    .product-featured {
        top: 7px;
        left: 7px;
        padding: 5px 7px;
        font-size: 7px;
    }

    .hero-banner-wrapper {
        border-radius: 12px;
    }
}

/* VERY SMALL PHONES */
@media (max-width: 380px) {
    .brand-slogan {
        display: none;
    }

    .nav-menu a {
        padding: 5px 6px;
        font-size: 10px;
    }

    .product-grid {
        gap: 8px;
    }

    .product-body {
        padding: 10px;
    }

    .product-actions {
        grid-template-columns: 35px minmax(0, 1fr);
    }

    .product-buy-btn {
        font-size: 8px;
    }
}
</style>

</head>

<body>

    {{-- =========================
         NAVBAR
    ========================== --}}
    <header class="navbar">
        <div class="container nav-inner">

            <a href="{{ route('home') }}" class="brand">

                @if($store->logo)
                    <img
                        src="{{ asset('storage/' . $store->logo) }}"
                        alt="Logo {{ $store->nama_toko }}"
                        class="brand-logo"
                    >
                @else
                    <div class="brand-logo-placeholder">
                        🛍️
                    </div>
                @endif

                <div class="brand-text">
                    <div class="brand-name premium-brand-name">
                        <span class="brand-main-text">{{ $store->nama_toko }}</span>
                        <span class="brand-spark">✦</span>
                    </div>

                    <div class="brand-slogan">
                        {{ $store->slogan ?? 'Belanja Hemat Cuan Nikmat' }}
                    </div>
                </div>

            </a>

            <nav class="nav-menu">
                <a href="#produk">Produk</a>
                <a href="#kategori">Kategori</a>
                <a href="#promo">Promo</a>

                <a
                    href="{{ route('admin.login') }}"
                    class="admin-login"
                >
                    🔐 Admin
                </a>
            
<a href="{{ route('cart.index') }}" class="cart-nav">
    🛒 Keranjang
    @php
        $cartCount = collect(session('cart', []))->sum('jumlah');
    @endphp
    @if($cartCount > 0)
        <span class="cart-badge">{{ $cartCount }}</span>
    @endif
</a>

</nav>

        </div>
    </header>


    {{-- =========================
         HERO
    ========================== --}}
    <main>

        <section class="hero">
            <div class="container hero-grid">

                <div>

                    <div class="badge">
                        ✨ Toko UMKM Pilihan
                    </div>

                    <h1>
                        {{ $store->nama_toko }}
                        <span>.</span>
                    </h1>

                    <p class="hero-description">
                        {{ $store->deskripsi ?? 'Temukan produk pilihan terbaik untuk kebutuhanmu.' }}
                    </p>

                    <div class="hero-buttons">

                        <a href="#produk" class="btn btn-primary">
                            🛍️ Belanja Sekarang
                        </a>

                        <a href="{{ route('orders.tracking') }}" class="btn btn-light">
                            🔎 Cek Pesanan
                        </a>

                        @if($store->whatsapp)

                            @php
                                $waNumber = preg_replace(
                                    '/[^0-9]/',
                                    '',
                                    $store->whatsapp
                                );
                            @endphp

                            <a
                                href="https://wa.me/{{ $waNumber }}"
                                target="_blank"
                                class="btn btn-light"
                            >
                                💬 Chat WhatsApp
                            </a>

                        @else

                            <a href="#promo" class="btn btn-light">
                                ✨ Lihat Promo
                            </a>

                        @endif

                    </div>

                </div>


                <div class="hero-card">

                    @if($store->banner)

                        <img
    src="{{ asset('storage/' . $store->banner) }}"
    alt="{{ $store->nama_toko }}"
    class="hero-banner-image"
>nama_toko }}"
                        >

                        <div class="hero-overlay"></div>

                        <div class="hero-card-content">
                            <h3>
                                {{ $store->slogan ?? 'Belanja Lebih Mudah' }}
                            </h3>

                            <p>
                                Produk pilihan untuk kamu.
                            </p>
                        </div>

                    @else

                        <div class="empty-visual">
                            🛍️
                        </div>

                    @endif

                </div>

            </div>
        </section>


        {{-- =========================
             FEATURES
        ========================== --}}
        <section class="features">

            <div class="container feature-grid">

                <div class="feature">
                    <div class="feature-icon">🚚</div>

                    <h3>Praktis & Mudah</h3>

                    <p>
                        Pilih produk favoritmu dengan proses yang sederhana.
                    </p>
                </div>

                <div class="feature">
                    <div class="feature-icon">💎</div>

                    <h3>Produk Pilihan</h3>

                    <p>
                        Kami menghadirkan produk pilihan untuk kebutuhanmu.
                    </p>
                </div>

                <div class="feature">
                    <div class="feature-icon">💬</div>

                    <h3>Customer Support</h3>

                    <p>
                        Hubungi kami untuk mendapatkan informasi produk.
                    </p>
                </div>

            </div>

        </section>


        {{-- =========================
             KATEGORI
        ========================== --}}
        <section class="section" id="kategori">

            <div class="container">

                <div class="section-heading">

                    <div class="small">
                        Jelajahi
                    </div>

                    <h2>Kategori Produk</h2>

                    <p>
                        Temukan berbagai pilihan produk menarik.
                    </p>

                </div>

                <div class="category-grid">

    <button type="button" class="category category-filter active" data-filter="semua">
        <div class="category-icon">✨</div>
        <h3>Semua</h3>
        <p>Semua Produk</p>
    </button>

    <button type="button" class="category category-filter" data-filter="terlaris">
        <div class="category-icon">🔥</div>
        <h3>Terlaris</h3>
        <p>Produk Terlaris</p>
    </button>

    <button type="button" class="category category-filter" data-filter="premium">
        <div class="category-icon">💎</div>
        <h3>Premium</h3>
        <p>Produk Premium</p>
    </button>

    @php
        $kategoriHomepage = \App\Models\Category::where('aktif', true)
            ->orderBy('nama')
            ->get();
    @endphp

    @foreach($kategoriHomepage as $category)
        <button
            type="button"
            class="category category-filter"
            data-filter="{{ strtolower($category->nama) }}"
        >
            <div class="category-icon">🛍️</div>
            <h3>{{ $category->nama }}</h3>
            <p>Lihat Produk</p>
        </button>
    @endforeach

</div>

            </div>

        </section>


        {{-- =========================
             PRODUK
        ========================== --}}
        <section class="section" id="produk">

            <div class="container">

                <div class="section-heading">

                    <div class="small">
                        Produk
                    </div>

                    <h2>Produk Unggulan</h2>

                    <p>
                        Beberapa produk pilihan dari {{ $store->nama_toko }}.
                    </p>

                </div>


                <div class="product-grid">

                    @foreach($products as $product)

                        <article
                            class="product"
                            data-category="{{ strtolower(trim($product->kategori ?? '')) }}"
                            data-unggulan="{{ $product->unggulan ? '1' : '0' }}"
                        >

                            <div class="product-image">

                                @if($product->gambar)

                                    <img
                                        src="{{ asset('storage/' . $product->gambar) }}"
                                        alt="{{ $product->nama }}"
                                    >

                                @else

                                    <div class="product-no-image">
                                        🛍️
                                    </div>

                                @endif

                                @if($product->unggulan)
                                    <span class="product-featured">
                                        ⭐ Unggulan
                                    </span>
                                @endif

                            </div>


                            <div class="product-body">

                                <div class="product-category">
                                    {{ $product->kategori ?: 'Produk' }}
                                </div>


                                <h3>
                                    {{ $product->nama }}
                                </h3>


                                <div class="product-price">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </div>


                                @if($product->harga_coret && $product->harga_coret > $product->harga)

                                    <div class="product-old-price">
                                        Rp {{ number_format($product->harga_coret, 0, ',', '.') }}
                                    </div>

                                @endif


                                <div class="product-stock">

                                    @if($product->stok > 0)

                                        <span class="stock-dot"></span>

                                        Stok tersedia: {{ $product->stok }}

                                    @else

                                        <span class="stock-dot empty"></span>

                                        Stok habis

                                    @endif

                                </div>


                                @if($product->aktif && $product->stok > 0)

                                    <div class="product-actions">

                                        <a
                                            href="{{ route('cart.add', $product->id) }}"
                                            class="product-cart-btn"
                                        >
                                            🛒
                                            <span>Keranjang</span>
                                        </a>


                                        <a
                                            href="{{ route('cart.buyNow', $product->id) }}"
                                            class="product-buy-btn"
                                        >
                                            Beli Sekarang
                                        </a>

                                    </div>

                                @else

                                    <button
                                        type="button"
                                        class="product-disabled"
                                        disabled
                                    >
                                        Stok Habis
                                    </button>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- =========================
             PROMO
        ========================== --}}
        <section class="promo" id="promo">

            <div class="container">

                <div class="promo-card">

                    <h2>
                        Belanja lebih mudah 🚀
                    </h2>

                    <p>
                        {{ $store->slogan ?? 'Belanja Hemat Cuan Nikmat' }}.
                        Hubungi {{ $store->nama_toko }}
                        untuk mendapatkan informasi produk dan pemesanan.
                    </p>

                    @if($store->whatsapp)

                        @php
                            $waNumber = preg_replace(
                                '/[^0-9]/',
                                '',
                                $store->whatsapp
                            );
                        @endphp

                        <a
                            href="https://wa.me/{{ $waNumber }}"
                            target="_blank"
                            class="btn"
                        >
                            💬 Hubungi WhatsApp
                        </a>

                    @else

                        <a
                            href="#produk"
                            class="btn"
                        >
                            🛍️ Lihat Produk
                        </a>

                    @endif

                </div>

            </div>

        </section>

    </main>


    {{-- =========================
         FOOTER
    ========================== --}}
    <footer>

        <div class="container">

            <div class="footer-grid">

                <div>

                    <div class="footer-title">
                        {{ $store->nama_toko }}
                    </div>

                    <p class="footer-text">
                        {{ $store->deskripsi ?? 'Temukan produk pilihan terbaik untuk kebutuhanmu.' }}
                    </p>

                </div>


                <div>

                    <div class="footer-title">
                        Informasi
                    </div>

                    <div class="footer-links">

                        @if($store->alamat)
                            <span class="footer-text">
                                📍 {{ $store->alamat }}
                            </span>
                        @endif

                        @if($store->email)
                            <a href="mailto:{{ $store->email }}">
                                ✉️ {{ $store->email }}
                            </a>
                        @endif

                        @if($store->whatsapp)
                            <a
                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $store->whatsapp) }}"
                                target="_blank"
                            >
                                💬 WhatsApp
                            </a>
                        @endif

                    </div>

                </div>


                <div>

                    <div class="footer-title">
                        Menu
                    </div>

                    <div class="footer-links">

                        <a href="#produk">
                            Produk
                        </a>

                        <a href="#kategori">
                            Kategori
                        </a>

                        <a href="#promo">
                            Promo
                        </a>

                        @if($store->instagram)
                            <a href="{{ $store->instagram }}" target="_blank">
                                📸 Instagram
                            </a>
                        @endif

                        @if($store->tiktok)
                            <a href="{{ $store->tiktok }}" target="_blank">
                                🎵 TikTok
                            </a>
                        @endif

                        <a href="{{ route('admin.login') }}">
                            🔐 Login Admin
                        </a>

                    </div>

                </div>

            </div>


            <div class="footer-bottom">

                <div>
                    © {{ date('Y') }}
                    {{ $store->nama_toko }}.
                    Semua hak dilindungi.
                </div>

                <div>
                    UMKM Digital
                </div>

            </div>

        </div>

    </footer>


    {{-- =========================
         FLOATING WHATSAPP
    ========================== --}}

    @if($store->whatsapp)

        @php
            $waNumber = preg_replace(
                '/[^0-9]/',
                '',
                $store->whatsapp
            );
        @endphp

        <a
            href="https://wa.me/{{ $waNumber }}"
            target="_blank"
            class="wa-floating"
            title="Chat WhatsApp"
        >
            💬
        </a>

    @endif


<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.category-filter');
    const products = document.querySelectorAll('.product-card');

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            const filter = this.dataset.filter.toLowerCase().trim();

            buttons.forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');

            products.forEach(function (product) {
                const categoryElement = product.querySelector('.product-category');

                if (!categoryElement) {
                    product.style.display = filter === 'semua' ? '' : 'none';
                    return;
                }

                const category = categoryElement.textContent
                    .toLowerCase()
                    .trim();

                let tampil = false;

                if (filter === 'semua') {
                    tampil = true;
                } else if (filter === 'terlaris') {
                    const featured = product.dataset.unggulan;

                    tampil = featured === '1' || featured === 'true';
                } else if (filter === 'premium') {
                    tampil = category.includes('premium');
                } else {
                    tampil = category === filter;
                }

                product.style.display = tampil ? '' : 'none';
            });
        });
    });
});
</script>

</body>
</html>
