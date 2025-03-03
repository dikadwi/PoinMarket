<?= $this->extend('User/Template/dashboard'); ?>

<?= $this->section('content_user'); ?>
<?php
$session = session();
$isLoggedIn = $session->get('isLoggedIn'); // Pastikan ini sesuai dengan data sesi Anda
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Misi</h1>
                    <!-- <?php if ($isLoggedIn): ?>
                        <p class="text-center">
                            Welcome, <?= $nama ?> . <?= $npm ?> <br>
                            Points: <strong><?= $point ?></strong>
                        </p>
                    <?php endif ?> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php if ($isLoggedIn): ?>
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Role_User">User</a></li>
                            <li class="breadcrumb-item active"> <?= $title; ?></li>
                        </ol>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <section class="content">

        <!-- Mission Card -->
        <div class="row mb-4">
            <?php foreach ($transaksi as $item): ?>
                <?php if ($item['kode_jenis'] == '105'): // kode_jenis Misi Tambahan 
                ?>
                    <div class="col-6 col-md-3 d-flex">
                        <div class="card flex-fill d-flex flex-column">
                            <div class="card-img-container">
                                <img src="<?= base_url('uploads/' . $item['gambar']); ?>"
                                    class="card-img-top"
                                    alt="Gambar_Item"
                                    style="width: 100%; height: auto;">
                            </div>
                            <!-- <img src="https://elearningindustry.com/wp-content/uploads/2014/07/Gamification_article.jpg" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>"> -->
                            <div class="card-body">
                                <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                                <p class="card-text">
                                    Harga : <strong><?= $item['poin_digunakan'] ?></strong> Point<br>
                                    Reward : <strong><?= $item['poin_diberikan'] ?></strong> Point
                                </p>
                                <button type="button" class="btn btn-pembuat btn-danger d-inline-block text-center opacity-50" data-toggle="modal" data-target="#modalPembuat<?= esc($item['id_transaksi']) ?>">
                                    <i class="fas fa-user"></i> <!-- Ikon di atas teks -->
                                    <span><?= $item['creator'] ?></span> <!-- Teks di bawah ikon -->
                                </button>
                            </div>
                            <div class="card-footer">
                                <div class="row d-flex justify-content-center">
                                    <!-- <form action="<?= base_url('Role_User/market/misi_tambah') ?>" method="post" class="misi-form"> -->
                                    <!-- <div class="col-6 col-md-4 mb-2 mb-md-0"> -->
                                    <div>
                                        <form action="<?= base_url('market/misi') ?>" method="post" class="misi-form mr-2">
                                            <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                            <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                            <input type="hidden" name="poin_diberikan" value="<?= $item['poin_diberikan'] ?>">
                                            <button type="submit" class="btn btn-success btn-block btn-misi d-flex flex-column align-items-center">
                                                <i class="fas fa-rocket"></i>
                                                <span class="d-none d-md-inline">Complete Mission</span>
                                            </button>
                                        </form>
                                    </div>
                                    <!-- Tombol Detail -->
                                    <div class="col-6 col-md-4 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-eye"></i> <!-- Ikon di atas teks -->
                                            <span class="d-none d-md-inline">Detail</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="modalDetail<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDetailLabel">Detail Transaksi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <strong>Nama Transaksi:</strong> <?= esc($item['nama_transaksi']) ?><br>
                                    <strong>Detail Transaksi:</strong> <?= esc($item['detail']) ?><br>
                                    <strong>Point Diperoleh:</strong> <?= esc($item['poin_digunakan']) ?><br>
                                    <!-- Add more details as needed -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </section>
</div>

<script>
    $(document).ready(function() {
        $('.btn-beli').on('click', function() {
            $(this).find('#redeem_code').toggle();
        });
    });
</script>

<?= $this->endsection(); ?>