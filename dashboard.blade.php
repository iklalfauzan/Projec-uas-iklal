@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-500 text-sm mt-1">Halo, {{ auth()->user()->name }} 👋</p>
        </div>
        <a href="{{ route('articles.create') }}"
            class="inline-flex items-center gap-2 bg-teal-700 hover:bg-teal-600 text-white px-5 py-2.5 rounded-lg font-medium transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tulis Artikel
        </a>
    </div>

    {{-- Stats Card --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-teal-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-900">{{ $total }}</p>
                <p class="text-sm text-gray-500">Total Artikel</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->created_at->format('d M Y') }}</p>
                <p class="text-sm text-gray-500">Bergabung sejak</p>
            </div>
        </div>
    </div>

    {{-- Artikel Terbaru --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-gray-900">Artikel Terbaru</h2>
            <a href="{{ route('articles.index') }}" class="text-teal-700 text-sm hover:underline">Lihat semua →</a>
        </div>

        @forelse($latest as $article)
        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
            <div class="flex items-center gap-3">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}"
                        class="w-10 h-10 rounded-lg object-cover" alt="">
                @else
                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($article->title, 50) }}</p>
                    <p class="text-xs text-gray-400">{{ $article->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <span class="text-xs bg-teal-50 text-teal-700 px-2 py-1 rounded-full">{{ $article->category }}</span>
        </div>
        @empty
        <div class="text-center py-8">
            <p class="text-gray-400 text-sm">Belum ada artikel. Mulai tulis sekarang!</p>
            <a href="{{ route('articles.create') }}" class="inline-block mt-3 text-teal-700 text-sm font-medium hover:underline">
                + Tulis artikel pertama
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
