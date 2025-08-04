<?= $this->extend('PoinMarket_Admin/Template/dashboard') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-bell mr-2"></i>Detail Notifikasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('notifications') ?>">Notifikasi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php
                        $icon = 'info-circle text-info';
                        if (isset($notification['type'])) {
                            switch ($notification['type']) {
                                case 'success':
                                    $icon = 'check-circle text-success';
                                    break;
                                case 'warning':
                                    $icon = 'exclamation-circle text-warning';
                                    break;
                                case 'error':
                                    $icon = 'times-circle text-danger';
                                    break;
                            }
                        }
                        ?>
                        <i class="fas fa-<?= $icon ?> mr-2"></i>
                        <?= esc($notification['title']) ?>
                    </h3>
                    <div class="card-tools">
                        <small class="text-muted">
                            <i class="far fa-clock mr-1"></i>
                            <?= date('d M Y H:i', strtotime($notification['created_at'])) ?>
                        </small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5>Pesan:</h5>
                                <p><?= nl2br(esc($notification['message'])) ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($notification['reference_id'])) : ?>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="callout callout-warning">
                                    <h5>Referensi:</h5>
                                    <p>
                                        <i class="fas fa-link mr-1"></i>
                                        <?= $notification['reference_id'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="<?= base_url('notifications') ?>" class="btn btn-default">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <?php if (!$notification['is_read']) : ?>
                            <button type="button" class="btn btn-primary mark-as-read mr-2" data-id="<?= $notification['id'] ?>">
                                <i class="fas fa-check mr-2"></i>Tandai Sudah Dibaca
                            </button>
                        <?php endif; ?>
                        <button type="button" class="btn btn-danger delete-notification" data-id="<?= $notification['id'] ?>">
                            <i class="fas fa-trash mr-2"></i>Hapus Notifikasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Handle mark as read
    $('.mark-as-read').click(function(e) {
        e.preventDefault();
        const notificationId = $(this).data('id');
        const button = $(this);
        
        $.ajax({
            url: `/notifications/mark-as-read/${notificationId}`,
            type: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Notifikasi telah ditandai sebagai sudah dibaca',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        button.fadeOut();
                        if (typeof getUnreadNotifications === 'function') {
                            getUnreadNotifications();
                        }
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan saat menandai notifikasi';
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
    });

    // Handle delete notification
    $('.delete-notification').click(function(e) {
        e.preventDefault();
        const notificationId = $(this).data('id');
        
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Notifikasi telah dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Redirect ke halaman notifikasi
                                window.location.href = '/notifications';
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
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>