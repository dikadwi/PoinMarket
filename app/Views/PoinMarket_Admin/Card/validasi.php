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
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <!-- <h5 class="card-title"><b>Kode Transaksi :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['id_transaksi']; ?></h4>
                                            </li> -->
                                            <h5 class="card-title"><b>NPM :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['npm']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Nama Mahasiswa :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= isset($nama[$data['npm']]) ? $nama[$data['npm']] : '-'; ?></h4>
                                            </li>
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
                                                        case '106':
                                                            echo 'Konsultasi';
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
                                            <h5 class="card-title"><b>Poin Digunakan :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['poin_digunakan']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Tanggal Transaksi :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['tanggal_transaksi']; ?></h4>
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

<!--Data Modal Validasi-->
<?php foreach ($data_transaksi as $data) : ?>
    <div class="modal fade" id="modalValidasi<?php echo $data['id_transaksi']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $title; ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/Validasi/aksi/<?= $data['id_transaksi']; ?>" method="post" enctype="multipart/form-data">
                        <!-- <div class="form-group ">
                            <label for="id_transaksi" class="col-form-label">Kode Transaksi</label>
                           
                                <input type="number" class="form-control" id="id_transaksi" name="id_transaksi" value="<?php echo $data['id_transaksi'] ?>" required readonly>
                            </div> -->
                        <div class="form-group ">
                            <label for="jenis_transaksi" class="col-form-label">Jenis Transaksi</label>

                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value=" <?php
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
                                                                                                                        ?>" readonly>
                        </div>
                        <div class="form-group ">
                            <label for="nama_transaksi" class="col-form-label">Nama Transaksi</label>
                            <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?php echo $data['nama_transaksi'] ?>" readonly>
                        </div>
                        <div class="form-group ">
                            <label for="npm" class="col-form-label">NPM</label>
                            <input type="number" class="form-control" id="npm" name="npm" value="<?php echo $data['npm'] ?>" readonly>
                        </div>
                        <div class="form-group ">
                            <label for="validation" class="col-form-label">Validasi</label>
                            <select name="validation" id="validation" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                                <option value="Sudah">Ya</option>
                                <option value="Belum">Tidak</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Validasi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>
        </div>
    </div>
<?php endforeach ?>