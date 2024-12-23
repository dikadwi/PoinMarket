# PointMarket
_URL_ : https://poinmarket.my.id/

PointMarket adalah aplikasi berbasis web yang dirancang untuk meningkatkan engagement mahasiswa dengan mengimplementasikan elemen **gamifikasi**. Aplikasi ini berfungsi sebagai platform untuk berbagai transaksi berbasis poin, seperti pengambilan reward, penyelesaian misi tambahan, konsultasi, pembelian produk, hingga penanganan pelanggaran yang disertai punishment.

## Fitur Utama
1. **Gamifikasi untuk Engagement**:
   - **Leaderboard**: Sistem peringkat mahasiswa berdasarkan poin.
   - **Level & Badges**: Setiap mahasiswa memiliki level dan lencana berdasarkan jumlah poin yang diperoleh.

2. **Transaksi Berbasis Poin**:
   - Reward. (penambahan poin dari reward yang diberikan).
   - Misi tambahan. (penambahan poin, dengan menyelesaikan misi/tugas).
   - Pembelian produk.(pengurangan poin untuk pembelian produk).
   - Punishment (pengurangan poin untuk pelanggaran).
   - Konsultasi (pengurangan poin untuk melakukan konsultasi dengan ahli).     - 

3. **Pengelolaan Poin**:
   - Semua transaksi dilakukan menggunakan sistem poin.
   - Poin mahasiswa dapat bertambah atau berkurang tergantung aktivitas mereka.

## Teknologi yang Digunakan
- **Framework**: CodeIgniter
- **Template**: AdminLTE
- **Database**: MySQL/MariaDB
- **Bahasa Pemrograman**: PHP, JavaScript

## Instalasi
Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal Anda:

1. Clone repositori:
   ```bash
   git clone https://github.com/username/PointMarket.git
   cd PointMarket
2. Instalasi dependensi: Pastikan Anda telah menginstal Composer di sistem Anda. Kemudian, jalankan perintah berikut untuk menginstal dependensi PHP:
   ```bash
   composer install
3. Konfigurasi file .env dan sesuaikan pengaturan database Anda:
    ```arduino
    database.default.hostname = localhost
    database.default.database = nama_database
    database.default.username = username_database
    database.default.password = password_database
    database.default.DBDriver = MySQLi
4. Migrasi database: Jalankan migrasi untuk membuat tabel-tabel yang diperlukan di database:
    ```bash
    php spark migrate
5. Jalankan aplikasi: Setelah semua konfigurasi selesai, jalankan aplikasi menggunakan perintah berikut:
    ```bash
    php spark serve
6. Akses aplikasi: Buka browser Anda dan akses aplikasi melalui URL berikut:
    ```arduino
    http://localhost:8080

# Selamat Mencoba! Aplikasi PointMarket sekarang sudah berjalan di lingkungan lokal Anda.

