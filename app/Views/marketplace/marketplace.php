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
                        <h1 class="text-center">MarketPlace</h1>
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
        <!-- Pembelian Transactions -->
        <!-- <h3>Pembelian</h3> -->
        <!-- Buy Card -->
        <div class="row mb-4">
            <?php foreach ($transaksi as $item): ?>
                <?php if ($item['kode_jenis'] == '102' && $item['status'] == 'Yes'): // kode_jenis Pembelian dan status valid "No" 
                    $kodeJenis = $item['kode_jenis'];
                    if ($kodeJenis == '102') {
                        $kodeJenis = 'Pembelian';
                    }
                ?>
                    <div class="col-6 col-md-3 d-flex">
                        <div class="card flex-fill d-flex flex-column">
                            <div class="card-img-container">
                                <img src="<?= base_url('uploads/' . $item['gambar']); ?>"
                                    class="card-img-top"
                                    alt="Gambar_Item"
                                    style="width: 100%; height: auto;">
                            </div>
                            <!-- <img src="https://gapsystudio.com/storage/1746/gamification-in-ux-11zon.webp" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>"> -->
                            <div class="card-body">
                                <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                                <p class="card-text">Harga : <strong><?= $item['poin_digunakan'] ?></strong> Point</p>
                                <!-- Tombol Pembuat / sesuaikan opasitas dan ambil nama dari database, tambahkan kolom pembuat item-->
                                <button type="button" class="btn btn-pembuat btn-danger d-inline-block text-center opacity-50" data-toggle="modal" data-target="#modalPembuat<?= esc($item['id_transaksi']) ?>">
                                    <i class="fas fa-user"></i> <!-- Ikon di atas teks -->
                                    <span><?= $item['creator'] ?></span> <!-- Teks di bawah ikon -->
                                </button>
                            </div>
                            <div class="card-footer">
                                <div class="row d-flex justify-content-center">
                                    <!-- <form action="<?= base_url('Role_User/market/buy') ?>" method="post" class="buy-form"> -->
                                    <div class="col-6 col-md-4 mb-2 mb-md-0">
                                        <form action="<?= base_url('market/buy') ?>" method="post" class="buy-form mr-2">
                                            <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                            <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                            <!-- <button type="submit" class="btn btn-success btn-block btn-beli d-flex flex-column align-items-center">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span class="d-none d-md-inline">Buy</span>
                                                <span id="redeem-code"></span>
                                            </button> -->
                                            <button type="button" class="btn btn-success btn-block btn-beli d-flex flex-column align-items-center">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span class="d-none d-md-inline">Buy</span>
                                                <input type="text" class="form-control" id="redeem_code" name="redeem_code" placeholder="Masukkan kode redeem" style="display: none;">
                                            </button>
                                            <!-- <div class="form-group" style="display: none;" id="redeem-code-input">
                                                <label for="redeem_code">Redeem Code</label>
                                                <input type="text" class="form-control" id="redeem_code" name="redeem_code" placeholder="Masukkan kode redeem">
                                            </div> -->
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
                                    <strong>Point Harga:</strong> <?= esc($item['poin_digunakan']) ?><br>
                                    <!-- Add more details as needed -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Pembuat -->
                    <div class="modal fade" id="modalPembuat<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalPembuatLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalPembuatLabel">Pembuat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <strong>Nama Pembuat:</strong> <br>
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

        <!-- <h3>Konsultasi</h3> -->
        <!-- Consult Card -->
        <div class="row mb-4">
            <?php foreach ($transaksi as $item): ?>
                <?php if ($item['kode_jenis'] == '106'): // kode_jenis Konsultasi 
                ?>
                    <div class="col-6 col-md-3 d-flex">
                        <div class="card flex-fill d-flex flex-column">
                            <div class="card-img-container">
                                <img src="<?= base_url('uploads/' . $item['gambar']); ?>"
                                    class="card-img-top"
                                    alt="Gambar_Item"
                                    style="width: 100%; height: auto;">
                            </div>
                            <!-- <img src="https://trierconsulting.com/wp-content/uploads/2021/07/client-1024x657.png" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>"> -->
                            <div class="card-body">
                                <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                                <p class="card-text">Point Digunakan : <strong><?= $item['poin_digunakan'] ?></strong></p>
                                <button type="button" class="btn btn-pembuat btn-danger d-inline-block text-center opacity-50" data-toggle="modal" data-target="#modalPembuat<?= esc($item['id_transaksi']) ?>">
                                    <i class="fas fa-user"></i> <!-- Ikon di atas teks -->
                                    <span><?= $item['creator'] ?></span> <!-- Teks di bawah ikon -->
                                </button>
                            </div>
                            <div class="card-footer">
                                <div class="row d-flex justify-content-center">
                                    <!-- <form action="<?= base_url('Role_User/market/konsultasi') ?>" method="post" class="misi-form"> -->
                                    <div class="col-6 col-md-4 mb-2 mb-md-0">
                                        <form action="<?= base_url('market/konsultasi') ?>" method="post" class="konsul-form mr-2">
                                            <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                            <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                            <button type="submit" class="btn btn-success btn-block btn-konsul d-flex flex-column align-items-center">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span class="d-none d-md-inline">Konsultasi</span>
                                            </button>
                                        </form>
                                    </div>
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

<script>
    $(document).ready(function() {
        $('.btn-beli').on('click', function() {
            $(this).find('#redeem_code').toggle();
        });
    });
</script>

<?= $this->endsection(); ?>