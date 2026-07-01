@extends('layouts.app')
@section('title', 'Tulis Artikel')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-800 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Tulis Artikel Baru</h1>
    </div>

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data"
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        @csrf

        {{-- Judul --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('title') border-red-400 @enderror"
                placeholder="Judul yang menarik...">
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
                    <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        {{-- Upload Gambar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Thumbnail</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-teal-400 transition"
                id="dropzone">
                <input type="file" name="image" id="imageInput" accept="image/*"
                    class="hidden" onchange="previewImage(event)">
                <div id="previewContainer" class="hidden mb-3">
                    <img id="imagePreview" src="" class="max-h-40 mx-auto rounded-lg object-cover" alt="">
                </div>
                <label for="imageInput" class="cursor-pointer">
                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP · Maks 2MB</p>
                </label>
            </div>
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konten --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Isi Artikel <span class="text-red-500">*</span></label>
            <textarea name="content" rows="10" required
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 resize-y @error('content') border-red-400 @enderror"
                placeholder="Tulis isi artikel di sini...">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-teal-700 hover:bg-teal-600 text-white font-semibold px-6 py-2.5 rounded-lg transition">
                Publikasikan Artikel
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
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('previewContainer').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
@endsection
