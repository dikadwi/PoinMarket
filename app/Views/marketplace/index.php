<?= $this->extend('User/template/dashboard'); ?>

<?= $this->section('content_user'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <center>
                        <h1 class="text-center">Marketplace</h1>
                    </center>
                    <p class="text-center">
                        Welcome, <?= $username ?> . <?= $npm ?> <br>
                        Points: <strong><?= $mahasiswa['point'] ?></strong>
                    </p>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/Role_User">User</a></li>
                        <li class="breadcrumb-item active"> <?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <!-- Reward Transactions -->
        <h3>Reward</h3>
        <div class="row mb-4">
            <?php if (!empty($datatransaksi)): ?>
                <?php $no_more_rewards = true; ?>
                <?php foreach ($datatransaksi as $item): ?>
                    <?php if ($item['claim'] === 'Belum'): // Hanya tampilkan jika reward belum diambil 
                    ?>
                        <div class="col-md-3 mb-4">
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
        <!-- Reward Card -->
        <div class="row mb-4">
            <?php foreach ($transaksi as $item): ?>
                <?php if ($item['kode_jenis'] == '102'): // Pembelian 
                ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="https://gapsystudio.com/storage/1746/gamification-in-ux-11zon.webp" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                                <p class="card-text">Point Harga : <strong><?= $item['poin_digunakan'] ?></strong></p>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= base_url('Role_User/market/buy') ?>" method="post" class="buy-form">
                                        <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                        <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                        <button type="submit" class="btn btn-primary btn-beli">Buy</button>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalDetail">Detail</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Pembelian Transactions -->
        <h3>Misi Tambahan</h3>
        <!-- Reward Card -->
        <div class="row mb-4">
            <?php foreach ($transaksi as $item): ?>
                <?php if ($item['kode_jenis'] == '105'): // Pembelian 
                ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="https://elearningindustry.com/wp-content/uploads/2014/07/Gamification_article.jpg" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                                <p class="card-text">Point Diperoleh : <strong><?= $item['poin_digunakan'] ?></strong></p>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= base_url('Role_User/market/misi_tambah') ?>" method="post" class="misi-form">
                                        <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                        <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                        <button type="submit" class="btn btn-success btn-misi">Complete Mission</button>
                                    </form>
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