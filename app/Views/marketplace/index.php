<?= $this->extend('User/template/dashboard'); ?>

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
                        <h1 class="text-center">Market Point</h1>
                    </center>
                    <?php if ($isLoggedIn): ?>
                        <p class="text-center">
                            Welcome, <?= $username ?> . <?= $npm ?> <br>
                            Points: <strong><?= $point ?></strong>
                        </p>
                    <?php endif ?>
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
        <!-- Reward Transactions -->
        <h3>Reward</h3>
        <!-- Reward Card -->
        <div class="row mb-4">
            <?php if (!empty($datatransaksi)): ?>
                <?php $no_more_rewards = true; ?>
                <?php foreach ($datatransaksi as $item): ?>
                    <?php if ($item['claim'] === 'Belum'): // Menampilkan Data Reward jika reward belum diambil dengan status claim "Belum" 
                    ?>
                        <div class="col-6 col-md-3">
                            <div class="card">
                                <img src="https://cdn.prod.website-files.com/64889df33626cba8b4463219/6580a6236b0c485a43d21338_620ebadbfc0b50324e0a295b_Gamification_Blog-Feat-Image_1080x680.webp" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><strong><?= esc($item['nama_transaksi']) ?></strong></h5>
                                    <p class="card-text">Point Diperoleh: <?= esc($item['poin_digunakan']) ?></p>
                                    <div class="d-flex justify-content-center">
                                        <form action="<?= base_url('Role_User/market/claim') ?>" method="post">
                                            <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">
                                            <input type="hidden" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>">
                                            <button type="submit" class="btn btn-info">Claim Point</button>
                                            <!-- Tambahkan button validasi untuk mengambil Reward -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $no_more_rewards = false; ?>
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

        <!-- Pembelian Transactions -->
        <h3>Pembelian</h3>
        <!-- Buy Card -->
        <div class="row mb-4">
            <?php foreach ($transaksi as $item): ?>
                <?php if ($item['kode_jenis'] == '102'): // kode_jenis Pembelian 
                ?>
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <img src="https://gapsystudio.com/storage/1746/gamification-in-ux-11zon.webp" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                                <p class="card-text">Point Harga : <strong><?= $item['poin_digunakan'] ?></strong></p>
                                <div class="d-flex justify-content-center">
                                    <!-- <form action="<?= base_url('Role_User/market/buy') ?>" method="post" class="buy-form"> -->
                                    <form action="<?= base_url('market/buy') ?>" method="post" class="buy-form mr-2">
                                        <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                        <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                        <button type="submit" class="btn btn-primary btn-beli">Buy</button>
                                    </form>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">Detail</button>
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
        </div>

        <!-- Pembelian Transactions -->
        <h3>Misi Tambahan</h3>
        <!-- Mission Card -->
        <div class="row mb-4">
            <?php foreach ($transaksi as $item): ?>
                <?php if ($item['kode_jenis'] == '105'): // kode_jenis Misi Tambahan 
                ?>
                    <div class="col-6 col-md-3">
                        <!-- <div class="col-md-3 mb-4"> -->
                        <div class="card">
                            <img src="https://elearningindustry.com/wp-content/uploads/2014/07/Gamification_article.jpg" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                                <p class="card-text">Point Diperoleh : <strong><?= $item['poin_digunakan'] ?></strong></p>
                                <div class="d-flex justify-content-center">
                                    <!-- <form action="<?= base_url('Role_User/market/misi_tambah') ?>" method="post" class="misi-form"> -->
                                    <form action="<?= base_url('market/misi') ?>" method="post" class="misi-form mr-2">
                                        <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                        <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                        <button type="submit" class="btn btn-success btn-misi">Complete Mission</button>
                                    </form>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">Detail</button>
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

        <!-- Konsultasi Transactions -->
        <h3>Konsultasi</h3>
        <!-- Consult Card -->
        <div class="row mb-4">
            <?php foreach ($transaksi as $item): ?>
                <?php if ($item['kode_jenis'] == '106'): // kode_jenis Konsultasi 
                ?>
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <img src="https://trierconsulting.com/wp-content/uploads/2021/07/client-1024x657.png" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                                <p class="card-text">Point Digunakan : <strong><?= $item['poin_digunakan'] ?></strong></p>
                                <div class="d-flex justify-content-center">
                                    <!-- <form action="<?= base_url('Role_User/market/konsultasi') ?>" method="post" class="misi-form"> -->
                                    <form action="<?= base_url('market/konsultasi') ?>" method="post" class="misi-form mr-2">
                                        <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                        <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                        <button type="submit" class="btn btn-success btn-konsul">Konsultasi</button>
                                    </form>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">Detail</button>
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
                                    <strong>Point Digunakan:</strong> <?= esc($item['poin_digunakan']) ?><br>
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


<?= $this->endsection(); ?>