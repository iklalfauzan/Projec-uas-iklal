@extends('layouts.app')
@section('title', 'Edit Artikel')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-800 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Edit Artikel</h1>
    </div>

    <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data"
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('title') border-red-400 @enderror">
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
            <select name="category" required
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                @foreach(['Teknologi', 'Pendidikan', 'Kesehatan', 'Olahraga', 'Hiburan', 'Bisnis', 'Gaya Hidup', 'Umum'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $article->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        {{-- Gambar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Thumbnail</label>
            @if($article->image)
                <div class="mb-3">
                    <p class="text-xs text-gray-500 mb-2">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $article->image) }}"
                        class="h-32 rounded-lg object-cover" id="imagePreview" alt="">
                </div>
            @else
                <img id="imagePreview" src="" class="hidden h-32 rounded-lg object-cover mb-2" alt="">
            @endif

            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-teal-400 transition">
                <input type="file" name="image" id="imageInput" accept="image/*"
                    class="hidden" onchange="previewImage(event)">
                <label for="imageInput" class="cursor-pointer text-sm text-teal-700 hover:underline">
                    Ganti gambar (opsional)
                </label>
                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP · Maks 2MB</p>
            </div>
        </div>

        {{-- Konten --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Isi Artikel <span class="text-red-500">*</span></label>
            <textarea name="content" rows="10" required
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 resize-y">{{ old('content', $article->content) }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-teal-700 hover:bg-teal-600 text-white font-semibold px-6 py-2.5 rounded-lg transition">
                Simpan Perubahan
            </button>
            <a href="{{ route('articles.index') }}"
                class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('imagePreview');
            img.src = e.target.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
@endsection
