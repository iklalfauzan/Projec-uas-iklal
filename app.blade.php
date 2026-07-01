<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ArtikelKu') - Portal Berita</title>

    {{-- TailwindCSS via CDN (untuk development; ganti dengan Vite untuk production) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f766e',   // teal-700
                        secondary: '#134e4a', // teal-900
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- ── Navbar ──────────────────────────────── --}}
    <nav class="bg-teal-700 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-white font-bold text-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-6-4h2" />
                    </svg>
                    ArtikelKu
                </a>

                {{-- Nav Links --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-teal-100 hover:text-white transition text-sm">Beranda</a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="text-teal-100 hover:text-white transition text-sm">Dashboard</a>
                        <a href="{{ route('articles.index') }}" class="text-teal-100 hover:text-white transition text-sm">Artikel Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-teal-600 hover:bg-teal-500 text-white text-sm px-4 py-2 rounded-lg transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-teal-100 hover:text-white transition text-sm">Login</a>
                        <a href="{{ route('register') }}" class="bg-white text-teal-700 hover:bg-teal-50 text-sm px-4 py-2 rounded-lg font-medium transition">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- ── Flash Messages ───────────────────────── --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- ── Main Content ─────────────────────────── --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ── Footer ───────────────────────────────── --}}
    <footer class="bg-teal-900 text-teal-300 text-center py-6 mt-8">
        <p class="text-sm">© {{ date('Y') }} ArtikelKu · Dibuat dengan Laravel & TailwindCSS</p>
    </footer>

    @stack('scripts')
</body>
</html>
