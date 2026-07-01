@extends('layouts.app')
@section('title', 'Artikel Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Artikel Saya</h1>
        <a href="{{ route('articles.create') }}"
            class="inline-flex items-center gap-2 bg-teal-700 hover:bg-teal-600 text-white px-5 py-2.5 rounded-lg font-medium transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tulis Artikel Baru
        </a>
    </div>

    @forelse($articles as $article)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 overflow-hidden flex flex-col sm:flex-row">
        {{-- Gambar --}}
        @if($article->image)
            <div class="sm:w-48 sm:flex-shrink-0">
                <img src="{{ asset('storage/' . $article->image) }}"
                    class="w-full h-40 sm:h-full object-cover" alt="{{ $article->title }}">
            </div>
        @endif

        {{-- Konten --}}
        <div class="p-5 flex flex-col justify-between flex-1">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs bg-teal-50 text-teal-700 px-2 py-0.5 rounded-full font-medium">
                        {{ $article->category }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $article->created_at->format('d M Y') }}</span>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 mb-1">{{ $article->title }}</h2>
                <p class="text-gray-500 text-sm line-clamp-2">{{ Str::limit(strip_tags($article->content), 120) }}</p>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 mt-4">
                <a href="{{ route('articles.show', $article->slug) }}"
                    class="text-sm text-teal-700 hover:underline font-medium">
                    Lihat
                </a>
                <a href="{{ route('articles.edit', $article) }}"
                    class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg transition">
                    Edit
                </a>
                <form method="POST" action="{{ route('articles.destroy', $article) }}"
                    onsubmit="return confirm('Yakin hapus artikel ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-sm bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl border border-dashed border-gray-200 p-12 text-center">
        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p class="text-gray-500 mb-3">Belum ada artikel yang kamu tulis.</p>
        <a href="{{ route('articles.create') }}"
            class="inline-block bg-teal-700 hover:bg-teal-600 text-white text-sm px-5 py-2 rounded-lg transition">
            Tulis Artikel Pertama
        </a>
    </div>
    @endforelse

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
@endsection
