<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- <nav class="main-header navbar navbar-expand-md navbar-light navbar-white"> -->
    <div class="container">
        <!-- Left navbar links -->
        <!-- <a href="/Role_User" class="navbar-brand">
            <img src="/img/market.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-bold">Point Market</span>
        </a> -->
        <!-- <button class="navbar-toggler order-1 collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <?php
                $session = session();
                $isLoggedIn = $session->get('isLoggedIn'); // Pastikan ini sesuai dengan data sesi Anda
                ?>
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <a href="/Role_User" class="nav-link">
                            <i class="nav-icon fa fa-home"><span> Dashboard</span></i>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-shopping-cart"><span> Pembelian</span></i> 
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="/Role_User/my_reward" class="dropdown-item">
                                <i class="fas fa-ribbon mr-2"></i>Rewards</a>
                            <div class="dropdown-divider"></div>
                            <a href="/Role_User/my_pembelian" class="dropdown-item">
                                <i class="fas fa-cart-plus mr-2"></i>Belanja</a>
                            <div class="dropdown-divider"></div>
                            <a href="/Role_User/my_punishment" class="dropdown-item">
                                <i class="fas fa-clipboard mr-2"></i>Punishment</a>
                            <div class="dropdown-divider"></div>
                            <a href="/Role_User/my_misi" class="dropdown-item">
                                <i class="fas fa-clipboard-list mr-2"></i>Misi Tambahan</a>
                            <div class="dropdown-divider"></div>
                            <a href="/Role_User/my_konsultasi" class="dropdown-item">
                                <i class="fas fa-clipboard-check mr-2"></i>Konsultasi</a>
                        </div>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-tags"><span> Jenis Item</span></i> Ganti ikon sesuai kebutuhan
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            Isi dropdown menu dengan link atau konten lain
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
                            <div class="dropdown-divider"></div>
                            <a href="/Role_User/konsultasi" class="dropdown-item">
                                <i class="fas fa-clipboard-check mr-2"></i>Konsultasi</a>
                        </div>
                    </li> -->
                    <li class="nav-item">
                        <a href="/Role_User/badges" class="nav-link">
                            <i class="nav-icon fa fa-ribbon"><span> Badges</span></i>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#Challange" class="nav-link">
                            <i class="nav-icon fa fa-trophy"><span> Challange</span></i>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="/Role_User/market/reward" class="nav-link">
                            <i class="nav-icon fa fa-trophy"><span> Reward</span></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/Role_User/market/misi" class="nav-link">
                            <i class="nav-icon fa fa-rocket"><span> Misi</span></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="/Role_User/market" class="nav-link">
                            <i class="nav-icon fa fa-cart-plus"><span> MarketPlace</span></i> <!-- Ganti ikon sesuai kebutuhan -->
                        </a>
                    </li>
                <?php endif ?>
            </ul>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <span> <i class="nav-icon far fa-clock"> <?php echo date(' d F Y '); ?></i></span>
                    date_default_timezone_set('Asia/Jakarta'); echo date(' d-M-Y / H:i:s a');
                </a>
            </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="nav-icon far fa-comments"> Chat</i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="nav-icon far fa-bell"> Notification</i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="nav-icon far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <?php if (!isset($nama) || empty($nama)): // Jika belum login 
                        ?>
                            <a href="/loginMhs" class="dropdown-item">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        <?php else: // Jika sudah login 
                        ?>
                            <span class="dropdown-item dropdown-header"><?= $nama; ?></span>
                            <div class="dropdown-divider"></div>
                            <a href="/Role_User/profile" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logoutM" class="dropdown-item">
                                <i class="fas fa-reply"></i> Logout
                            </a>
                        <?php endif; ?>
                    </div>
                </li>
                <!-- <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li> -->
            </ul>
        </div>
        <!-- Right navbar links -->

    </div>
</nav>