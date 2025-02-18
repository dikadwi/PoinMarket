<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<main class="p-10">
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Pusat Bantuan</h2>
        <p class="lead">Berikut adalah beberapa pertanyaan yang sering diajukan dan jawabannya :</p>
    </section>
    <section class="mb-10">
        <div class="card mb-4 custom-card">
            <div class="card-body">
                <h2 class="font-bold text-center">Pertanyaan yang Sering Diajukan</h2>
                <dl>
                    <dt class="font-bold">Bagaimana cara mendaftar?</dt>
                    <dd>Anda dapat mendaftar dengan mengklik tombol "Daftar" di pojok kanan atas situs web kami.</dd>
                    <dt class="font-bold">Bagaimana cara melakukan pembayaran?</dt>
                    <dd>Anda dapat melakukan pembayaran dengan menggunakan kartu kredit, transfer bank, atau metode pembayaran lainnya yang tersedia.</dd>
                    <dt class="font-bold">Bagaimana cara menghubungi tim dukungan?</dt>
                    <dd>Anda dapat menghubungi tim dukungan kami melalui email atau telepon.</dd>
                </dl>
            </div>
        </div>
        <div class="card mb-4 custom-card">
            <div class="card-body">
                <h2 class="font-bold">Kontak Kami</h2>
                <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan, silakan menghubungi kami:</p>
                <ul>
                    <li><i class="fas fa-envelope"></i> : <a href="mailto:info@pointmarket.my.id">info@pointmarket</a></li>
                    <li><i class="fas fa-phone"></i> : +62 123 456 7890</li>
                </ul>
            </div>
        </div>
    </section>
</main>

<?= $this->endsection(); ?>