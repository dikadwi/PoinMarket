<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panduan PoinMarket</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4">Panduan Penggunaan Sistem PoinMarket</h4>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h5>1. Superadmin</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>Akses penuh ke semua fitur sistem termasuk:</p>
                                            <ul>
                                                <li><strong>Manajemen User</strong>
                                                    <ul>
                                                        <li>Membuat, mengedit, dan menghapus akun pengguna</li>
                                                        <li>Mengatur role dan hak akses</li>
                                                        <li>Reset password pengguna</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Pengaturan Sistem</strong>
                                                    <ul>
                                                        <li>Konfigurasi aplikasi</li>
                                                        <li>Backup dan restore database</li>
                                                        <li>Maintenance mode</li>
                                                        <li>Monitoring sistem</li>
                                                    </ul>
                                                </li>
                                                <li>Akses ke semua fitur Admin</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h5>2. Admin</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Manajemen Produk</strong></p>
                                            <ul>
                                                <li>Menambah dan mengedit produk di PoinMarket</li>
                                                <li>Mengatur stok produk</li>
                                                <li>Mengelola kategori produk</li>
                                            </ul>
                                            <p><strong>Manajemen Transaksi</strong></p>
                                            <ul>
                                                <li>Memantau transaksi yang terjadi</li>
                                                <li>Verifikasi pembayaran</li>
                                                <li>Mengakses laporan penjualan</li>
                                                <li>Mengelola riwayat transaksi</li>
                                            </ul>
                                            <p><strong>Notifikasi</strong></p>
                                            <ul>
                                                <li>Mengelola notifikasi sistem</li>
                                                <li>Mengirim notifikasi ke pengguna</li>
                                                <li>Memantau status notifikasi</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h5>3. Dosen</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Manajemen Transaksi</strong></p>
                                            <ul>
                                                <li>Menambahkan transaksi untuk mahasiswa</li>
                                                <li>Memantau akumulasi poin</li>
                                            </ul>
                                            <p><strong>Evaluasi Mahasiswa</strong></p>
                                            <ul>
                                                <li>Input nilai dan evaluasi</li>
                                                <li>Review performa mahasiswa</li>
                                                <li>Membuat laporan evaluasi</li>
                                            </ul>
                                            <p><strong>Manajemen Badge</strong></p>
                                            <ul>
                                                <li>Memberikan badge prestasi</li>
                                                <li>Mengatur kriteria badge</li>
                                                <li>Memantau pencapaian mahasiswa</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h5>4. Mahasiswa</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Wallet & Poin</strong></p>
                                            <ul>
                                                <li>Melihat saldo poin</li>
                                                <li>Riwayat perolehan poin</li>
                                                <li>Transfer poin (jika diizinkan)</li>
                                            </ul>
                                            <p><strong>Marketplace</strong></p>
                                            <ul>
                                                <li>Melihat katalog produk</li>
                                                <li>Melakukan pembelian dengan poin</li>
                                                <li>Riwayat transaksi pembelian</li>
                                            </ul>
                                            <p><strong>Misi & Rewards</strong></p>
                                            <ul>
                                                <li>Melihat misi yang tersedia</li>
                                                <li>Mengklaim reward</li>
                                                <li>Melihat badge yang diperoleh</li>
                                            </ul>
                                            <p><strong>Konsultasi</strong></p>
                                            <ul>
                                                <li>Mengajukan konsultasi dengan dosen</li>
                                                <li>Melihat riwayat konsultasi</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Cara Mengakses:</h5>
                            <ul>
                                <li>Login ke sistem melalui halaman login</li>
                                <li>Sistem akan otomatis mengarahkan ke dashboard sesuai role</li>
                                <li>Gunakan menu navigasi di sidebar untuk mengakses fitur-fitur yang tersedia</li>
                                <li>Perhatikan notifikasi untuk informasi penting</li>
                                <li>Logout setelah selesai menggunakan sistem</li>
                            </ul>
                            <h5>Catatan Penting:</h5>
                            <ul>
                                <li>Setiap role memiliki batasan akses yang berbeda</li>
                                <li>Gunakan fitur sesuai dengan hak akses yang diberikan</li>
                                <li>Ikuti prosedur dan panduan yang ada untuk setiap fitur</li>
                                <li>Hubungi admin jika mengalami kendala teknis</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>
