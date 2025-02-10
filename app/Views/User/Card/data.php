<div class="row">
    <?php if (empty($data_transaksi)) : ?>
        <!-- untuk pembelian dapat menggunakan kode redeem dan point -->
        <!-- Ketika kode redeem sudah terpakai ganti status kodenya agar tidak dapat dipakai lagi -->
        <!-- tampilkan item dengan status sudah diverifikasi oleh dosen -->
        <div class="col-12 text-center">
            <p class="text-muted"><strong>Tidak ada data yang tersedia.</strong></p>
        </div>
    <?php else : ?>
        <?php $tampil_data = false; ?>
        <?php $i = 1; ?>
        <?php foreach ($data_transaksi as $t) : ?>
            <?php if ($t['validation'] == 'Sudah'): ?>
                <?php $tampil_data = true; ?>
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
                        <div class="card-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#modalDetail<?php echo $t['id_transaksi']; ?>">
                                <i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if (!$tampil_data) : ?>
            <div class="col-12 text-center">
                <p class="text-muted"><strong>Tidak ada data yang tersedia.</strong></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Modal box Detail -->
<?php foreach ($data_transaksi as $data) : ?>
    <div class="modal fade" id="modalDetail<?php echo $data['id_transaksi']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail Transaksi <?= $data['npm']; ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <div class="col-lg-13">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <!-- <h5 class="card-title"><b>Kode Transaksi :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['id_transaksi']; ?></h4>
                                            </li> -->
                                            <h5 class="card-title"><b>Jenis Transaksi :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?php
                                                    switch ($data['kode_jenis']) {
                                                        case '101':
                                                            echo 'Reward';
                                                            break;
                                                        case '102':
                                                            echo 'Pembelian';
                                                            break;
                                                        case '103':
                                                            echo 'Punishment';
                                                            break;
                                                        case '105':
                                                            echo 'Misi Tambahan';
                                                            break;
                                                        default:
                                                            echo $data['kode_jenis'];
                                                    }
                                                    ?>
                                                </h4>
                                            </li>
                                            <h5 class="card-title"><b>Nama Transaksi:</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['nama_transaksi']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>NPM :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['npm']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Poin Digunakan :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['poin_digunakan']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Tanggal Transaksi :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= date('Y-m-d', strtotime($data['tanggal_transaksi'])); ?></h4>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>