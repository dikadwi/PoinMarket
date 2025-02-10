<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav ">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <?php foreach ($topMenuPages as $page): ?>
            <?php if ($page['status'] === 'active'): ?> <!-- Hanya tampilkan jika status active -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= esc($page['url']); ?>">
                        <i class="fas <?= esc($page['icon']); ?>"><span> <?= esc($page['title']); ?></span></i>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <li class="nav-item">
            <a href="/dashboard" class="nav-link">
                <i class="fas fa-home"> <span> Dashboard</span></i>
            </a>
        </li>
        <!-- <php if (in_groups(['admin', 'validator'])) : ?> Mengambil 2 Role -->
        <!-- <php if (in_groups('admin')) : ?> Mengambil Role, Jika Role sesuai Menu akan tampil -->
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                <i class="fas fa-tags"> <span> Kategori Item </span></i>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                <!-- Level three dropdown-->
                <div class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">
                        <i class="fas fa-plus mr-2"></i> Add Point
                    </a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                        <li><a href="/Jenis_Transaksi/reward" class="dropdown-item"><i class="fas fa-ribbon mr-2"></i>Reward</a></li>
                        <li><a href="/Jenis_Transaksi/misi_tambah" class="dropdown-item"><i class="fas fa-bullseye mr-2"></i>Misi</a></li>
                    </ul>
                </div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">
                        <i class="fas fa-minus mr-2"></i> Deduct Point
                    </a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                        <li><a href="/Jenis_Transaksi/pembelian" class="dropdown-item"><i class="fas fa-cart-plus mr-2"></i>Pembelian</a></li>
                        <li><a href="/Jenis_Transaksi/punishment" class="dropdown-item"><i class="fas fa-flag mr-2"></i>Punishment</a></li>
                        <li><a href="/Jenis_Transaksi/konsultasi" class="dropdown-item"><i class="fas fa-comments mr-2"></i>Konsultasi</a></li>
                    </ul>
                </div>
                <!-- End Level three -->
            </ul>
        </li>
        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <-- <i class="fas fa-tags"> <span> Jenis Transaksi</span></i> Ganti ikon sesuai kebutuhan ->
                <i class="fas fa-tags"> <span>Kategori Item</span></i> <-- Ganti ikon sesuai kebutuhan ->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <-- Isi dropdown menu dengan link atau konten lain ->
                <a href="/Jenis_Transaksi/reward" class="dropdown-item">
                    <i class="fas fa-ribbon mr-2"></i>Rewards</a>
                <div class="dropdown-divider"></div>
                <a href="/Jenis_Transaksi/pembelian" class="dropdown-item">
                    <i class="fas fa-cart-plus mr-2"></i>Belanja</a>
                <div class="dropdown-divider"></div>
                <a href="/Jenis_Transaksi/punishment" class="dropdown-item">
                    <i class="fas fa-clipboard mr-2"></i>Punishment</a>
                <div class="dropdown-divider"></div>
                <a href="/Jenis_Transaksi/misi_tambah" class="dropdown-item">
                    <i class="fas fa-clipboard-list mr-2"></i>Misi Tambahan</a>
                <div class="dropdown-divider"></div>
                <a href="/Jenis_Transaksi/konsultasi" class="dropdown-item">
                    <i class="fas fa-clipboard-check mr-2"></i>Konsultasi</a>
            </div>
        </li> -->
        <li class="nav-item ">
            <a href="/Badges" class="nav-link">
                <i class="fas fa-ribbon"><span> Badges</span></i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
        </li>
        <li class="nav-item">
            <a href="/Marketplace" class="nav-link">
                <i class="fas fa-cart-plus"><span> Market Management</span></i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link">
                <i class="fas fa-newspaper"><span> Gaya Belajar</span></i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- Isi dropdown menu dengan link atau konten lain -->
                <a href="/Gaya_Belajar/visual" class="dropdown-item">
                    <i class="fas fa-eye mr-2"></i>Visual</a>
                <div class="dropdown-divider"></div>
                <a href="/Gaya_Belajar/audio" class="dropdown-item">
                    <i class="fas fa-headphones-alt mr-2"></i>Audio</a>
                <div class="dropdown-divider"></div>
                <a href="/Gaya_Belajar/kinestetik" class="dropdown-item">
                    <i class="fas fa-running mr-2"></i>Kinestetik</a>
            </div>
        </li>

        <!-- <php endif; ?> -->

    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <span><i class="nav-icon fa fa-clock"> <?php echo date(' d F Y '); ?></i></span>
                <!-- date_default_timezone_set('Asia/Jakarta'); echo date(' d-M-Y / H:i:s a'); -->
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <span class="dropdown-item dropdown-header"><?= $username ?></span>
                <div class="dropdown-divider"></div>
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