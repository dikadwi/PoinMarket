<div class="row">
    <?php if (empty($data_transaksi)) : ?>
        <div class="col-12 text-center">
            <h5 class="text-muted"><strong>Tidak ada data yang tersedia.</strong></h5>
        </div>
    <?php else : ?>
        <?php $i = 1; ?>
        <?php foreach ($data_transaksi as $t) : ?>
            <div class="col-6 col-md-3 d-flex">
                <div class="card flex-fill d-flex flex-column">
                    <div class="card-header text-center">
                        <h5 class="card-title"><strong><?= $t['nama_transaksi']; ?></strong></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <strong>NPM:</strong> <?= $t['npm']; ?><br>
                            <strong>Kategori:</strong> <?php
                                                        switch ($t['kode_jenis']) {
                                                            case '101':
                                                                echo 'Reward';
                                                                break;
                                                            case '102':
                                                                echo 'Belanja';
                                                                break;
                                                            case '103':
                                                                echo 'Punishment';
                                                                break;
                                                            case '105':
                                                                echo 'Misi';
                                                                break;
                                                            case '106':
                                                                echo 'Konsultasi';
                                                                break;
                                                            default:
                                                                echo $data['kode_jenis'];
                                                        }
                                                        ?><br>
                            <strong>Feedback:</strong> <?= $t['tanggal_transaksi']; ?><br>
                            <strong>Harga:</strong> <?= $t['poin_digunakan']; ?> Point <br>
                            <strong>Status Validasi :</strong> <?= $t['validation']; ?><br>
                        </p>
                        <!-- Card Footer untuk Tombol -->
                    </div>
                    <div class="card-footer">
                        <div class="row d-flex justify-content-center">
                            <div class="col-6 col-md-3 mb-2 mb-md-0">
                                <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($t['id_transaksi']) ?>">
                                    <i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span>
                                </button>
                            </div>
                            <?php if (in_groups(['superadmin'])) : ?>
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-warning btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalEdit<?= esc($t['id_transaksi']) ?>">
                                        <i class="fas fa-edit"></i><span class="d-none d-md-inline"> Edit</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if (in_groups(['superadmin', 'dosen'])) : ?>
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-secondary btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalValidasi<?= esc($t['id_transaksi']) ?>">
                                        <i class="fas fa-check-circle"></i><span class="d-none d-md-inline"> Validasi</span>
                                    </button>
                                </div>
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button href="/Transaksi/delete/<?= $t['id_transaksi']; ?>" class="btn btn-danger btn-hapus btn-block d-flex flex-column align-items-center">
                                        <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Hapus </span>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>