<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Crypto Lab')</title>
    <meta name="description" content="Website pembelajaran algoritma kriptografi Hash, RSA, DES, dan GOST.">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}?v={{ filemtime(public_path('assets/css/app.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-animations.css') }}?v={{ filemtime(public_path('assets/css/dashboard-animations.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hover-fix.css') }}?v={{ filemtime(public_path('assets/css/hover-fix.css')) }}">
</head>

<body>
    <header class="site-header" data-site-header>
        <nav class="top-nav" aria-label="Navigasi utama">
            <button
                class="nav-toggle"
                type="button"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
                data-nav-toggle
            >
                MENU
            </button>

            <a
                href="{{ route('home') }}"
                class="wordmark {{ request()->routeIs('home') ? 'is-active' : '' }}"
                aria-label="Crypto Lab"
                @if (request()->routeIs('home')) aria-current="page" @endif
            >
                CRYPTO LAB
            </a>

            <nav class="desktop-nav" aria-label="Navigasi modul">
                <a
                    href="{{ route('hash') }}"
                    class="{{ request()->routeIs('hash') ? 'is-active' : '' }}"
                    @if (request()->routeIs('hash')) aria-current="page" @endif
                >HASH</a>
                <a
                    href="{{ route('rsa') }}"
                    class="{{ request()->routeIs('rsa') ? 'is-active' : '' }}"
                    @if (request()->routeIs('rsa')) aria-current="page" @endif
                >RSA</a>
                <a
                    href="{{ route('des') }}"
                    class="{{ request()->routeIs('des') ? 'is-active' : '' }}"
                    @if (request()->routeIs('des')) aria-current="page" @endif
                >DES</a>
                <a
                    href="{{ route('gost') }}"
                    class="{{ request()->routeIs('gost') ? 'is-active' : '' }}"
                    @if (request()->routeIs('gost')) aria-current="page" @endif
                >GOST</a>
            </nav>

            <a
                href="{{ route('about') }}"
                class="nav-action {{ request()->routeIs('about') ? 'is-active' : '' }}"
                @if (request()->routeIs('about')) aria-current="page" @endif
            >
                ABOUT
            </a>
        </nav>

        <div class="mobile-nav" data-mobile-nav>
            <a
                href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'is-active' : '' }}"
                @if (request()->routeIs('home')) aria-current="page" @endif
            >BERANDA</a>
            <a
                href="{{ route('hash') }}"
                class="{{ request()->routeIs('hash') ? 'is-active' : '' }}"
                @if (request()->routeIs('hash')) aria-current="page" @endif
            >HASH</a>
            <a
                href="{{ route('rsa') }}"
                class="{{ request()->routeIs('rsa') ? 'is-active' : '' }}"
                @if (request()->routeIs('rsa')) aria-current="page" @endif
            >RSA</a>
            <a
                href="{{ route('des') }}"
                class="{{ request()->routeIs('des') ? 'is-active' : '' }}"
                @if (request()->routeIs('des')) aria-current="page" @endif
            >DES</a>
            <a
                href="{{ route('gost') }}"
                class="{{ request()->routeIs('gost') ? 'is-active' : '' }}"
                @if (request()->routeIs('gost')) aria-current="page" @endif
            >GOST</a>
            <a
                href="{{ route('about') }}"
                class="{{ request()->routeIs('about') ? 'is-active' : '' }}"
                @if (request()->routeIs('about')) aria-current="page" @endif
            >TENTANG</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-grid">
            <div>
                <p class="footer-label">PROJECT</p>
                <p>Website pembelajaran Kriptografi berbasis Laravel untuk simulasi algoritma Hash, RSA, DES, dan GOST.
                </p>
            </div>

            <div>
                <p class="footer-label">MODULES</p>
                <a href="{{ route('hash') }}">Hash</a>
                <a href="{{ route('rsa') }}">RSA</a>
                <a href="{{ route('des') }}">DES</a>
                <a href="{{ route('gost') }}">GOST</a>
            </div>

            <div>
                <p class="footer-label">STACK</p>
                <p>Laravel</p>
                <p>Blade</p>
                <p>Custom CSS</p>
            </div>

            <div>
                <p class="footer-label">COURSE</p>
                <p>Mata Kuliah Kriptografi</p>
                <p>UAS Project</p>
            </div>
        </div>

        <div class="footer-bottom">
            <span>CRYPTO LAB</span>
            <span>© {{ date('Y') }}</span>
        </div>
    </footer>

    <button class="back-to-top" type="button" aria-label="Kembali ke atas halaman" data-back-to-top>
        <span aria-hidden="true">↑</span>
    </button>

    <script src="{{ asset('assets/js/app.js') }}?v={{ filemtime(public_path('assets/js/app.js')) }}"></script>
    <script src="{{ asset('assets/js/hover-fix.js') }}?v={{ filemtime(public_path('assets/js/hover-fix.js')) }}"></script>
</body>

</html>
