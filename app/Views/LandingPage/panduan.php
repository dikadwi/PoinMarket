<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<main class="p-10">
    <!-- Pendahuluan -->
    <section class="text-center mb-10 flex flex-col md:flex-row justify-between items-center">
        <div class="md:w-1/2">
            <h1 class="text-purple-600 text-3xl md:text-4xl font-bold mb-4">Panduan Penggunaan</h1>
            <p class="text-gray-600 mb-6">
                Bagaimana Menggunakan Point Market. <br>
                Anda dapat menemukan dan mengoptimalkan gaya belajar Anda melalui elemen-elemen permainan yang menarik dan interaktif.
            </p>
        </div>
        <div class="md:w-1/2 mt-10 md:mt-0 relative">
            <img alt="Illustration of people learning with gamification" class="w-full h-auto" height="400" src="/img/dice.png" width="600" />
        </div>
    </section>

    <!-- Cara Kerja -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Bagaimana Cara Kerjanya ?</h2>
        <div class="flex flex-col md:flex-row overflow-x space-x-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Gabung di Platform</span>
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
                        <span>Kumpulkan Poin</span>
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
                        <span>Gunakan Poin Anda</span>
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
                        <span>Raih Level & Badges</span>
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
                        <span>Leaderboard</span>
                        <i class="fas fa-clipboard-list fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-gray-600">Tingkatkan poin Anda untuk mengakui keberhasilan Anda di papan peringkat!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gabung di Platform -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Gabung di Platform <i class="fas fa-user-plus"></i></h2>

        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Login / Register</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/landingpage.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Klik tombol <b>"Sign In"</b> di bagian atas halaman utama PointMarket.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Login</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/login.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600"><b>"Login"</b> menggunakan Username dan Password Anda.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Register</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/register.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Jika belum mempunyai akun silakan <b>"Register"</b> terlebih dahulu. Untuk membuat akun baru.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Dashboard</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/dashboard.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CTO</p> -->
                    <p class="text-gray-600">Jika berhasil login anda akan diarahkan ke halaman <b>"Dashboard"</b> PointMarket.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kumpulkan Poin -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Kumpulkan Poin <i class="fas fa-coins"></i></h2>
        <!-- Misi/Tugas-->
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Misi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/dashboard.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Pilih menu <b>"Misi"</b> pada halaman Dashboard.</p>
                </div>

            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Pilih Tugas dan Misi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/misi.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600"> Cari tugas dan misi yang tersedia. <br>
                        Pilih tugas dan misi yang sesuai dengan minat dan kemampuan Anda.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Status Validasi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/validasi_misi.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Tugas dan Misi yang dipilih akan divalidasi terlebih dahulu. <br>
                        Setelah tervalidasi anda dapat mulai mengerjakan tugas dan misi.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Selesaikan Tugas dan Misi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/progres_misi.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Kerjakan tugas dan misi yang sudah di validasi. Selesaikan misi dengan memenuhi persyaratan.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Dapatkan Poin</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/poin.jpg" alt="Foto Tim" class="rounded-lg mx-auto mb-4" width="1200">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Poin diperoleh setelah selesai mengerjakan <b>"Misi"</b>.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Quis -->
    <section class="mb-10">
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Quis</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/dashboard.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Pilih menu <b>"Quis"</b> pada halaman Dashboard.</p>
                </div>

            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Kerjakan Quis</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/progres_misi.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Kerjakan Quis. Selesaikan semua pertanyaan yang tersedia.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Dapatkan Poin</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/poin.jpg" alt="Foto Tim" class="rounded-lg mx-auto mb-4" width="1100">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Poin diperoleh setelah selesai mengerjakan <b>"Quis"</b>.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gunakan Poin -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Gunakan Poin <i class="fas fa-exchange"></i></h2>
        <!-- Misi/Tugas-->
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Marketplace</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/dashboard.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Pilih menu <b>"Marketplace"</b> pada halaman Dashboard.</p>
                </div>

            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Pilih Produk</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/market.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600"> Cari produk yang tersedia. <br>
                        Pilih produk yang sesuai dengan minat dan kebutuhan Anda.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Status Validasi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/validasi_misi.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Produk yang dipilih akan divalidasi oleh admin terlebih dahulu.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Dapatkan Produk</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/produk.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4" width="800">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Produk dikirimkan ke akun anda setelah berhasil tervalidasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Raih Level dan Badges -->
    <!-- <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Raih Level dan Badges <i class="fas fa-award"></i></h2>
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Cari Tugas dan Misi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/landingpage.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <p class="text-gray-600">Cari tugas dan misi yang tersedia di halaman marketplace. <br>
                        Pilih tugas dan misi yang sesuai dengan minat dan kemampuan Anda.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Selesaikan Tugas dan Misi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/landingpage.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <p class="text-gray-600">Kerjakan tugas dan misi yang sudah anda pilih. Selesaikan misi dengan memenuhi </p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Dapatkan Poin</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/landingpage.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <p class="text-gray-600">Pilih tugas dan misi yang sesuai dengan minat dan kemampuan Anda. Selesaikan misi yang telah dipilih</p>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Leaderboard -->
    <!-- <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Leaderboard<i class="fas fa-clipboard-list"></i></h2>
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Cari Tugas dan Misi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/landingpage.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <p class="text-gray-600">Cari tugas dan misi yang tersedia di halaman marketplace. <br>
                        Pilih tugas dan misi yang sesuai dengan minat dan kemampuan Anda.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Selesaikan Tugas dan Misi</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/landingpage.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <p class="text-gray-600">Kerjakan tugas dan misi yang sudah anda pilih. Selesaikan misi dengan memenuhi </p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Dapatkan Poin</span>
                </div>
                <div class="card-body text-center">
                    <img src="/img/panduan/landingpage.png" alt="Foto Tim" class="rounded-lg mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <p class="text-gray-600">Pilih tugas dan misi yang sesuai dengan minat dan kemampuan Anda. Selesaikan misi yang telah dipilih</p>
                </div>
            </div>
        </div>
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