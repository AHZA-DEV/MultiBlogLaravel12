# Aplikasi Blog Laravel - Dokumentasi Lengkap

## Deskripsi Aplikasi

Aplikasi Blog Laravel adalah platform blogging modern yang dibangun dengan Laravel 12 dan Bootstrap 5. Aplikasi ini menyediakan sistem manajemen konten lengkap dengan fitur autentikasi berbasis role, dashboard admin yang intuitif, dan tampilan blog public yang responsif.

## Preferensi Pengguna

Gaya komunikasi yang disukai: Bahasa sederhana sehari-hari dalam bahasa Indonesia.

## Use Case (Kasus Penggunaan)

### 1. Use Case Utama

#### UC-001: Pengunjung Membaca Blog
**Aktor**: Pengunjung (Guest User)
**Tujuan**: Membaca artikel blog yang tersedia
**Skenario**:
1. Pengunjung mengakses halaman utama (/)
2. Sistem menampilkan daftar artikel yang dipublikasi
3. Pengunjung melihat preview artikel (judul, excerpt, kategori, tags)
4. Pengunjung mengklik artikel untuk membaca selengkapnya
5. Sistem menampilkan artikel lengkap dengan konten markdown
6. Sistem mencatat view count artikel
7. Pengunjung dapat share artikel ke media sosial

#### UC-002: User Login ke Dashboard
**Aktor**: User (Admin/Regular User)
**Tujuan**: Mengakses dashboard untuk mengelola konten
**Skenario**:
1. User mengakses halaman login (/login)
2. User memasukkan email dan password
3. Sistem memvalidasi kredensial
4. Sistem redirect ke dashboard sesuai role
5. Dashboard menampilkan menu berdasarkan hak akses

#### UC-003: Admin Mengelola Artikel
**Aktor**: Admin
**Tujuan**: Membuat, mengedit, dan mengelola artikel blog
**Skenario**:
1. Admin login ke dashboard
2. Admin mengakses menu "Posts"
3. Admin dapat melihat daftar semua artikel
4. Admin dapat membuat artikel baru dengan editor markdown
5. Admin mengisi judul, konten, kategori, dan tags
6. Admin mempublikasi artikel
7. Artikel muncul di halaman public

#### UC-004: User Menulis Artikel
**Aktor**: Regular User
**Tujuan**: Menulis artikel blog
**Skenario**:
1. User login ke dashboard
2. User mengakses menu "Posts" (terbatas)
3. User dapat melihat artikel yang dibuatnya
4. User membuat artikel baru
5. Artikel tersimpan sebagai draft (perlu approval admin)

### 2. Use Case Pendukung

#### UC-005: Manajemen Kategori
- Admin dapat membuat, mengedit, dan menghapus kategori
- Setiap kategori memiliki nama, slug, dan deskripsi
- Artikel dapat dikaitkan dengan kategori

#### UC-006: Manajemen Tags
- Admin dan User dapat membuat tags
- Tags digunakan untuk menandai artikel
- Sistem mendukung multiple tags per artikel

#### UC-007: Manajemen Users (Admin Only)
- Admin dapat melihat daftar semua user
- Admin dapat mengubah role user
- Admin dapat menghapus user

## Flowchart Aplikasi

### 1. Alur Pengunjung Public

```
[START] 
   ↓
[Akses halaman utama (/)]
   ↓
[Tampilkan daftar artikel dengan pagination]
   ↓
[Pilih artikel untuk dibaca?] → Ya → [Tampilkan artikel lengkap] → [Increment view count] → [Tampilkan related posts]
   ↓ Tidak                         ↓
[Browse artikel lain]              [Share artikel ke sosmed?] → Ya → [Buka share dialog]
   ↓                               ↓ Tidak
[END]                             [Kembali ke daftar artikel] → [END]
```

### 2. Alur Autentikasi User

```
[START]
   ↓
[Akses /login]
   ↓
[Input email & password]
   ↓
[Validasi kredensial] → Invalid → [Tampilkan error] → [Kembali ke form login]
   ↓ Valid
[Check user role]
   ↓
[Role = Admin?] → Ya → [Redirect ke Dashboard Admin] → [Show full sidebar menu]
   ↓ Tidak              ↓
[Redirect ke Dashboard User] → [Show limited sidebar menu]
   ↓
[END]
```

### 3. Alur Manajemen Artikel (Admin)

```
[Admin Dashboard]
   ↓
[Klik menu "Posts"]
   ↓
[Tampilkan daftar semua artikel]
   ↓
[Pilih aksi] → [View] → [Tampilkan detail artikel]
   ↓          [Edit] → [Form edit artikel] → [Update artikel]
   ↓          [Delete] → [Konfirmasi hapus] → [Hapus artikel]
[Create New Post]
   ↓
[Form artikel baru]
   ↓
[Input: Judul, Konten (Markdown), Kategori, Tags, Status]
   ↓
[Validasi form] → Invalid → [Tampilkan error]
   ↓ Valid
[Simpan artikel]
   ↓
[Status = Published?] → Ya → [Artikel muncul di public]
   ↓ Tidak                  ↓
[Simpan sebagai draft]     [Send notification]
   ↓                       ↓
[END]                     [END]
```

### 4. Alur User Menulis Artikel

```
[User Dashboard]
   ↓
[Klik menu "Posts"]
   ↓
[Tampilkan artikel user saja]
   ↓
[Create New Post]
   ↓
[Form artikel baru]
   ↓
[Input: Judul, Konten, Kategori, Tags]
   ↓
[Validasi form] → Invalid → [Tampilkan error]
   ↓ Valid
[Simpan sebagai draft]
   ↓
[Notifikasi: "Artikel perlu approval admin"]
   ↓
[END]
```

## Arsitektur Sistem

### Backend Framework
Aplikasi dibangun dengan Laravel 12 yang menyediakan:
- **Arsitektur MVC**: Pemisahan yang jelas antara Model, View, dan Controller
- **Eloquent ORM**: Abstraksi database untuk manajemen data
- **Artisan CLI**: Interface command-line untuk tugas development
- **Service Container**: Dependency injection untuk manajemen class dependencies
- **Middleware Pipeline**: Filtering dan processing request/response
- **Routing Engine**: RESTful routing dengan parameter binding dan middleware

### Frontend Architecture
Frontend menggunakan pendekatan kompilasi asset modern:
- **Vite Build Tool**: Server development cepat dan build production yang optimal
- **Bootstrap 5**: Framework CSS yang responsive dan component-based
- **Bootstrap Icons**: Icon library yang konsisten
- **JavaScript Modules**: Sistem module ES6+ dengan hot module replacement
- **Asset Pipeline**: Pemrosesan otomatis CSS dan JavaScript

### Database Layer
Aplikasi dikonfigurasi untuk berbagai opsi database:
- **Migration System**: Manajemen schema database dengan version control
- **Seeder Support**: Populasi database untuk development dan testing
- **Query Builder**: Interface fluent untuk operasi database
- **Connection Management**: Dukungan untuk multiple koneksi database

### UI Components
Interface dashboard meliputi:
- **Responsive Design**: Pendekatan mobile-first dengan Bootstrap 5
- **Navigation System**: Sidebar dinamis berdasarkan role user
- **Interactive Elements**: Fungsi dashboard yang didukung JavaScript
- **Component Architecture**: Komponen UI yang dapat digunakan ulang

## Struktur Database

### Tabel Users
```sql
- id (Primary Key)
- name (varchar)
- email (varchar, unique)
- email_verified_at (timestamp)
- password (varchar, hashed)
- role (enum: admin, user)
- bio (text, nullable)
- created_at, updated_at (timestamps)
```

### Tabel Categories
```sql
- id (Primary Key)
- name (varchar)
- slug (varchar, unique)
- description (text, nullable)
- created_by (Foreign Key → users.id)
- created_at, updated_at (timestamps)
```

### Tabel Tags
```sql
- id (Primary Key)
- name (varchar)
- slug (varchar, unique)
- description (text, nullable)
- created_by (Foreign Key → users.id)
- created_at, updated_at (timestamps)
```

### Tabel Posts
```sql
- id (Primary Key)
- title (varchar)
- slug (varchar, unique)
- excerpt (text)
- content (longtext, markdown)
- author_id (Foreign Key → users.id)
- category_id (Foreign Key → categories.id)
- status (enum: draft, published)
- views (integer, default 0)
- published_at (timestamp, nullable)
- created_at, updated_at (timestamps)
```

### Tabel Post_Tag (Many-to-Many)
```sql
- post_id (Foreign Key → posts.id)
- tag_id (Foreign Key → tags.id)
- Primary Key: (post_id, tag_id)
```

## Sistem Role dan Permissions

### Role Admin
**Akses Dashboard**:
- ✅ Users Management (CRUD)
- ✅ Categories Management (CRUD)
- ✅ Posts Management (CRUD semua post)
- ✅ Tags Management (CRUD)
- ✅ View all statistics

**Akses Public**:
- ✅ Baca semua artikel
- ✅ Share artikel
- ✅ Comment (jika diimplementasi)

### Role User
**Akses Dashboard**:
- ❌ Users Management
- ❌ Categories Management
- ✅ Posts Management (hanya post sendiri)
- ✅ Tags Management (CRUD)
- ✅ View personal statistics

**Akses Public**:
- ✅ Baca semua artikel
- ✅ Share artikel
- ✅ Comment (jika diimplementasi)

### Guest (Non-authenticated)
**Akses**:
- ✅ Baca artikel public
- ✅ Share artikel
- ✅ Search artikel (jika diimplementasi)
- ❌ Akses dashboard

## Dependencies Eksternal

### Core Framework Dependencies
- **Laravel Framework**: Framework web utama untuk routing, ORM, templating, dan autentikasi
- **Laravel Tinker**: Shell interaktif untuk debugging dan testing aplikasi
- **Laravel Prompts**: Handling input command-line dengan validasi
- **Laravel Serializable Closure**: Serialisasi closure yang aman untuk job queues

### HTTP dan Networking
- **Guzzle HTTP**: Library HTTP client untuk komunikasi API eksternal
- **PSR-7 Implementation**: Interface standar untuk HTTP message
- **Fruitcake CORS**: Middleware Cross-Origin Resource Sharing

### Frontend Build Tools
- **Vite**: Build tool modern dengan hot module replacement
- **Laravel Vite Plugin**: Integrasi Laravel untuk kompilasi asset Vite
- **Bootstrap 5**: Framework CSS yang responsive dan component-based
- **Bootstrap Icons**: Icon library untuk interface
- **Axios**: HTTP client berbasis promise untuk browser requests

### Utility Libraries
- **Carbon**: Library manipulasi tanggal dan waktu
- **Monolog**: Solusi logging yang komprehensif
- **Ramsey UUID**: Generasi dan validasi UUID
- **Doctrine Inflector**: Manipulasi string untuk pluralisasi
- **League CommonMark**: Parsing dan rendering Markdown
- **League Flysystem**: Layer abstraksi filesystem

### Development dan Testing
- **Faker**: Generasi data testing
- **Mockery**: Framework test doubles dan mocking
- **Collision**: Interface error reporting dan debugging
- **Laravel Pail**: Viewing dan monitoring log

## Konfigurasi Environment

### Environment Variables Utama
```env
# Aplikasi
APP_NAME="Laravel Blog"
APP_ENV=local
APP_DEBUG=true
APP_URL=https://your-replit-url.com

# Database
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file

# Vite (Development)
VITE_APP_NAME="${APP_NAME}"
```

### Konfigurasi Replit
Konfigurasi deployment:
- **Workflow**: Menggunakan workflow "Laravel App" yang dikonfigurasi untuk menjalankan Laravel server dan Vite
- **Environment Variables**: Dikonfigurasi langsung dalam workflow command
- **Database**: SQLite file di database/database.sqlite

## Testing dan Quality Assurance

### Test Accounts
```
Admin Test Account:
- Email: admin@example.com
- Password: password123
- Role: admin

User Test Account:
- Email: user@example.com
- Password: password123
- Role: user
```

### Sample Data
Aplikasi include data sample untuk testing:
- **2 Kategori**: Technology, Business
- **3 Tags**: Web Development, Laravel, Startup
- **3 Artikel**: Konten lengkap dengan markdown formatting

### Testing Checklist
- [ ] Login/Logout functionality
- [ ] Role-based dashboard access
- [ ] Article CRUD operations
- [ ] Public blog display
- [ ] Markdown rendering
- [ ] View tracking
- [ ] Responsive design
- [ ] Social sharing

## Deployment dan Production

### Replit Deployment
- Running melalui workflow yang dikonfigurasi
- Environment variables dikonfigurasi dalam workflow command
- Database SQLite untuk development
- SSL/HTTPS otomatis tersedia

### Local Development
```bash
# Clone repository
git clone <repository-url>
cd laravel-blog

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate
php artisan db:seed

# Start development
npm run dev
php artisan serve
```

## Troubleshooting

### Common Issues

#### 1. Database Error
**Problem**: Migration atau seeding gagal
**Solution**: 
- Pastikan file database.sqlite ada di folder database/
- Jalankan `php artisan migrate:fresh --seed`

#### 2. Asset Loading Error
**Problem**: CSS/JS tidak load
**Solution**:
- Pastikan Vite running (`npm run dev`)
- Check environment variables APP_URL

#### 3. Permission Error
**Problem**: File permission error
**Solution**:
- Set permission folder storage: `chmod -R 755 storage`
- Set permission folder bootstrap/cache: `chmod -R 755 bootstrap/cache`

### Debug Mode
Untuk debugging, aktifkan:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

## Roadmap dan Future Features

### Phase 1 (Completed)
- ✅ Basic authentication system
- ✅ Role-based dashboard
- ✅ Article management (CRUD)
- ✅ Public blog with markdown support
- ✅ Categories and tags system

### Phase 2 (Planned)
- [ ] Comment system
- [ ] Article search functionality  
- [ ] User profile management
- [ ] Email notifications
- [ ] Theme system (light/dark mode)

### Phase 3 (Future)
- [ ] API endpoints for mobile app
- [ ] Advanced editor (WYSIWYG)
- [ ] Multi-language support
- [ ] SEO optimization
- [ ] Analytics dashboard

## Kontribusi dan Development

### Git Workflow
1. Fork repository
2. Create feature branch: `git checkout -b feature/amazing-feature`
3. Commit changes: `git commit -m 'Add amazing feature'`
4. Push branch: `git push origin feature/amazing-feature`
5. Create Pull Request

### Code Standards
- Follow PSR-12 coding standards
- Use Laravel best practices
- Write meaningful commit messages
- Add comments for complex logic
- Test before pushing

### Support dan Dokumentasi
- GitHub Issues untuk bug reports
- Documentation di README.md
- Code comments dalam bahasa Inggris
- User-facing messages dalam bahasa Indonesia

---

**Aplikasi ini siap digunakan untuk kebutuhan blogging modern dengan fitur lengkap dan interface yang user-friendly! 🚀**