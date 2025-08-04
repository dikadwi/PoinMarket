<?= $this->extend('PoinMarket_Admin/Template/dashboard') ?>

<?= $this->section('content') ?>
<?php
// Helper function untuk badge class
function getNotificationBadgeClass($type) {
    $classes = [
        'transaksi' => 'primary',
        'validasi' => 'info',
        'success' => 'success',
        'peringatan' => 'warning',
        'error' => 'danger',
        'info' => 'info'
    ];
    return isset($classes[$type]) ? $classes[$type] : 'secondary';
}

// Helper function untuk mendapatkan URL tujuan
function getNotificationUrl($notification) {
    $type = $notification['type'];
    $referenceId = $notification['reference_id'];
    
    switch ($type) {
        case 'validasi':
            return base_url('Validasi');
        case 'transaksi':
            return base_url('Transaksi');
        case 'reward':
            return base_url('Transaksi/reward');
        case 'punishment':
            return base_url('Transaksi/punishment');
        case 'konsultasi':
            return base_url('Transaksi/konsultasi');
        default:
            // Jika ada reference_id, gunakan itu sebagai URL
            if (!empty($referenceId)) {
                return $referenceId;
            }
            // Default ke detail notifikasi
            return base_url('notifications/detail/' . $notification['id']);
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-bell mr-2"></i>Notifikasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Notifikasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <a href="javascript:void(0)" class="btn btn-primary btn-block mb-3" id="refreshNotifications">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </a>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-filter mr-2"></i>Filter</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active" data-filter="all">
                                        <i class="fas fa-inbox"></i> Semua
                                        <span class="badge bg-primary float-right" id="totalCount">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-filter="unread">
                                        <i class="fas fa-envelope"></i> Belum Dibaca
                                        <span class="badge bg-warning float-right" id="unreadCount">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-filter="read">
                                        <i class="fas fa-check-circle"></i> Sudah Dibaca
                                        <span class="badge bg-success float-right" id="readCount">0</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-tag mr-2"></i>Kategori</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active" data-type="all">
                                        <i class="fas fa-inbox text-primary"></i> Semua
                                        <span class="badge bg-primary float-right" id="total-count">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-type="info">
                                        <i class="fas fa-info-circle text-info"></i> Informasi
                                        <span class="badge bg-info float-right" id="info-count">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-type="transaksi">
                                        <i class="fas fa-exchange-alt text-primary"></i> Transaksi
                                        <span class="badge bg-primary float-right" id="transaction-count">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-type="validasi">
                                        <i class="fas fa-exclamation-circle text-danger"></i> Validasi
                                        <span class="badge bg-danger float-right" id="validation-count">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-type="success">
                                        <i class="fas fa-check-circle text-success"></i> Sukses
                                        <span class="badge bg-success float-right" id="success-count">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-type="warning">
                                        <i class="fas fa-exclamation-circle text-warning"></i> Peringatan
                                        <span class="badge bg-warning float-right" id="warning-count">0</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list mr-2"></i>Daftar Notifikasi</h3>
                            <?php if (!empty($notifications)) : ?>
                                <div class="float-right">
                                    <button type="button" class="btn btn-warning" id="delete-selected" style="display: none;">
                                        <i class="fas fa-trash mr-2"></i>Hapus Terpilih
                                    </button>
                                    <button type="button" class="btn btn-danger" id="delete-all-notifications">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body p-0">
                            <?php if (empty($notifications)) : ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada notifikasi</h5>
                                </div>
                            <?php else : ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" id="check-all">
                                                        <label for="check-all"></label>
                                                    </div>
                                                </th>                                                
                                                <th width="15%">Tipe</th>
                                                <th width="40%">Pesan</th>
                                                <th width="20%">Waktu</th>
                                                <th width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($notifications as $notif) : ?>
                                                <tr class="<?= $notif['is_read'] == 0 ? 'unread bg-light' : '' ?>" data-read="<?= $notif['is_read'] == 1 ?>">
                                                    <td>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" class="notification-check" id="check<?= $notif['id'] ?>" data-id="<?= $notif['id'] ?>">
                                                            <label for="check<?= $notif['id'] ?>"></label>
                                                        </div>
                                                    </td>                                                    
                                                    <td>
                                                        <span class="badge badge-<?= getNotificationBadgeClass($notif['type']) ?>">
                                                            <?= ucfirst($notif['type']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= getNotificationUrl($notif) ?>" class="text-dark notification-link" data-id="<?= $notif['id'] ?>">
                                                            <?php if ($notif['is_read'] == 0) : ?>
                                                                <i class="fas fa-circle text-warning mr-1" style="font-size: 0.5rem; vertical-align: middle;"></i>
                                                            <?php endif; ?>
                                                            <strong><?= $notif['title'] ?></strong><br>
                                                            <small><?= $notif['message'] ?></small>
                                                        </a>
                                                    </td>
                                                    <td><?= date('d M Y H:i', strtotime($notif['created_at'])) ?></td>
                                                    <td>
                                                        <a href="<?= base_url('notifications/detail/' . $notif['id']) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm delete-notification" data-id="<?= $notif['id'] ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Update counters
    function updateCounters() {
        // Hitung total notifikasi
        const total = $('tbody tr').length;
        $('#totalCount, #total-count').text(total);

        // Hitung berdasarkan status baca menggunakan is_read
        const unread = $('tbody tr.unread').length;
        const read = total - unread;
        $('#unreadCount').text(unread);
        $('#readCount').text(read);

        // Hitung berdasarkan tipe notifikasi
        const infoCount = $('tbody tr td:nth-child(2) .badge:contains("Info")').length;
        const transaksiCount = $('tbody tr td:nth-child(2) .badge:contains("Transaksi")').length;
        const validasiCount = $('tbody tr td:nth-child(2) .badge:contains("Validasi")').length;
        const successCount = $('tbody tr td:nth-child(2) .badge:contains("Success")').length;
        const warningCount = $('tbody tr td:nth-child(2) .badge:contains("Peringatan")').length;

        $('#info-count').text(infoCount);
        $('#transaction-count').text(transaksiCount);
        $('#validation-count').text(validasiCount);
        $('#success-count').text(successCount);
        $('#warning-count').text(warningCount);
    }

    // Initialize counters
    updateCounters();

    // Filter notifications
    $('.nav-link[data-filter]').click(function(e) {
        e.preventDefault();
        const filter = $(this).data('filter');
        
        $('.nav-link[data-filter]').removeClass('active');
        $(this).addClass('active');

        $('tbody tr').hide();
        if (filter === 'all') {
            $('tbody tr').show();
        } else if (filter === 'unread') {
            $('tbody tr.unread').show();
        } else if (filter === 'read') {
            $('tbody tr:not(.unread)').show();
        }
    });

    // Filter by type
    $('.nav-link[data-type]').click(function(e) {
        e.preventDefault();
        const type = $(this).data('type');
        
        $('.nav-link[data-type]').removeClass('active');
        $(this).addClass('active');

        $('tbody tr').hide();
        if (type === 'all') {
            $('tbody tr').show();
        } else {
            $('tbody tr').each(function() {
                const notifType = $(this).find('td:nth-child(2) .badge').text().toLowerCase();
                if (notifType.includes(type)) {
                    $(this).show();
                }
            });
        }
    });

    // Update counters after any changes
    function refreshCounters() {
        updateCounters();
    }

    // Refresh notifications
    $('#refreshNotifications').click(function() {
        location.reload();
    });

    // After delete operations
    function afterDelete() {
        refreshCounters();
        if ($('tbody tr').length === 0) {
            location.reload();
        }
    }

    // Handle checkbox changes
    $('.mailbox-messages input[type="checkbox"]').change(function() {
        const checkedCount = $('.mailbox-messages input[type="checkbox"]:checked').length;
        $('#deleteSelected').prop('disabled', checkedCount === 0);
    });

    // Mark as read
    $('.mark-as-read').click(function() {
        const button = $(this);
        const id = button.data('id');
        const row = button.closest('tr');
        
        $.ajax({
            url: `/notifications/mark-as-read/${id}`,
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    row.removeClass('unread bg-light');
                    button.remove();
                    updateCounters();
                    
                    // Update notification badge in header
                    let currentCount = parseInt($('.notification-badge').text()) || 0;
                    if (currentCount > 0) {
                        $('.notification-badge').text(currentCount - 1);
                    }
                }
            }
        });
    });

    // Mark all as read
    $('#markAllRead').click(function() {
        $.ajax({
            url: '/notifications/mark-all-read',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    $('.mailbox-messages tbody tr').removeClass('unread bg-light');
                    $('.mark-as-read').remove();
                    updateCounters();
                    
                    // Update notification badge in header
                    $('.notification-badge').text('0');
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Semua notifikasi telah ditandai sebagai dibaca',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        });
    });

    // Handle delete single notification
    $('.delete-notification').click(function(e) {
        e.preventDefault();
        const notificationId = $(this).data('id');
        const row = $(this).closest('tr');
        
        Swal.fire({
            title: 'Hapus Notifikasi?',
            text: "Notifikasi yang dihapus tidak dapat dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/notifications/delete/${notificationId}`,
                    type: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (response.success) {
                            row.fadeOut(400, function() {
                                $(this).remove();
                                afterDelete();
                            });
                            
                            if (typeof getUnreadNotifications === 'function') {
                                getUnreadNotifications();
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Notifikasi telah dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            }
        });
    });

    // Handle delete all notifications
    $('#delete-all-notifications').click(function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Hapus Semua Notifikasi?',
            text: "Semua notifikasi akan dihapus dan tidak dapat dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/notifications/delete-all',
                    type: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Semua notifikasi telah dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat menghapus notifikasi';
                        if (xhr.responseJSON && xhr.responseJSON.messages) {
                            errorMessage = xhr.responseJSON.messages;
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: errorMessage,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        });
    });

    // Handle check all
    $('#check-all').change(function() {
        $('.notification-check').prop('checked', $(this).prop('checked'));
        toggleDeleteSelected();
    });

    // Handle individual checkbox
    $('.notification-check').change(function() {
        toggleDeleteSelected();
        
        // Uncheck "check all" if any checkbox is unchecked
        if (!$(this).prop('checked')) {
            $('#check-all').prop('checked', false);
        }
        
        // Check "check all" if all checkboxes are checked
        if ($('.notification-check:checked').length === $('.notification-check').length) {
            $('#check-all').prop('checked', true);
        }
    });

    // Toggle delete selected button
    function toggleDeleteSelected() {
        const checkedCount = $('.notification-check:checked').length;
        $('#delete-selected').toggle(checkedCount > 0);
    }

    // Handle delete selected notifications
    $('#delete-selected').click(function(e) {
        e.preventDefault();
        
        const selectedIds = $('.notification-check:checked').map(function() {
            return $(this).data('id');
        }).get();
        
        if (selectedIds.length === 0) return;
        
        Swal.fire({
            title: 'Hapus Notifikasi Terpilih?',
            text: "Notifikasi yang dihapus tidak dapat dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Hapus satu per satu notifikasi yang dipilih
                let deletePromises = selectedIds.map(id => {
                    return $.ajax({
                        url: `/notifications/delete/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                });
                
                Promise.all(deletePromises)
                    .then(() => {
                        // Hapus baris dari tabel
                        selectedIds.forEach(id => {
                            $(`#check${id}`).closest('tr').fadeOut(400, function() {
                                $(this).remove();
                                afterDelete();
                            });
                        });
                        
                        // Update counter di navbar
                        if (typeof getUnreadNotifications === 'function') {
                            getUnreadNotifications();
                        }
                        
                        // Sembunyikan tombol hapus terpilih
                        $('#delete-selected').hide();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Notifikasi terpilih telah dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(error => {
                        let errorMessage = 'Terjadi kesalahan saat menghapus notifikasi';
                        if (error.responseJSON && error.responseJSON.messages) {
                            errorMessage = error.responseJSON.messages;
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: errorMessage,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
            }
        });
    });

    // Handle notification click
    $('.notification-link').click(function(e) {
        const notificationId = $(this).data('id');
        
        // Tandai notifikasi sudah dibaca
        $.ajax({
            url: `/notifications/mark-as-read/${notificationId}`,
            type: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(() => {
            // Update counter di navbar
            if (typeof getUnreadNotifications === 'function') {
                getUnreadNotifications();
            }
        });
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>