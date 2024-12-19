<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a href="/Role_User" class="nav-link">
                <i class="nav-icon fa fa-home"> Dashboard</i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-tags">Jenis Transaksi</i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- Isi dropdown menu dengan link atau konten lain -->
                <a href="/Role_User/reward" class="dropdown-item">
                    <i class="fas fa-ribbon mr-2"></i>Rewards</a>
                <div class="dropdown-divider"></div>
                <a href="/Role_User/pembelian" class="dropdown-item">
                    <i class="fas fa-cart-plus mr-2"></i>Pembelian</a>
                <div class="dropdown-divider"></div>
                <a href="/Role_User/punishment" class="dropdown-item">
                    <i class="fas fa-clipboard mr-2"></i>Punishment</a>
                <div class="dropdown-divider"></div>
                <a href="/Role_User/misi_tambahan" class="dropdown-item">
                    <i class="fas fa-clipboard-list mr-2"></i>Misi Tambahan</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="/Role_User/badges" class="nav-link">
                <i class="nav-icon fa fa-ribbon"> Badges</i>
            </a>
        </li>
        <li class="nav-item">
            <a href="#Challange" class="nav-link">
                <i class="nav-icon fa fa-trophy"> Challange</i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="/Role_User/market" class="nav-link">
                <i class="fas fa-cart-plus"> Market Place</i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
        </li>
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
                <span class="dropdown-item dropdown-header"><?= $username; ?></span>
                <div class="dropdown-divider"></div>
                <a href="/Role_User/profile" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="/logoutM" class="dropdown-item">
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