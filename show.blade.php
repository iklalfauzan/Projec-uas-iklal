@extends('layouts.app')
@section('title', $article->title)

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-800 transition mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Gambar --}}
        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}"
                class="w-full h-64 object-cover" alt="{{ $article->title }}">
        @endif

        <div class="p-6 sm:p-8">
            {{-- Meta --}}
            <div class="flex items-center gap-3 mb-4">
                <span class="text-xs bg-teal-50 text-teal-700 px-3 py-1 rounded-full font-medium">
                    {{ $article->category }}
                </span>
                <span class="text-sm text-gray-400">
                    {{ $article->created_at->format('d M Y') }}
                </span>
                <span class="text-sm text-gray-400">·</span>
                <span class="text-sm text-gray-500">
                    oleh <span class="font-medium text-gray-700">{{ $article->user->name }}</span>
                </span>
            </div>

            {{-- Judul --}}
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight mb-6">
                {{ $article->title }}
            </h1>

            {{-- Konten --}}
            <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $article->content }}
            </div>
        </div>
    </article>

    {{-- Edit button untuk pemilik --}}
    @auth
        @if(auth()->id() === $article->user_id)
        <div class="flex gap-3 mt-6">
            <a href="{{ route('articles.edit', $article) }}"
                class="inline-flex items-center gap-2 bg-teal-700 hover:bg-teal-600 text-white px-5 py-2.5 rounded-lg font-medium transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Artikel
            </a>
            <form method="POST" action="{{ route('articles.destroy', $article) }}"
                onsubmit="return confirm('Yakin hapus artikel ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 px-5 py-2.5 rounded-lg font-medium transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
        @endif
    @endauth
</div>
@endsection
