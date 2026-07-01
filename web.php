<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ── Public Routes ──────────────────────────────────────────
Route::get('/', [ArticleController::class, 'publicIndex'])->name('home');
Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// ── Auth Routes ────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── Dashboard & CRUD (Auth Required) ───────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $total = \App\Models\Article::where('user_id', auth()->id())->count();
        $latest = \App\Models\Article::where('user_id', auth()->id())->latest()->take(5)->get();
        return view('dashboard', compact('total', 'latest'));
    })->name('dashboard');

    Route::resource('articles', ArticleController::class)->except(['show']);
});
