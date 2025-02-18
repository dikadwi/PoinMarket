<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<main class="p-10">
    <!-- Section Kontak Kami -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4 text-center">Kontak Kami</h2>
        <div class="flex-item w-full text-center">
            <p class="text-gray-600 mb-6">Jika Anda memiliki pertanyaan atau ingin tahu lebih lanjut tentang <strong>PointMarket</strong>, jangan ragu untuk menghubungi kami melalui:</p>
        </div>
    </section>
    <section class="mb-10">
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <i class="fas fa-envelope fa-2x fa-beat"></i>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">Email</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">info@pointmarket</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <i class="fas fa-phone fa-2x fa-beat"></i>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">Phone</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">+62 123 456 789</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <i class="fas fa-map-pin fa-2x fa-beat"></i>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">Alamat</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Bandung, Indonesia</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?= $this->endsection(); ?>