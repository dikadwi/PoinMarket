# Dokumentasi Entity Relationship Diagram (ERD) PoinMarket

## Entitas dan Atribut

### 1. Pengguna
- **id_pengguna** (PK) - Identifikasi unik pengguna
- **username** - Nama pengguna untuk login
- **email** - Alamat email pengguna
- **password** - Kata sandi terenkripsi
- **role** - Peran pengguna (Superadmin/Admin/Dosen/Mahasiswa)
- **status** - Status akun (Aktif/Nonaktif)
- **created_at** - Waktu pembuatan akun
- **updated_at** - Waktu terakhir update

### 2. Profil
- **id_profil** (PK) - Identifikasi unik profil
- **id_pengguna** (FK) - Referensi ke tabel Pengguna
- **nama_lengkap** - Nama lengkap pengguna
- **nim_nip** - Nomor Induk Mahasiswa/Pegawai
- **foto** - Path foto profil
- **no_telp** - Nomor telepon
- **alamat** - Alamat lengkap

### 3. Dompet
- **id_dompet** (PK) - Identifikasi unik dompet
- **id_pengguna** (FK) - Referensi ke tabel Pengguna
- **saldo_poin** - Jumlah poin tersedia
- **status** - Status dompet (Aktif/Dibekukan)
- **updated_at** - Waktu terakhir update

### 4. Transaksi_Poin
- **id_transaksi** (PK) - Identifikasi unik transaksi
- **id_pengirim** (FK) - Referensi ke pengguna pengirim
- **id_penerima** (FK) - Referensi ke pengguna penerima
- **jumlah_poin** - Jumlah poin ditransfer
- **jenis_transaksi** - Jenis transaksi (Pemberian/Penukaran/dll)
- **keterangan** - Deskripsi transaksi
- **status** - Status transaksi
- **created_at** - Waktu transaksi

### 5. Produk
- **id_produk** (PK) - Identifikasi unik produk
- **nama_produk** - Nama produk
- **deskripsi** - Deskripsi produk
- **harga_poin** - Harga dalam poin
- **stok** - Jumlah stok tersedia
- **gambar** - Path gambar produk
- **kategori** - Kategori produk
- **status** - Status produk (Tersedia/Habis)

### 6. Pesanan
- **id_pesanan** (PK) - Identifikasi unik pesanan
- **id_pembeli** (FK) - Referensi ke pengguna pembeli
- **total_poin** - Total poin transaksi
- **status** - Status pesanan
- **created_at** - Waktu pembuatan pesanan
- **updated_at** - Waktu terakhir update

### 7. Detail_Pesanan
- **id_detail** (PK) - Identifikasi unik detail pesanan
- **id_pesanan** (FK) - Referensi ke pesanan
- **id_produk** (FK) - Referensi ke produk
- **jumlah** - Jumlah item
- **harga_poin** - Harga per item

### 8. Konsultasi
- **id_konsultasi** (PK) - Identifikasi unik konsultasi
- **id_mahasiswa** (FK) - Referensi ke mahasiswa
- **id_dosen** (FK) - Referensi ke dosen
- **tanggal** - Tanggal konsultasi
- **waktu** - Waktu konsultasi
- **topik** - Topik konsultasi
- **status** - Status konsultasi
- **biaya_poin** - Biaya dalam poin

### 9. Notifikasi
- **id_notifikasi** (PK) - Identifikasi unik notifikasi
- **id_pengguna** (FK) - Referensi ke pengguna
- **judul** - Judul notifikasi
- **pesan** - Isi pesan notifikasi
- **jenis** - Jenis notifikasi
- **status_baca** - Status pembacaan
- **created_at** - Waktu pembuatan

## Relasi Antar Entitas

1. **Pengguna - Profil (1:1)**
   - Setiap pengguna memiliki satu profil
   - Profil hanya dimiliki oleh satu pengguna

2. **Pengguna - Dompet (1:1)**
   - Setiap pengguna memiliki satu dompet
   - Dompet hanya dimiliki oleh satu pengguna

3. **Pengguna - Transaksi_Poin (1:N)**
   - Pengguna dapat memiliki banyak transaksi
   - Setiap transaksi terkait dengan dua pengguna (pengirim dan penerima)

4. **Pengguna - Pesanan (1:N)**
   - Pengguna dapat membuat banyak pesanan
   - Setiap pesanan dimiliki oleh satu pengguna

5. **Pesanan - Detail_Pesanan (1:N)**
   - Satu pesanan dapat memiliki banyak detail pesanan
   - Setiap detail pesanan terkait dengan satu pesanan

6. **Produk - Detail_Pesanan (1:N)**
   - Satu produk dapat muncul di banyak detail pesanan
   - Setiap detail pesanan merujuk ke satu produk

7. **Pengguna - Konsultasi (1:N)**
   - Dosen/Mahasiswa dapat memiliki banyak jadwal konsultasi
   - Setiap konsultasi melibatkan satu dosen dan satu mahasiswa

8. **Pengguna - Notifikasi (1:N)**
   - Pengguna dapat memiliki banyak notifikasi
   - Setiap notifikasi ditujukan untuk satu pengguna

## Catatan Implementasi

1. **Keamanan Data**
   - Enkripsi password
   - Validasi input
   - Pembatasan akses berdasarkan role

2. **Integritas Data**
   - Foreign key constraints
   - Cascade delete/update sesuai kebutuhan
   - Validasi transaksi poin

3. **Optimasi**
   - Indeks pada kolom yang sering dicari
   - Soft delete untuk data penting
   - Logging untuk audit trail
