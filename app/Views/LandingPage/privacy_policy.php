<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<main class="p-10">
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Kebijakan Privasi</h2>
        <p class="lead">Kami di PointMarket sangat peduli dengan privasi Anda. Berikut adalah kebijakan privasi kami:</p>
    </section>
    <section class="mb-10">
        <div class="card mb-4 custom-card">
            <div class="card-body">
                <h2 class="h5 mb-3 font-bold">Pengumpulan Data</h2>
                <p class="mb-3">Kami mengumpulkan data pribadi Anda seperti:</p>
                <ul class="list-unstyled mb-3">
                    <li>Nama</li>
                    <li>Alamat email</li>
                    <li>Nomor telepon</li>
                </ul>
                <p class="mb-3">Kami mengumpulkan data ini ketika Anda mendaftar atau menghubungi kami.</p>
            </div>
            <div class="card-body">
                <h2 class="h5 mb-3 font-bold">Penggunaan Data</h2>
                <p class="mb-3">Kami menggunakan data Anda untuk:</p>
                <ul class="list-unstyled mb-3">
                    <li>Meningkatkan pengalaman pengguna</li>
                    <li>Memproses transaksi</li>
                    <li>Mengirimkan informasi tentang produk dan layanan kami</li>
                </ul>
            </div>
            <div class="card-body">
                <h2 class="h5 mb-3 font-bold">Pengamanan Data</h2>
                <p class="mb-3">Kami menggunakan teknologi keamanan yang canggih untuk melindungi data Anda dari akses tidak sah.</p>
            </div>
            <div class="card-body">
                <h2 class="h5 mb-3 font-bold">Penghapusan Data</h2>
                <p class="mb-3">Kami akan menghapus data Anda jika Anda meminta kami untuk melakukannya.</p>
            </div>
            <div class="card-body">
                <h2 class="h5 mb-3 font-bold">Hak Anda</h2>
                <p class="mb-3">Anda memiliki hak untuk:</p>
                <ul class="list-unstyled mb-3">
                    <li>Mengakses dan memperbarui data pribadi Anda</li>
                    <li>Meminta kami untuk menghapus data Anda</li>
                    <li>Menolak penggunaan data Anda untuk tujuan pemasaran</li>
                </ul>
            </div>
            <div class="card-body">
                <h2 class="h5 mb-3 font-bold">Perubahan Kebijakan</h2>
                <p class="mb-3">Kami dapat memperbarui kebijakan privasi kami dari waktu ke waktu. Perubahan akan diterbitkan di situs web kami.</p>
            </div>
        </div>
    </section>
</main>

<?= $this->endsection(); ?>