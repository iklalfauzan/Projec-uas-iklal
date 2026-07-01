@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
{{-- Hero --}}
<div class="bg-gradient-to-br from-teal-800 to-teal-600 text-white py-16 px-4">
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-4xl sm:text-5xl font-bold leading-tight mb-4">Baca. Tulis. Berbagi.</h1>
        <p class="text-teal-100 text-lg mb-8">Platform artikel untuk semua orang. Temukan cerita dan pengetahuan terbaru.</p>
        @guest
        <div class="flex justify-center gap-3">
            <a href="{{ route('register') }}"
                class="bg-white text-teal-800 font-semibold px-6 py-3 rounded-xl hover:bg-teal-50 transition">
                Mulai Menulis
            </a>
            <a href="{{ route('login') }}"
                class="border border-white text-white font-semibold px-6 py-3 rounded-xl hover:bg-white/10 transition">
                Masuk
            </a>
        </div>
        @endguest
    </div>
</div>

{{-- Artikel Grid --}}
<div class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Artikel Terbaru</h2>

    @forelse($articles as $article)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 overflow-hidden flex flex-col sm:flex-row hover:shadow-md transition">
        @if($article->image)
            <div class="sm:w-52 sm:flex-shrink-0">
                <a href="{{ route('articles.show', $article->slug) }}">
                    <img src="{{ asset('storage/' . $article->image) }}"
                        class="w-full h-44 sm:h-full object-cover" alt="{{ $article->title }}">
                </a>
            </div>
        @endif

        <div class="p-5 flex flex-col justify-between flex-1">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs bg-teal-50 text-teal-700 px-2 py-0.5 rounded-full font-medium">
                        {{ $article->category }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $article->created_at->diffForHumans() }}</span>
                </div>
                <a href="{{ route('articles.show', $article->slug) }}">
                    <h3 class="text-lg font-semibold text-gray-900 hover:text-teal-700 transition mb-1">
                        {{ $article->title }}
                    </h3>
                </a>
                <p class="text-gray-500 text-sm line-clamp-2">
                    {{ Str::limit(strip_tags($article->content), 140) }}
                </p>
            </div>
            <div class="flex items-center gap-2 mt-4">
                <div class="w-6 h-6 bg-teal-200 rounded-full flex items-center justify-center text-xs font-bold text-teal-800">
                    {{ strtoupper(substr($article->user->name, 0, 1)) }}
                </div>
                <span class="text-sm text-gray-600">{{ $article->user->name }}</span>
                <span class="ml-auto">
                    <a href="{{ route('articles.show', $article->slug) }}"
                        class="text-sm text-teal-700 font-medium hover:underline">
                        Baca →
                    </a>
                </span>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-16">
        <p class="text-gray-400 text-lg">Belum ada artikel. Jadilah yang pertama!</p>
        <a href="{{ route('register') }}"
            class="inline-block mt-4 bg-teal-700 hover:bg-teal-600 text-white px-6 py-2.5 rounded-xl transition">
            Tulis Artikel
        </a>
    </div>
    @endforelse

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</div>
@endsection
