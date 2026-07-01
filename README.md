# ArtikelKu — Laravel 13 + TailwindCSS

Project website manajemen artikel dengan fitur CRUD, login, dan upload gambar.
Dibuat menggunakan **Laravel 13** dan **TailwindCSS**.

---

## ✅ Fitur
- Register & Login (Auth)
- Dashboard dengan statistik
- CRUD Artikel (Create, Read, Update, Delete)
- Upload gambar thumbnail
- Kategori artikel
- Halaman publik artikel
- Pagination
- Responsive design

---

## ⚙️ Cara Setup (Langkah demi Langkah)

### 1. Install Laravel 13
```bash
composer create-project laravel/laravel artikelku
cd artikelku
```

### 2. Salin File dari Project Ini
Salin semua file berikut ke project Laravel kamu:

| File sumber                             | Tujuan di project                        |
|-----------------------------------------|------------------------------------------|
| `routes/web.php`                        | `routes/web.php`                         |
| `app/Models/Article.php`               | `app/Models/Article.php`                |
| `app/Http/Controllers/ArticleController.php` | `app/Http/Controllers/`           |
| `app/Http/Controllers/AuthController.php`    | `app/Http/Controllers/`           |
| `database/migrations/..._articles.php` | `database/migrations/`                  |
| Semua file `resources/views/`          | `resources/views/`                       |

### 3. Setup Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=artikelku       # ← buat database ini di phpMyAdmin/MySQL
DB_USERNAME=root
DB_PASSWORD=                 # ← isi password MySQL kamu
```

### 4. Jalankan Migration
```bash
php artisan migrate
```

### 5. Buat Storage Link (untuk upload gambar)
```bash
php artisan storage:link
```

### 6. Jalankan Server
```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## 📁 Struktur Halaman

| URL                     | Keterangan                    |
|-------------------------|-------------------------------|
| `/`                     | Halaman publik semua artikel  |
| `/register`             | Daftar akun baru              |
| `/login`                | Masuk                         |
| `/dashboard`            | Dashboard (perlu login)       |
| `/articles`             | Daftar artikel saya           |
| `/articles/create`      | Buat artikel baru             |
| `/articles/{id}/edit`   | Edit artikel                  |
| `/artikel/{slug}`       | Detail artikel (publik)       |

---

## 🔧 Troubleshooting

**Error: Class 'Article' not found**
```bash
php artisan optimize:clear
```

**Gambar tidak tampil**
```bash
php artisan storage:link
```

**Error 500 saat pertama run**
```bash
php artisan key:generate
php artisan config:clear
```

---

## 📤 Push ke GitHub

```bash
git init
git add .
git commit -m "Initial commit: Laravel artikel CRUD"
git remote add origin https://github.com/USERNAME/artikelku.git
git push -u origin main
```

---

## 🎓 Catatan untuk UAS
- Project ini memenuhi semua syarat tugas: CRUD, Login, Upload Gambar, TailwindCSS
- Materi UAS berkaitan dengan project ini (routing, controller, model, migration, blade)
