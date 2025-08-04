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
                        <a href="/Role_User/wallet" class="nav-link">
                            <i class="nav-icon fas fa-wallet"><span> Wallet</span></i>
                        </a>
                    </li> -->
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
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <span> <i class="nav-icon far fa-clock"> <?php echo date(' d F Y '); ?></i></span>
                        <!-- date_default_timezone_set('Asia/Jakarta'); echo date(' d-M-Y / H:i:s a'); -->
                    </a>
                </li>
                <!-- Notifikasi -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" id="notificationDropdown">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge" id="unreadNotificationCount">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notification-dropdown" id="notificationList">
                        <div class="dropdown-header bg-primary text-white py-2 px-3 d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-bell mr-2"></i>Notifikasi</span>
                            <div>
                                <a href="#" class="text-white mark-all-read mr-2" title="Tandai semua telah dibaca">
                                    <i class="fas fa-check-double"></i>
                                </a>
                                <a href="#" class="text-white refresh-notifications" title="Muat ulang notifikasi">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="notification-items">
                            <!-- Notifications will be inserted here -->
                            <div class="dropdown-item text-center py-3 text-muted empty-notification">
                                <i class="fas fa-info-circle mr-2"></i>Tidak ada notifikasi baru
                            </div>
                        </div>
                        <!-- <a href="<?= base_url('notifications') ?>" class="dropdown-item text-center bg-light py-2">
                            <i class="fas fa-eye mr-1"></i>Lihat Semua Notifikasi
                        </a> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
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
                            <div class="dropdown-header bg-primary text-white py-2 px-3 d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-user mr-2"></i><?= $nama ?></span>
                            </div>          
                            <div class="dropdown-divider"></div>
                            <a href="/Role_User/profile" class="dropdown-item">
                                <i class="fas fa-id-card mr-2"></i> Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logoutM" class="dropdown-item">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
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

        <style>
        .notification-dropdown {
            width: 350px;
            padding: 0;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .notification-items {
            max-height: 400px;
            overflow-y: auto;
        }
        .notification-items .dropdown-item {
            white-space: normal;
            border-bottom: 1px solid #f1f1f1;
            padding: 0.75rem 1rem;
        }
        .notification-items .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .notification-items .text-wrap {
            word-break: break-word;
        }
        .notification-items .x-small {
            font-size: 0.75rem;
        }
        .refresh-notifications:hover {
            transform: rotate(180deg);
            transition: transform 0.5s;
        }
        .empty-notification {
            color: #6c757d;
            background-color: #f8f9fa;
        }
    </style>

    <script>
    function formatTimeAgo(date) {
        const now = new Date();
        const diffInSeconds = Math.floor((now - new Date(date)) / 1000);
        
        if (diffInSeconds < 60) return `${diffInSeconds} detik yang lalu`;
        
        const diffInMinutes = Math.floor(diffInSeconds / 60);
        if (diffInMinutes < 60) return `${diffInMinutes} menit yang lalu`;
        
        const diffInHours = Math.floor(diffInMinutes / 60);
        if (diffInHours < 24) return `${diffInHours} jam yang lalu`;
        
        const diffInDays = Math.floor(diffInHours / 24);
        if (diffInDays < 7) return `${diffInDays} hari yang lalu`;
        
        return new Date(date).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Icon tidak berguna
    function getNotificationIcon(type) {
        const icons = {
            'transaksi': 'fas fa-exchange-alt text-primary',
            'validasi': 'fas fa-clipboard-check text-info',
            'success': 'fas fa-check-circle text-success',
            'peringatan': 'fas fa-exclamation-triangle text-warning',
            'error': 'fas fa-times-circle text-danger',
            'info': 'fas fa-info-circle text-info'
        };
        return icons[type];
    }

    function getUnreadNotifications() {
        $.ajax({
            url: '<?= base_url('notifications/unread') ?>',
            method: 'GET',
            success: function(response) {
                if (response.success && response.data) {
                    const notifications = response.data;
                    $('#unreadNotificationCount').text(notifications.length);
                    
                    const container = $('.notification-items');
                    container.empty();
                    
                    if (notifications.length === 0) {
                        container.append(`
                            <div class="dropdown-item text-center py-3 text-muted empty-notification">
                                <i class="fas fa-info-circle mr-2"></i>Tidak ada notifikasi baru
                            </div>
                        `);
                    } else {
                        notifications.forEach(function(notification) {
                            const icon = getNotificationIcon(notification.type);
                            const timeAgo = formatTimeAgo(notification.created_at);
                            
                            container.append(`
                                <a href="<?= base_url('notifications/detail/') ?>/${notification.id}" class="dropdown-item">
                                    <i class="${getNotificationIcon(notification.type)} mr-2"></i>
                                    <div class="text-wrap">
                                        <div class="font-weight-bold">${notification.title}</div>
                                        <div class="text-muted small">${notification.message}</div>
                                        <div class="text-muted x-small">${timeAgo}</div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                            `);
                        });
                    }
                }
            },
            error: function() {
                console.error('Gagal mengambil notifikasi');
            }
        });
    }

    // Update notifications every 20 seconds
    $(document).ready(function() {
        // Get initial notifications
        getUnreadNotifications();

        // Refresh notifications every 20 seconds
        setInterval(getUnreadNotifications, 20000);

        // Handle manual refresh
        $('.refresh-notifications').click(function(e) {
            e.preventDefault();
            $(this).find('i').addClass('fa-spin');
            getUnreadNotifications().then(() => {
                setTimeout(() => {
                    $(this).find('i').removeClass('fa-spin');
                }, 500);
            });
        });

        // Handle mark all as read
        $('.mark-all-read').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('notifications/mark-all-read') ?>',
                method: 'POST',
                success: function(response) {
                    if (response.success) {
                        getUnreadNotifications();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Semua notifikasi telah ditandai sudah dibaca',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            });
        });

        // Toggle dropdown when clicking notification icon
        $('#notificationDropdown').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).parent().toggleClass('show');
            $(this).next('.dropdown-menu').toggleClass('show');
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.nav-item.dropdown').length) {
                $('.nav-item.dropdown').removeClass('show');
                $('.dropdown-menu').removeClass('show');
            }
        });
    });
    </script>
</nav>