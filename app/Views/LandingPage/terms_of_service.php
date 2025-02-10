<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<main class="p-10">
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Syarat dan Ketentuan</h2>
        <p class="lead">Berikut adalah syarat dan ketentuan penggunaan situs web dan layanan PointMarket:</p>
    </section>
    <section class="mb-10">
        <div class="card mb-4 custom-card">
            <div class="card-body">
                <h2 class="font-bold">Penggunaan Situs Web</h2>
                <p>Anda harus menggunakan situs web kami untuk tujuan yang sah dan tidak melanggar hukum.</p>

                <h2 class="font-bold">Akun</h2>
                <p>Anda harus membuat akun untuk menggunakan layanan kami. Anda harus menjaga kerahasiaan kata sandi Anda.</p>

                <h2 class="font-bold">Pembayaran</h2>
                <p>Anda harus melakukan pembayaran sesuai dengan ketentuan yang berlaku.</p>

                <h2 class="font-bold">Konten</h2>
                <p>Anda tidak boleh memposting konten yang melanggar hukum, tidak pantas, atau tidak sesuai dengan kebijakan kami.</p>

                <h2 class="font-bold">Tanggung Jawab</h2>
                <p>Kami tidak bertanggung jawab atas kerusakan atau kehilangan yang disebabkan oleh penggunaan situs web atau layanan kami.</p>
                <p>Kami tidak bertanggung jawab atas konten yang diposting oleh pengguna lain.</p>

                <h2 class="font-bold">Perubahan Syarat dan Ketentuan</h2>
                <p>Kami dapat memperbarui syarat dan ketentuan kami dari waktu ke waktu. Perubahan akan diterbitkan di situs web kami.</p>

            </div>
        </div>
    </section>
</main>

<?= $this->endsection(); ?>