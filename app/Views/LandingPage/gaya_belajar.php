<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<main class="p-10">
    <!-- Pendahuluan -->
    <section class="text-center mb-10 flex flex-col md:flex-row justify-between items-center">
        <div class="md:w-1/2">
            <h1 class="text-purple-600 text-3xl md:text-4xl font-bold mb-4">Gaya Belajar</h1>
            <p class="text-gray-600 mb-6">
                Setiap individu memiliki cara unik dalam menyerap informasi. Dengan <strong>gamifikasi</strong>, Anda dapat menemukan dan mengoptimalkan gaya belajar Anda melalui elemen-elemen permainan yang menarik dan interaktif.
            </p>
        </div>
        <div class="md:w-1/2 mt-10 md:mt-0 relative">
            <img alt="Illustration of people learning with gamification" class="w-full h-auto" height="400" src="/img/dice.png" width="600" />
        </div>
    </section>

    <!-- Jenis-Jenis Gaya Belajar -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Jenis-Jenis Gaya Belajar</h2>
        <div class="flex flex-col md:flex-row justify-center overflow-x space-x-0 md:space-x-8 center">
            <!-- Visual -->
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Visual</span>
                        <i class="fas fa-eye fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Belajar melalui gambar, diagram, dan visualisasi. <!--Dapatkan poin dan lencana untuk setiap visualisasi yang berhasil dipahami.--></p>
                </div>
            </div>
            <!-- Auditori -->
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Auditori</span>
                        <i class="fas fa-headphones-alt fa-2x fa-beat-fade"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Belajar melalui suara dan musik. <!--Dapatkan poin untuk setiap podcast atau rekaman yang didengarkan dan dipahami.--></p>
                </div>
            </div>
            <!-- Reading -->
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Reading</span>
                        <i class="fas fa-book fa-2x fa-beat-fade"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Belajar melalui membaca Buku , Artikel. <!--Dapatkan poin untuk setiap podcast atau rekaman yang didengarkan dan dipahami.--></p>
                </div>
            </div>
            <!-- Kinestetik -->
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Kinestetik</span>
                        <i class="fas fa-running fa-2x fa-flip"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Belajar melalui gerakan dan aktivitas fisik. <!--Dapatkan lencana untuk setiap eksperimen atau simulasi yang berhasil dilakukan.--></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Manfaat Memahami Gaya Belajar dengan Gamifikasi -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Manfaat Gamifikasi sesuai Gaya Belajar</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Meningkatkan Pemahaman</span>
                        <i class="fas fa-chart-line fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Menyesuaikan metode belajar dengan gaya belajar dapat meningkatkan pemahaman materi.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Menghemat Waktu</span>
                        <i class="fas fa-stopwatch fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Menggunakan metode yang sesuai dapat mengurangi waktu yang dibutuhkan untuk belajar.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Meningkatkan Motivasi</span>
                        <i class="fas fa-lightbulb fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Elemen permainan seperti poin, lencana, dan papan peringkat membuat proses belajar lebih menyenangkan dan memotivasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Menentukan Gaya Belajar Anda dengan Gamifikasi -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Menentukan Gaya Belajar Anda dengan Gamifikasi</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Tes Gaya Belajar</span>
                        <i class="fas fa-pen fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Ikuti tes online yang dirancang dengan elemen gamifikasi untuk menentukan gaya belajar Anda.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Observasi Diri</span>
                        <i class="fas fa-magnifying-glass fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Amati cara Anda paling mudah menyerap informasi dan dapatkan poin untuk setiap observasi yang berhasil.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Eksperimen</span>
                        <i class="fas fa-flask fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Coba berbagai metode belajar dan lihat mana yang paling efektif. Dapatkan lencana untuk setiap metode yang berhasil dicoba.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Belajar Berdasarkan Gaya Belajar dengan Gamifikasi -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Tips Belajar Sesuai Gaya Belajar Anda</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Visual</span>
                        <i class="fas fa-eye fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Gunakan warna dan gambar dalam catatan. Dapatkan poin untuk setiap aktivitas yang dilakukan.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Auditori</span>
                        <i class="fas fa-headphones-alt fa-2x fa-beat-fade"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Rekam dan dengarkan kembali materi pelajaran. Dapatkan poin untuk setiap aktivitas yang dilakukan.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Reading</span>
                        <i class="fas fa-book fa-2x fa-fade"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Membaca Buku, Artikel. Dapatkan poin untuk setiap aktivitas yang dilakukan.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Kinestetik</span>
                        <i class="fas fa-running fa-2x fa-flip"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Lakukan aktivitas fisik sambil belajar, seperti berjalan atau menggunakan benda fisik. Dapatkan poin untuk setiap aktivitas yang dilakukan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kesimpulan -->
    <!-- <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Kesimpulan</h2>
        <p class="text-gray-600">Memahami dan menerapkan gaya belajar yang sesuai dengan gamifikasi dapat membuat proses belajar lebih efektif dan menyenangkan. Mulailah eksplorasi gaya belajar Anda hari ini dan lihat perbedaannya dalam proses pembelajaran Anda.</p>
    </section> -->

    <!-- Hubungi Kami -->
    <div class="flex-container">
        <div class="flex-item w-full">
            <section class="text-center">
                <h2 class="text-3xl font-bold text-purple-600 mb-4">Hubungi Kami</h2>
                <p class="text-gray-600 mb-6">Jika Anda membutuhkan bantuan lebih lanjut atau ingin konsultasi, jangan ragu untuk menghubungi kami.</p>
                <a href="/page/contact"><button class="bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700">Hubungi Kami</button></a>
            </section>
        </div>
    </div>
</main>

<?= $this->endsection(); ?>