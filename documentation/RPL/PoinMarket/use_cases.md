# Use Cases PoinMarket

## 1. Superadmin Use Cases

### UC-SA01: Manajemen User
- **Aktor**: Superadmin
- **Deskripsi**: Mengelola semua user dalam sistem
- **Pre-condition**: Login sebagai superadmin
- **Flow**:
  1. Menambah user baru
  2. Mengubah data user
  3. Menghapus user
  4. Reset password
  5. Mengatur role user
- **Post-condition**: Data user terupdate

### UC-SA02: Konfigurasi Sistem
- **Aktor**: Superadmin
- **Deskripsi**: Mengatur parameter sistem
- **Flow**:
  1. Update pengaturan sistem
  2. Konfigurasi keamanan
  3. Pengaturan notifikasi
  4. Manajemen backup

## 2. Admin Use Cases

### UC-AD01: Manajemen Produk
- **Aktor**: Admin
- **Deskripsi**: Mengelola produk marketplace
- **Flow**:
  1. Tambah produk baru
  2. Update stok
  3. Atur harga
  4. Kategorisasi produk

### UC-AD02: Proses Transaksi
- **Aktor**: Admin
- **Deskripsi**: Mengelola transaksi marketplace
- **Flow**:
  1. Verifikasi pesanan
  2. Proses pengiriman
  3. Update status
  4. Penanganan refund

## 3. Dosen Use Cases

### UC-DS01: Manajemen Poin
- **Aktor**: Dosen
- **Deskripsi**: Mengelola poin mahasiswa
- **Flow**:
  1. Pemberian poin
  2. Review aktivitas
  3. Evaluasi pencapaian
  4. Generate laporan

### UC-DS02: Pemberian Badge
- **Aktor**: Dosen
- **Deskripsi**: Mengelola badge mahasiswa
- **Flow**:
  1. Buat badge baru
  2. Set kriteria
  3. Award badge
  4. Monitor progress

## 4. Mahasiswa Use Cases

### UC-MH01: Wallet Management
- **Aktor**: Mahasiswa
- **Deskripsi**: Mengelola saldo poin
- **Flow**:
  1. Cek saldo
  2. Transfer poin
  3. Riwayat transaksi
  4. Klaim rewards

### UC-MH02: Marketplace Access
- **Aktor**: Mahasiswa
- **Deskripsi**: Mengakses marketplace
- **Flow**:
  1. Browse produk
  2. Add to cart
  3. Checkout
  4. Track pesanan

### UC-MH03: Konsultasi
- **Aktor**: Mahasiswa
- **Deskripsi**: Mengakses sistem konsultasi
- **Flow**:
  1. Book jadwal
  2. Konfirmasi booking
  3. Join konsultasi
  4. Beri feedback

## 5. Shared Use Cases

### UC-SH01: Authentication
- **Aktor**: All Users
- **Deskripsi**: Proses autentikasi
- **Flow**:
  1. Login
  2. Logout
  3. Reset password
  4. Update profile

### UC-SH02: Notifikasi
- **Aktor**: All Users
- **Deskripsi**: Sistem notifikasi
- **Flow**:
  1. Terima notifikasi
  2. Baca notifikasi
  3. Mark as read
  4. Manage preferences
