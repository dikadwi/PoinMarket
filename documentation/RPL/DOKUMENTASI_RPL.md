# Dokumentasi Rekayasa Perangkat Lunak PoinMarket

## 1. Pendahuluan

### 1.1 Tujuan
Dokumen ini bertujuan untuk memberikan gambaran komprehensif tentang sistem PoinMarket, sebuah aplikasi manajemen poin dan marketplace untuk lingkungan akademik.

### 1.2 Ruang Lingkup
PoinMarket adalah sistem yang memungkinkan manajemen poin mahasiswa, transaksi marketplace, dan evaluasi akademik dalam satu platform terintegrasi.

### 1.3 Definisi dan Akronim
- PM: PoinMarket
- RPL: Rekayasa Perangkat Lunak
- CRUD: Create, Read, Update, Delete
- API: Application Programming Interface

## 2. Deskripsi Umum Sistem

### 2.1 Perspektif Produk
PoinMarket adalah sistem mandiri yang mengintegrasikan manajemen poin akademik dengan marketplace. Sistem ini dirancang untuk berjalan di lingkungan web dengan arsitektur client-server.

### 2.2 Fungsi Produk
1. Manajemen User (4 Role)
   - Superadmin: Akses penuh ke semua fitur
   - Admin: Manajemen produk dan transaksi
   - Dosen: Manajemen poin dan evaluasi
   - Mahasiswa: Akses marketplace dan wallet

2. Sistem Poin
   - Pemberian poin oleh dosen
   - Penggunaan poin di marketplace
   - Riwayat transaksi poin

3. Marketplace
   - Katalog produk
   - Sistem transaksi
   - Manajemen stok

4. Sistem Notifikasi
   - Notifikasi real-time
   - Riwayat notifikasi
   - Status transaksi

### 2.3 Karakteristik Pengguna
1. Superadmin
   - Staf IT atau administrator sistem
   - Memahami manajemen sistem
   - Akses penuh ke konfigurasi

2. Admin
   - Staf administrasi
   - Fokus pada operasional harian
   - Manajemen marketplace

3. Dosen
   - Tenaga pengajar
   - Evaluasi akademik
   - Pemberian poin

4. Mahasiswa
   - Pengguna akhir
   - Menggunakan poin
   - Akses marketplace

## 3. Arsitektur Sistem

### 3.1 Arsitektur Teknologi
- Backend: PHP 7.4+ dengan CodeIgniter 4
- Frontend: HTML5, CSS3, Bootstrap 4, JavaScript/jQuery
- Database: MySQL/MariaDB
- Tools: XAMPP, Git, Visual Studio Code

### 3.2 Komponen Sistem
1. Frontend Layer
   - User Interface (AdminLTE)
   - JavaScript (jQuery/AJAX)
   - View Templates

2. Backend Layer
   - Controllers
   - Models
   - Business Logic

3. Data Layer
   - Database
   - Cache System

## 4. Desain Detail

### 4.1 Database Schema
[Lihat diagram/database_schema.dot]

### 4.2 API Endpoints
1. Autentikasi
   - POST /auth/login
   - POST /auth/logout
   - POST /auth/reset-password

2. Manajemen Poin
   - GET /points/balance
   - POST /points/transfer
   - GET /points/history

3. Marketplace
   - GET /products
   - POST /transactions
   - GET /transactions/history

4. Notifikasi
   - GET /notifications
   - POST /notifications/mark-read
   - GET /notifications/unread

## 5. Implementasi

### 5.1 Struktur Direktori
```
PoinMarket/
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── public/
│   ├── assets/
│   └── uploads/
└── documentation/
```

### 5.2 Panduan Deployment
1. Persyaratan Sistem
   - PHP 7.4+
   - MySQL/MariaDB
   - Web Server (Apache/Nginx)

2. Langkah Instalasi
   - Konfigurasi database
   - Setting environment
   - Migrasi database
   - Konfigurasi web server

## 6. Pengujian

### 6.1 Strategi Pengujian
1. Unit Testing
   - Komponen individual
   - Fungsi-fungsi utama

2. Integration Testing
   - Antar modul
   - API endpoints

3. System Testing
   - End-to-end testing
   - User acceptance

### 6.2 Test Cases
[Dokumen terpisah: test_cases.md]

## 7. Pemeliharaan

### 7.1 Panduan Pemeliharaan
1. Backup rutin database
2. Monitoring sistem
3. Update security patches
4. Performance optimization

### 7.2 Troubleshooting
1. Error logging
2. Debug mode
3. Common issues

## 8. Lampiran

### 8.1 Diagram
- Use Case Diagram
- Class Diagram
- Sequence Diagram
- Component Diagram

### 8.2 API Documentation
[Dokumen terpisah: api_documentation.md]

### 8.3 User Manual
[Dokumen terpisah: user_manual.md]
