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
                PointMarket dirancang untuk membantu mahasiswa meningkatkan keterlibatan dan motivasi dalam proses pembelajaran. Dengan menggunakan sistem poin, leaderboard, level, dan badges, setiap pencapaian Anda terasa lebih nyata dan memotivasi. Sistem ini menciptakan lingkungan belajar yang kompetitif namun tetap menyenangkan.
            </p>
            <button class="bg-purple-600 text-white px-6 py-3 rounded-full hover:bg-purple-700">EXPLORE</button>
        </div>
        <div class="md:w-1/2 mt-10 md:mt-0 relative">
            <img alt="Illustration of people around two large dice" class="w-full h-auto" src="https://storage.googleapis.com/a1aa/image/pnt3XAgpq4YVFloPOlqlzhewvPgVoUGcPHSXxrfnfy7cdKynA.jpg" />
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Fitur Utama PointMarket</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Reward
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Dapatkan poin setiap kali Anda berhasil menyelesaikan tugas atau misi tertentu.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Pembelian
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tukarkan poin Anda untuk membeli berbagai produk dan layanan di MarketPoint.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Punishment
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Sistem pengurangan poin jika terjadi pelanggaran.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Misi Tambahan
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Ikuti berbagai misi tambahan untuk mendapatkan lebih banyak poin!</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Konsultasi
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Gunakan poin Anda untuk mendapatkan sesi konsultasi eksklusif dengan dosen atau ahli.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-3xl font-bold text -purple-600 mb-4">Bagaimana Cara Kerjanya ?</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Gabung di Platform
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Daftar sebagai pengguna dan mulailah perjalanan belajar Anda yang seru.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Kumpulkan Poin
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Selesaikan tugas, misi tambahan, dan aktivitas lainnya untuk mendapatkan poin.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Gunakan Poin Anda
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tukarkan poin untuk membeli produk di MarketPoint atau gunakan untuk layanan seperti konsultasi dengan dosen/ahli.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Raih Level & Badges
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tingkatkan level Anda dan dapatkan badges prestasi untuk mengakui keberhasilan Anda di depan teman-teman Anda!</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Leaderboard
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
                    Motivasi Tinggi
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Sistem gamifikasi menciptakan rasa kompetisi yang sehat dan membuat belajar lebih menyenangkan.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Transparansi Pencapaian
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Anda dapat melihat perkembangan Anda dengan jelas melalui poin, level, dan badges.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Belajar Interaktif
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Misi tambahan dan aktivitas yang menarik membuat belajar tidak lagi membosankan.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    Reward Nyata
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
                <p class="text-gray-600 mb-6">Daftar sekarang di PointMarket dan rasakan pengalaman belajar yang berbeda dari yang pernah Anda rasakan sebelumnya. Tingkatkan kemampuan, raih prestasi, dan dapatkan reward di setiap langkah perjalanan Anda!</p>
                <a href="/page/register"><button class="bg-purple-600 text-white px-6 py-3 rounded-full hover:bg-purple-700">DAFTAR SEKARANG</button></a>
            </section>
        </div>
    </div>
</main>

<?= $this->endsection(); ?>