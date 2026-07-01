<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // Tampilkan semua artikel milik user yang login
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    // Halaman tambah artikel
    public function create()
    {
        return view('articles.create');
    }

    // Simpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'required|string|max:100',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        Article::create([
            'user_id'  => Auth::id(),
            'title'    => $request->title,
            'content'  => $request->content,
            'category' => $request->category,
            'image'    => $imagePath,
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Detail satu artikel
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // Halaman edit artikel
    public function edit(Article $article)
    {
        // Hanya pemilik yang bisa edit
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        return view('articles.edit', compact('article'));
    }

    // Simpan perubahan artikel
    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'required|string|max:100',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        $article->update([
            'title'    => $request->title,
            'content'  => $request->content,
            'category' => $request->category,
            'image'    => $imagePath,
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    // Hapus artikel
    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    // Halaman publik semua artikel
    public function publicIndex()
    {
        $articles = Article::with('user')->latest()->paginate(9);
        return view('articles.public', compact('articles'));
    }
}
