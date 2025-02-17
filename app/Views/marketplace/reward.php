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
                    <center>
                        <h1 class="text-center">Reward</h1>
                    </center>
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
        <!-- Reward Card -->
        <div class="row mb-4">
            <?php if (!empty($datatransaksi)): ?>
                <?php $no_more_rewards = true; ?>
                <?php foreach ($datatransaksi as $item): ?>
                    <?php if ($item['claim'] === 'Belum'): // Menampilkan Data Reward jika reward belum diambil dengan status claim "Belum" 
                    ?>
                        <div class="col-6 col-md-3">
                            <div class="card">

                                <!-- <img src="https://cdn.prod.website-files.com/64889df33626cba8b4463219/6580a6236b0c485a43d21338_620ebadbfc0b50324e0a295b_Gamification_Blog-Feat-Image_1080x680.webp" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>"> -->
                                <div class="card-body">
                                    <h5 class="card-title"><strong><?= esc($item['nama_transaksi']) ?></strong></h5>
                                    <p class="card-text">
                                        Point Diperoleh: <?= esc($item['poin_diberikan']) ?>
                                    </p>
                                    <button type="button" class="btn btn-pembuat btn-danger d-inline-block text-center opacity-50" data-toggle="modal" data-target="#modalPembuat<?= esc($item['id_transaksi']) ?>">
                                        <i class="fas fa-user"></i> <!-- Ikon di atas teks -->
                                        <!-- tambahkan pemberi reward -->
                                        <span><?= $item['creator'] ?></span>
                                    </button>
                                </div>
                                <div class="card-footer">
                                    <div class="row d-flex justify-content-center">
                                        <!-- Tombol Buy -->
                                        <div class="col-6 col-md-4 mb-2 mb-md-0">
                                            <form action="<?= base_url('Role_User/market/claim') ?>" method="post" class="claim-form">
                                                <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">
                                                <input type="hidden" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>">
                                                <!-- <input type="hidden" name="poin_digunakan" value="<= esc($item['poin_digunakan']) ?>"> -->
                                                <input type="hidden" name="poin_diberikan" value="<?= esc($item['poin_diberikan']) ?>">
                                                <button type="submit" class="btn btn-success btn-block btn-claim d-flex flex-column align-items-center">
                                                    <i class="fas fa-gift"></i>
                                                    <span class="d-none d-md-inline">Claim</span>
                                                </button>
                                                <!-- Tambahkan button validasi untuk mengambil Reward -->
                                            </form>
                                        </div>

                                        <!-- Tombol Detail -->
                                        <div class="col-6 col-md-4 mb-2 mb-md-0">
                                            <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">
                                                <i class="fas fa-eye"></i> <!-- Ikon di atas teks -->
                                                <span class="d-none d-md-inline">Detail</span> <!-- Teks di bawah ikon -->
                                            </button>
                                        </div>
                                        <!-- <?php if (in_groups('admin')) : ?>
                                            <div class="col-6 col-md-3 mb-2 mb-md-0">
                                                <button type="button" class="btn btn-warning btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalEdit<?= esc($item['id_transaksi']) ?>">
                                                    <i class="fas fa-edit"></i>
                                                    <span><span class="d-none d-md-inline">Edit</span>
                                                </button>
                                            </div>
                                            <div class="col-6 col-md-3 mb-2 mb-md-0">
                                                <button type="button" class="btn btn-danger btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalEdit<?= esc($item['id_transaksi']) ?>">
                                                    <i class="fas fa-edit"></i>
                                                    <span class="d-none d-md-inline">Validasi</span>
                                                </button>
                                            </div>
                                        <?php endif; ?> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $no_more_rewards = false; ?>
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
                                        <strong>Point Harga:</strong> <?= esc($item['poin_digunakan']) ?><br>
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
                <!-- Jika tidak ada reward yang bisa diklaim (reward sudah diambil atau semua reward sudah 'claim' = 'Sudah') -->
                <?php if ($no_more_rewards): ?>
                    <div class="col-12">
                        <p class="text-center">Tidak ada reward yang tersedia saat ini.</p>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">Tidak Ada Reward yang tersedia saat ini.</p>
                </div>
            <?php endif; ?>
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