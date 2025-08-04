# Deskripsi Use Case PoinMarket

## 1. Authentication Use Cases

### 1.1. Login
**Aktor**: Semua pengguna (Superadmin, Admin, Dosen, Mahasiswa)  
**Deskripsi**: Proses autentikasi pengguna ke dalam sistem  
**Pre-condition**: Pengguna memiliki akun yang terdaftar  
**Basic Flow**:
1. Pengguna memasukkan username dan password
2. Sistem memverifikasi kredensial
3. Sistem mengarahkan ke dashboard sesuai role

**Alternative Flow**:
- Jika kredensial salah, tampilkan pesan error
- Jika lupa password, arahkan ke halaman reset password

### 1.2. Manage Profile
**Aktor**: Semua pengguna  
**Deskripsi**: Pengelolaan informasi profil pengguna  
**Basic Flow**:
1. Pengguna mengakses halaman profil
2. Mengedit informasi personal
3. Mengubah password
4. Mengatur preferensi notifikasi

## 2. Superadmin Use Cases

### 2.1. Manage Users
**Aktor**: Superadmin  
**Deskripsi**: Pengelolaan seluruh pengguna sistem  
**Basic Flow**:
1. Menambah user baru
2. Mengubah data user
3. Menonaktifkan/mengaktifkan user
4. Mengatur role dan permissions
5. Reset password user

### 2.2. System Configuration
**Aktor**: Superadmin  
**Deskripsi**: Konfigurasi parameter sistem  
**Basic Flow**:
1. Mengatur parameter sistem
2. Konfigurasi keamanan
3. Pengaturan notifikasi
4. Manajemen backup
5. Konfigurasi integrasi

### 2.3. Monitor System
**Aktor**: Superadmin  
**Deskripsi**: Monitoring aktivitas dan performa sistem  
**Basic Flow**:
1. Melihat log aktivitas
2. Monitoring performa
3. Analisis penggunaan
4. Deteksi anomali
5. Generate laporan sistem

## 3. Admin Use Cases

### 3.1. Manage Products
**Aktor**: Admin  
**Deskripsi**: Pengelolaan produk di marketplace  
**Basic Flow**:
1. Menambah produk baru
2. Mengubah detail produk
3. Mengatur harga dan stok
4. Kategorisasi produk
5. Nonaktifkan/aktifkan produk

### 3.2. Manage Orders
**Aktor**: Admin  
**Deskripsi**: Pengelolaan transaksi marketplace  
**Basic Flow**:
1. Melihat daftar pesanan
2. Memproses pesanan baru
3. Update status pesanan
4. Penanganan refund
5. Generate laporan transaksi

### 3.3. Manage Inventory
**Aktor**: Admin  
**Deskripsi**: Pengelolaan stok produk  
**Basic Flow**:
1. Monitoring stok
2. Update stok
3. Stock opname
4. Alert stok minimum
5. Laporan inventory

## 4. Dosen Use Cases

### 4.1. Manage Points
**Aktor**: Dosen  
**Deskripsi**: Pengelolaan poin mahasiswa  
**Basic Flow**:
1. Pemberian poin
2. Pengurangan poin
3. Riwayat poin
4. Evaluasi aktivitas
5. Laporan poin

### 4.2. Manage Badges
**Aktor**: Dosen  
**Deskripsi**: Pengelolaan badge pencapaian  
**Basic Flow**:
1. Membuat badge baru
2. Menentukan kriteria
3. Memberikan badge
4. Monitoring pencapaian
5. Evaluasi badge

### 4.3. Evaluate Students
**Aktor**: Dosen  
**Deskripsi**: Evaluasi performa mahasiswa  
**Basic Flow**:
1. Input evaluasi
2. Review aktivitas
3. Penilaian pencapaian
4. Feedback
5. Laporan evaluasi

## 5. Mahasiswa Use Cases

### 5.1. View Wallet
**Aktor**: Mahasiswa  
**Deskripsi**: Manajemen saldo poin  
**Basic Flow**:
1. Cek saldo
2. Riwayat transaksi
3. Transfer poin
4. Analisis penggunaan
5. Notifikasi saldo

### 5.2. Shop Market
**Aktor**: Mahasiswa  
**Deskripsi**: Akses ke marketplace  
**Basic Flow**:
1. Browse produk
2. Tambah ke keranjang
3. Checkout
4. Pembayaran dengan poin
5. Track pesanan

### 5.3. Book Consultation
**Aktor**: Mahasiswa  
**Deskripsi**: Pemesanan konsultasi  
**Basic Flow**:
1. Pilih jadwal
2. Book konsultasi
3. Konfirmasi booking
4. Reminder konsultasi
5. Feedback setelah konsultasi

## 6. Common Use Cases

### 6.1. Notifications
**Aktor**: Semua pengguna  
**Deskripsi**: Sistem notifikasi  
**Basic Flow**:
1. Menerima notifikasi
2. Membaca notifikasi
3. Menandai sudah dibaca
4. Filter notifikasi
5. Pengaturan notifikasi

### 6.2. Search
**Aktor**: Semua pengguna  
**Deskripsi**: Pencarian dalam sistem  
**Basic Flow**:
1. Input kata kunci
2. Filter hasil
3. Sort hasil
4. Detail hasil
5. Riwayat pencarian
