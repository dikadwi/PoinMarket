<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<main class="p-10">
    <!-- Section Tentang Kami -->
    <section class="text-center mb-10 flex flex-col md:flex-row justify-between items-center">
        <div class="md:w-3/4">
            <h1 class="text-purple-600 text-3xl md:text-4xl font-bold mb-4">Tentang PointMarket</h1>
            <p class="text-gray-600 mb-6">
                <strong>PointMarket</strong> merupakan platform inovatif yang dirancang untuk meningkatkan pengalaman belajar mahasiswa melalui sistem gamifikasi. Kami percaya bahwa belajar seharusnya menyenangkan, interaktif, dan bermakna. Dengan menggabungkan elemen-elemen seperti poin, leaderboard, level, dan badges, kami menciptakan lingkungan belajar yang kompetitif namun tetap menyenangkan.
            </p>
            <p class="text-gray-600 mb-6">
                <strong>PointMarket</strong> tidak hanya membantu mahasiswa dalam meningkatkan keterlibatan dan motivasi belajar, tetapi juga memberikan reward nyata yang dapat digunakan untuk membeli produk atau layanan di platform kami.
            </p>
        </div>
        <div class="md:w-1/4 mt-10 md:mt-0 relative">
            <img alt="Illustration of people around two large dice" class="w-full h-auto" src="/img/Market.png" width="75%" />
        </div>
    </section>

    <!-- Section Visi & Misi -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Visi & Misi</h2>
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <!-- Card Visi -->
            <div class="bg-white shadow-lg rounded-lg p-0 w-full md:w-1/2 custom-card flex flex-col">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Visi</span>
                        <i class="fas fa-compass fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body p-4 flex-grow">
                    <p class="text-gray-600">
                        Menjadi platform gamifikasi pembelajaran terdepan yang memotivasi mahasiswa untuk mencapai potensi terbaik mereka melalui pengalaman belajar yang menyenangkan dan bermakna.
                    </p>
                </div>
            </div>

            <!-- Card Misi -->
            <div class="bg-white shadow-lg rounded-lg p-0 w-full md:w-1/2 custom-card flex flex-col">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Misi</span>
                        <i class="fas fa-route fa-2x fa-beat"></i>
                    </div>
                </div>
                <div class="card-body p-4 flex-grow">
                    <ul class="text-gray-600 list-disc pl-6">
                        <li>Menciptakan lingkungan belajar yang interaktif dan kompetitif.</li>
                        <li>Memberikan reward nyata untuk meningkatkan motivasi belajar.</li>
                        <li>Mengintegrasikan teknologi gamifikasi untuk meningkatkan keterlibatan mahasiswa.</li>
                        <li>Menyediakan platform yang transparan dan mudah digunakan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Tim Kami -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-purple-600 mb-4">Tim Kami</h2>
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>CEO & Founder</span>
                </div>
                <div class="card-body text-center">
                    <img src="https://c8.alamy.com/comp/2D69TKH/business-team-at-the-video-conference-call-in-boardroom-vector-flat-cartoon-illustration-online-meeting-with-ceo-manager-or-director-consulting-an-2D69TKH.jpg" alt="Foto Tim" class="rounded-full mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CEO & Founder</p> -->
                    <p class="text-gray-600">Seorang visioner yang percaya bahwa gamifikasi dapat mengubah cara kita belajar.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>CTO</span>
                </div>
                <div class="card-body text-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/004/579/151/non_2x/the-web-developer-team-is-building-a-smartphone-app-in-flat-design-free-vector.jpg" alt="Foto Tim" class="rounded-full mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">CTO</p> -->
                    <p class="text-gray-600">Ahli teknologi yang bertanggung jawab atas inovasi teknologi dan pengembangan platform PointMarket.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Developer</span>
                </div>
                <div class="card-body text-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/007/814/266/non_2x/programmer-and-engineering-development-coding-web-development-website-design-developer-flat-vector.jpg" alt="Foto Tim" class="rounded-full mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">Developer</p> -->
                    <p class="text-gray-600">Ahli pengembang aplikasi yang bertanggung jawab atas platform PointMarket.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-0 w-66 custom-card">
                <div class="card-header text-center">
                    <span>Marketing Manager</span>
                </div>
                <div class="card-body text-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/002/314/283/non_2x/mobile-marketing-web-concept-with-people-vector.jpg" alt="Foto Tim" class="rounded-full mx-auto mb-4">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">. . . .</h3>
                    <!-- <p class="text-gray-600 font-bold">Marketing Manager</p> -->
                    <p class="text-gray-600">Bertanggung jawab untuk mempromosikan PointMarket dan menjangkau lebih banyak mahasiswa.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="flex-container">
        <div class="flex-item w-full">
            <section class="text-center">
                <h2 class="text-3xl font-bold text-purple-600 mb-4">Bergabunglah dengan Kami!</h2>
                <p class="text-gray-600 mb-6">Kami mengundang Anda untuk menjadi bagian dari komunitas <strong>PointMarket</strong>. Daftar sekarang dan mulai perjalanan belajar Anda yang menyenangkan!</p>
                <a href="/page/register"><button class="bg-purple-600 text-white px-6 py-3 rounded-full hover:bg-purple-700">DAFTAR SEKARANG</button></a>
            </section>
        </div>
    </div>
</main>

<?= $this->endsection(); ?>