<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- Menampilkan halaman yang ditambahkan ke topmenu -->
        <!-- <php foreach ($topMenuPages as $page): ?>
            <li class="nav-item">
                <a href="<= $page['url']; ?>" class="nav-link">
                    <i class="nav-icon fa fa-file"> <= $page['title']; ?></i>
                </a>
            </li>
        <php endforeach; ?> -->
        <li class="nav-item">
            <a href="/" class="nav-link">
                <i class="nav-icon fa fa-home"> Dashboard</i>
            </a>
        </li>

        <!-- <php if (in_groups(['admin', 'validator'])) : ?> Mengambil 2 Role -->
        <!-- <php if (in_groups('admin')) : ?> Mengambil Role, Jika Role sesuai Menu akan tampil -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-tags"> Jenis Transaksi</i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- Isi dropdown menu dengan link atau konten lain -->
                <a href="/Jenis_Transaksi/reward" class="dropdown-item">
                    <i class="fas fa-ribbon mr-2"></i>Rewards</a>
                <div class="dropdown-divider"></div>
                <a href="/Jenis_Transaksi/pembelian" class="dropdown-item">
                    <i class="fas fa-cart-plus mr-2"></i>Pembelian</a>
                <div class="dropdown-divider"></div>
                <a href="/Jenis_Transaksi/punishment" class="dropdown-item">
                    <i class="fas fa-clipboard mr-2"></i>Punishment</a>
                <div class="dropdown-divider"></div>
                <a href="/Jenis_Transaksi/misi_tambah" class="dropdown-item">
                    <i class="fas fa-clipboard-list mr-2"></i>Misi Tambahan</a>
                <div class="dropdown-divider"></div>
                <a href="/Jenis_Transaksi/konsultasi" class="dropdown-item">
                    <i class="fas fa-clipboard-list mr-2"></i>Konsultasi</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a href="/Badges" class="nav-link">
                <i class="fas fa-ribbon"> Badges</i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#/Admin/market_place" class="nav-link">
                <i class="fas fa-cart-plus"> Market Place</i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-newspaper"> Gaya Belajar</i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
        </li>

        <!-- <php endif; ?> -->

    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-clock"> <?php echo date(' d F Y '); ?></i>
                <!-- date_default_timezone_set('Asia/Jakarta'); echo date(' d-M-Y / H:i:s a'); -->
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="/profile/<?= user()->id; ?>" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="/logout" class="dropdown-item">
                    <i class="fas fa-reply"></i> Logout
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>