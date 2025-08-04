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
        <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">
                <span><i class="nav-icon far fa-clock"> <?php echo date(' d F Y '); ?></i></span>
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
                <a href="<?= base_url('notifications') ?>" class="dropdown-item text-center bg-light py-2">
                    <i class="fas fa-eye mr-1"></i>Lihat Semua Notifikasi
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-header bg-primary text-white py-2 px-3 d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-user mr-2"></i><?= $username ?></span>
                </div>                
                <div class="dropdown-divider"></div>
                <a href="/profile/<?= user()->id; ?>" class="dropdown-item">
                    <i class="fas fa-id-card mr-2"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="/logout" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>

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
                                <a href="<?= base_url('notifications/detail/') ?>/${notification.id}" class="dropdown-item notification-link" data-id="${notification.id}" data-type="${notification.type}">
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

        // Menandai notifikasi sebagai sudah dibaca saat diklik
        $('.notification-link').click(function(e) {
            e.preventDefault();
            const notificationId = $(this).data('id');
            const targetUrl = $(this).attr('href');
            const notificationType = $(this).data('type');

            console.log('Notification ID:', notificationId);
            console.log('Target URL:', targetUrl);
            console.log('Notification Type:', notificationType);

            // Tandai notifikasi sudah dibaca
            $.ajax({
                url: `/notifications/mark-as-read/${notificationId}`,
                type: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(() => {
                // Redirect ke URL target sesuai tipe
                if(notificationType === 'transaksi'){
                    window.location.href = `/transaksi/detail/${notificationId}`;
                } else if(notificationType === 'validasi'){
                    window.location.href = `/validasi/detail/${notificationId}`;
                } else {
                    window.location.href = targetUrl;
                }
            }).fail((jqXHR, textStatus, errorThrown) => {
                console.error('Error marking notification as read:', textStatus, errorThrown);
                alert('Gagal menandai notifikasi sebagai sudah dibaca.');
            });
        });
    });
    </script>
</nav>