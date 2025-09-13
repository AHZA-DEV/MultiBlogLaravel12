# Laravel Blog Application

Aplikasi blog modern yang dibangun dengan Laravel 12 dan Bootstrap 5. Fitur lengkap dengan sistem autentikasi berbasis role, dashboard admin, dan blog public yang responsif.

## ✨ Fitur Utama

### 🔐 Sistem Autentikasi
- Login dan logout dengan validasi
- Dashboard berbasis role (Admin vs User)
- Sistem middleware untuk proteksi route

### 👥 Manajemen User dan Role
- **Admin**: Akses penuh ke semua fitur (Users, Categories, Posts, Tags)
- **User**: Akses terbatas (Posts dan Tags saja)
- Dynamic sidebar berdasarkan role

### 📝 Manajemen Blog
- **Posts**: CRUD artikel dengan editor markdown
- **Categories**: Kategori artikel dengan slug otomatis
- **Tags**: System tagging untuk artikel
- **Views tracking**: Pencatatan jumlah pembaca

### 🌐 Blog Public
- **Landing page**: Tampilan semua artikel dengan pagination
- **Detail post**: Artikel lengkap dengan markdown rendering
- **Related posts**: Artikel terkait berdasarkan kategori
- **Social sharing**: Tombol share media sosial
- **Responsive design**: Optimal di semua device

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12.0 (PHP 8.2+)
- **Frontend**: Bootstrap 5.3 + Bootstrap Icons
- **Database**: SQLite (development)
- **Build Tool**: Vite
- **Package Manager**: Composer & NPM

## 📋 Persyaratan Sistem

### Local Development
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- SQLite

### Replit Environment
- Sudah terinclude semua dependency yang diperlukan

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/laravel-blog.git
cd laravel-blog
```

### 2. Instalasi untuk Local Development

#### Install PHP Dependencies
```bash
composer install
```

#### Install Node Dependencies
```bash
npm install
```

#### Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

#### Setup Database
```bash
php artisan migrate
php artisan db:seed
```

#### Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

#### Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

### 3. Instalasi untuk Replit

1. **Fork/Import** repository ini ke Replit
2. **Install Node Dependencies**:
   ```bash
   npm install
   ```
3. **Setup Database**: Buat file database SQLite
   ```bash
   touch database/database.sqlite
   ```
4. **Run Migrations & Seeding**:
   ```bash
   php artisan migrate --seed
   ```
5. **Start Application**: Klik tombol "Run" atau jalankan workflow yang sudah dikonfigurasi

Workflow akan otomatis menjalankan Laravel server di port 5000 dengan Vite untuk development. Environment variables sudah dikonfigurasi dalam workflow command.

## 🗄️ Database Seeding

Aplikasi include sample data untuk testing:

### Test Accounts
```
Admin:
Email: admin@example.com
Password: password123

User: 
Email: user@example.com  
Password: password123
```

### Sample Content
- 2 Kategori (Technology, Business)
- 3 Tags (Web Development, Laravel, Startup)
- 3 Artikel lengkap dengan konten markdown

### Manual Seeding
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=PostSeeder
```

## 📖 Cara Penggunaan

### 1. Akses Public Blog
- Kunjungi `/` untuk melihat semua artikel
- Klik artikel untuk membaca konten lengkap
- Gunakan navigasi untuk pindah antar halaman

### 2. Login ke Dashboard
- Kunjungi `/login`
- Gunakan kredensial test account
- Dashboard akan menampilkan menu sesuai role

### 3. Manajemen Konten (Admin)
- **Users**: Kelola pengguna dan role
- **Categories**: Buat dan edit kategori
- **Posts**: Tulis dan publish artikel
- **Tags**: Kelola tag artikel

### 4. Konten Creation (User)
- **Posts**: Tulis artikel (dapat publish langsung)
- **Tags**: Buat tag baru

## 🏗️ Struktur Aplikasi

```
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # Autentikasi
│   │   ├── DashboardController.php # Dashboard
│   │   └── WelcomeController.php   # Public blog
│   └── Models/
│       ├── User.php               # User model
│       ├── Post.php               # Post model
│       ├── Category.php           # Category model
│       └── Tag.php                # Tag model
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php          # Main layout
│   │   ├── sidebar.blade.php      # Sidebar component
│   │   └── navbar.blade.php       # Navbar component
│   ├── auth/                      # Auth views
│   ├── dashboard/                 # Dashboard views
│   ├── post/
│   │   └── show.blade.php         # Post detail view
│   └── welcome.blade.php          # Landing page
└── database/
    ├── migrations/                # Database migrations
    └── seeders/                   # Database seeders
```

## 🔧 Konfigurasi

### Environment Variables Penting
```env
APP_NAME="Laravel Blog"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
```

### Replit Configuration
Workflow sudah dikonfigurasi untuk:
- Menjalankan Laravel server di port 5000
- Menggunakan Vite untuk asset compilation
- Environment variables untuk Replit

## 🤝 Kontribusi

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.

## 🐛 Bug Reports

Jika menemukan bug atau issue, silakan buat [GitHub Issue](https://github.com/username/laravel-blog/issues) dengan detail:
- Environment (local/Replit)
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (jika perlu)

## 📞 Support

- GitHub Issues: [https://github.com/username/laravel-blog/issues](https://github.com/username/laravel-blog/issues)
- Documentation: [README.md](README.md)

---

**Happy Coding! 🚀**