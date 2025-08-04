# PoinMarket - Dokumentasi Sistem
## Sistem Manajemen Poin Akademik

### Daftar Isi
1. [Pendahuluan](#1-pendahuluan)
2. [Arsitektur Sistem](#2-arsitektur-sistem)
3. [Alur Proses Bisnis](#3-alur-proses-bisnis)
4. [Spesifikasi Teknis](#4-spesifikasi-teknis)
5. [Modul Sistem](#5-modul-sistem)
6. [Keamanan](#6-keamanan)

### 1. Pendahuluan
#### 1.1 Tentang PoinMarket
PoinMarket adalah sistem manajemen poin akademik yang dirancang untuk memfasilitasi dan mengelola transaksi poin mahasiswa dalam lingkungan akademik. Sistem ini memungkinkan mahasiswa untuk mengumpulkan poin melalui berbagai aktivitas akademik dan menukarkannya dengan berbagai manfaat.

#### 1.2 Tujuan Sistem
- Memotivasi prestasi akademik mahasiswa
- Mengelola sistem reward berbasis poin
- Memfasilitasi konsultasi akademik
- Menyediakan marketplace untuk penukaran poin
- Mencatat dan memantau aktivitas akademik

### 2. Arsitektur Sistem
#### 2.1 Presentation Layer
- **Web Interface**
  - HTML5
  - CSS3
  - Bootstrap 4
- **Mobile UI**
  - Responsive Design
  - Progressive Web App (PWA)
- **Admin Interface**
  - AdminLTE Template
  - Dashboard Komprehensif

#### 2.2 Application Layer
- **Authentication**
  - Myth/Auth
  - Session Management
- **Business Logic**
  - Controllers
  - Services
  - Helpers
- **API Services**
  - REST API
  - WebSocket
  - Middleware

#### 2.3 Core Modules
- **User Module**
  - Profile Management
  - Role Management
  - Access Control
- **Point Module**
  - Wallet Management
  - Transaction History
  - Point Rules
- **Market Module**
  - Product Catalog
  - Order Management
  - Cart System
- **Consultation Module**
  - Booking System
  - Chat System
  - Schedule Management

#### 2.4 Data Layer
- **Database**: MySQL/MariaDB
- **Cache**: Redis
- **Storage**: File System

### 3. Alur Proses Bisnis
#### 3.1 Manajemen Transaksi
##### Pembuatan Transaksi
1. Pilih Mahasiswa (NPM/Nama)
2. Pilih Jenis Transaksi:
   - Reward (101)
   - Misi (105)
   - Pembelian (102)
   - Hukuman (103)
   - Konsultasi (106)
3. Input Detail Transaksi
4. Validasi Admin
5. Notifikasi ke Admin dan Mahasiswa

##### Alur Poin
**Penambahan Poin:**
- Reward
  - Prestasi Akademik
  - Prestasi Non-Akademik
  - Keaktifan Organisasi
- Misi
  - Tugas Khusus
  - Project
  - Kegiatan Kampus

**Pengurangan Poin:**
- Pembelian
  - Barang/Merchandise
  - Voucher
  - Layanan
- Konsultasi
  - Konsultasi Akademik
  - Bimbingan Karir
  - Mentoring
- Hukuman
  - Pelanggaran Akademik
  - Pelanggaran Tata Tertib
  - Ketidakhadiran

#### 3.2 Pembuatan Item
1. Pilih Jenis Item
2. Input Detail Item
3. Validasi oleh Admin
4. Notifikasi ke Dosen

### 4. Spesifikasi Teknis
#### 4.1 Technology Stack
- **Backend**: PHP 7.4+ dengan CodeIgniter 4
- **Frontend**: 
  - HTML5
  - CSS3 dengan Bootstrap 4
  - JavaScript/jQuery
  - AJAX
- **Database**: MySQL/MariaDB
- **Development Tools**:
  - XAMPP
  - Git
  - Visual Studio Code
  - Postman

#### 4.2 Libraries & Frameworks
- AdminLTE
- DataTables
- SweetAlert2
- Chart.js

### 5. Modul Sistem
#### 5.1 Sistem Notifikasi
- Real-time notifications
- Multiple notification types
- Mark as read/unread
- Notification history
- Custom notification routing

#### 5.2 User Management
- Role-based access control
- User profiles
- Authentication & Authorization
- Session management

#### 5.3 Transaction Management
- Point tracking
- Transaction history
- Validation workflow
- Automatic notifications

### 6. Keamanan
#### 6.1 Security Measures
- Encryption
- Input validation
- XSS protection
- CSRF protection
- SQL injection prevention
- Rate limiting

#### 6.2 Audit System
- Activity logging
- Error tracking
- Access monitoring
- Performance monitoring

---
© 2025 PoinMarket Documentation
