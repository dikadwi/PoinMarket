<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<main class="p-10">
    <section class="text-center mb-10 flex flex-col md:flex-row justify-between items-center">
        <div class="md:w-1/2">
            <h1 class="text-purple-600 text-3xl md:text-4xl font-bold mb-4">Selamat Datang di PointMarket!</h1>
            <p class="text-gray-600 mb-6">
                <strong>PointMarket</strong> adalah platform inovatif yang menggabungkan gamifikasi untuk menciptakan pengalaman belajar yang seru, interaktif, dan bermakna. Dengan sistem poin yang dinamis, kami membawa pembelajaran ke tingkat yang lebih tinggi, membuat setiap aktivitas Anda lebih menarik dan penuh tantangan!
            </p>
            <h2 class="text-3xl font-bold text-purple-600 mb-4">Kenapa Memilih PointMarket?</h2>
            <p class="text-gray-600 mb-6">
                <strong>PointMarket</strong> dirancang untuk membantu mahasiswa meningkatkan keterlibatan dan motivasi dalam proses pembelajaran. Dengan menggunakan sistem poin, leaderboard, level, dan badges, setiap pencapaian Anda terasa lebih nyata dan memotivasi. Sistem ini menciptakan lingkungan belajar yang kompetitif namun tetap menyenangkan.
            </p>
            <button class="bg-purple-600 text-white px-6 py-3 rounded-full hover:bg-purple-700" onclick="scrollToSection('fitur')">EXPLORE</button>
            <!-- <button class="bg-purple-600 text-white px-6 py-3 rounded-full hover:bg-purple-700" onclick="scrollToSection('fitur')">EXPLORE</button> -->
        </div>
        <div class="md:w-1/2 mt-10 md:mt-0 relative">
            <img alt="Illustration of people around two large dice" class="w-full h-auto" src="/img/dice.png" />
        </div>
    </section>

    <section class="mb-10" id="fitur">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Fitur Utama PointMarket</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Reward</span>
                        <i class="fas fa-gift fa-2x fa-bounce"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Dapatkan poin setiap kali Anda berhasil menyelesaikan tugas atau misi tertentu.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Belanja</span>
                        <i class="fas fa-shopping-cart fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tukarkan poin Anda untuk membeli berbagai produk dan layanan di Marketplace.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Punishment</span>
                        <i class="fas fa-flag fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Sistem pengurangan poin jika terjadi pelanggaran.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Misi</span>
                        <i class="fas fa-compass fa-2x fa-spin"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Ikuti berbagai misi tambahan untuk mendapatkan lebih banyak poin!</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Konsultasi</span>
                        <i class="fas fa-comments fa-2x fa-flip"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Gunakan poin Anda untuk mendapatkan sesi konsultasi eksklusif dengan dosen atau ahli.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Bagaimana Cara Kerjanya ?</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Gabung di Platform</span>
                        <i class="fas fa-user-plus fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Daftar sebagai pengguna dan mulailah perjalanan belajar Anda yang seru.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Kumpulkan Poin</span>
                        <i class="fas fa-coins fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Selesaikan tugas, misi tambahan, dan aktivitas lainnya untuk mendapatkan poin.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Gunakan Poin Anda</span>
                        <i class="fas fa-exchange fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tukarkan poin untuk membeli produk di Marketpace atau gunakan untuk layanan seperti konsultasi dengan dosen/ahli.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Raih Level & Badges</span>
                        <i class="fas fa-award fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tingkatkan level Anda dan dapatkan badges prestasi untuk mengakui keberhasilan Anda di depan teman-teman Anda!</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Leaderboard</span>
                        <i class="fas fa-clipboard-list fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tingkatkan poin Anda untuk mengakui keberhasilan Anda di papan peringkat!</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Manfaat Untuk Anda</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Motivasi Tinggi</span>
                        <i class="fas fa-lightbulb fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Sistem gamifikasi menciptakan rasa kompetisi yang sehat dan membuat belajar lebih menyenangkan.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Transparansi Pencapaian</span>
                        <i class="fas fa-chart-line fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Anda dapat melihat perkembangan Anda dengan jelas melalui poin, level, dan badges.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Belajar Interaktif</span>
                        <i class="fas fa-gamepad fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Misi tambahan dan aktivitas yang menarik membuat belajar tidak lagi membosankan.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-3">Reward Nyata</span>
                        <i class="fas fa-trophy fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tukarkan poin Anda dengan produk dan layanan yang Anda butuhkan!</p>
                </div>
            </div>
        </div>
    </section>

    <div class="flex-container">
        <div class="flex-item w-full">
            <section class="text-center">
                <h2 class=" text-3xl font-bold text-purple-600 mb-4">Mulai Petualangan Belajar Anda Sekarang!</h2>
                <p class="text-gray-600 mb-6">Daftar sekarang di <stong>PointMarket</stong> dan rasakan pengalaman belajar yang berbeda dari yang pernah Anda rasakan sebelumnya. Tingkatkan kemampuan, raih prestasi, dan dapatkan reward di setiap langkah perjalanan Anda!</p>
                <a href="/register"><button class="bg-purple-600 text-white px-6 py-3 rounded-full hover:bg-purple-700">DAFTAR SEKARANG</button></a>
            </section>
        </div>
    </div>
</main>

<script>
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        const offset = 85; // offset untuk header
        section.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
        window.scrollTo(0, window.scrollY + section.getBoundingClientRect().top - offset);
    }
</script>
<?= $this->endsection(); ?>