# Diagram Aliran Data (DFD) PoinMarket

## Diagram Konteks (Level 0)

Diagram Konteks menunjukkan interaksi sistem PoinMarket dengan entitas eksternal:

### Entitas Eksternal:
1. **Mahasiswa**
   - Input: Login, update profil, pesanan, booking
   - Output: Info akun, saldo poin, konfirmasi

2. **Dosen**
   - Input: Pemberian poin, jadwal konsultasi
   - Output: Data mahasiswa, permintaan konsultasi

3. **Admin**
   - Input: Manajemen produk, proses pesanan
   - Output: Laporan, notifikasi, status inventori

4. **Superadmin**
   - Input: Konfigurasi sistem, manajemen pengguna
   - Output: Statistik sistem, analisis, log audit

## DFD Level 1

### Proses Utama:

1. **Autentikasi Pengguna (1.0)**
   - Manajemen login/logout
   - Penanganan sesi
   - Kontrol akses

2. **Pengelolaan Poin (2.0)**
   - Pemberian poin dari dosen
   - Transaksi poin
   - Update saldo
   - Riwayat transaksi

3. **Sistem Marketplace (3.0)**
   - Katalog produk
   - Keranjang belanja
   - Proses pesanan
   - Manajemen inventori

4. **Sistem Konsultasi (4.0)**
   - Manajemen jadwal
   - Proses booking
   - Catatan konsultasi
   - Sistem feedback

5. **Manajemen Pengguna (5.0)**
   - Registrasi pengguna
   - Manajemen profil
   - Pengaturan role
   - Izin akses

6. **Laporan & Analisis (6.0)**
   - Laporan transaksi
   - Analisis distribusi poin
   - Statistik penggunaan sistem
   - Monitoring kinerja

### Penyimpanan Data:

1. **D1 Data Pengguna**
   - Profil pengguna
   - Data autentikasi
   - Informasi role

2. **D2 Data Poin**
   - Saldo poin
   - Riwayat transaksi
   - Aturan poin

3. **D3 Data Produk**
   - Katalog produk
   - Level inventori
   - Kategori produk

4. **D4 Data Pesanan**
   - Detail pesanan
   - Catatan transaksi
   - Informasi pembayaran

5. **D5 Data Konsultasi**
   - Catatan booking
   - Data jadwal
   - Riwayat konsultasi

6. **D6 Log Sistem**
   - Log aktivitas
   - Log error
   - Jejak audit

### Aliran Data:

1. **Alur Autentikasi**
   - Kredensial login
   - Token sesi
   - Izin akses

2. **Alur Pengelolaan Poin**
   - Pemberian poin
   - Update saldo
   - Catatan transaksi

3. **Alur Marketplace**
   - Pembuatan pesanan
   - Verifikasi stok
   - Proses pembayaran

4. **Alur Konsultasi**
   - Permintaan jadwal
   - Konfirmasi booking
   - Catatan konsultasi

5. **Alur Manajemen**
   - Update pengguna
   - Konfigurasi sistem
   - Pengaturan role

6. **Alur Pelaporan**
   - Agregasi data
   - Pembuatan laporan
   - Proses analisis

## Pertimbangan Keamanan

1. **Perlindungan Data**
   - Transmisi data terenkripsi
   - Penyimpanan aman
   - Kontrol akses

2. **Keamanan Transaksi**
   - Verifikasi poin
   - Validasi saldo
   - Pencatatan transaksi

3. **Privasi Pengguna**
   - Anonimisasi data
   - Pembatasan akses
   - Jejak audit

## Integrasi Sistem

1. **Integrasi Database**
   - Update real-time
   - Konsistensi data
   - Prosedur backup

2. **Layanan Eksternal**
   - Notifikasi email
   - Proses pembayaran
   - Pembuatan laporan

3. **Antarmuka Pengguna**
   - Antarmuka web
   - Responsif mobile
   - Update real-time
