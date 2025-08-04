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
                    <div class="card-img-container">
                        <img src="<?= base_url('uploads/' . $t['gambar']); ?>"
                            class="card-img-top"
                            alt="Gambar_Item"
                            style="width: 100%; height: auto;">
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
                            <strong>Feedback:</strong> <?= $t['keterangan']; ?><br>
                            <strong>Harga:</strong> <?= $t['poin_digunakan']; ?> Point <br>
                            <strong>Harga:</strong> <?= $t['poin_diberikan']; ?> Point <br>
                            <!-- Atur untuk menampilkan poin digunakan dan diberikan berdasarkan kode jenis -->
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
                            <?php if (in_groups(['superadmin', 'admin', 'dosen'])) : ?>
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-secondary btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalValidasi<?= esc($t['id_transaksi']) ?>">
                                        <i class="fas fa-check-circle"></i><span class="d-none d-md-inline"> Validasi</span>
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
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-list mr-2"></i>Detail Pesanan #<?= $data['id_transaksi']; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>NPM
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $data['npm']; ?>" readonly>
                        </div>
                    </div>      
                    <div class="form-group">
                        <label>
                            <i class="fas fa-user mr-2"></i>Nama Mahasiswa
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= isset($nama[$data['npm']]) ? $nama[$data['npm']] : '-'; ?>" readonly>
                        </div>
                    </div>      
                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>Kategori
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>                            
                            <input type="text" class="form-control" value="<?php
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
                                                    ?>" readonly>
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>Nama Transaksi
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $data['nama_transaksi']; ?>" readonly>
                        </div>
                    </div>        
                    <?php if (in_array($t['kode_jenis'], ['102', '103', '105', '106'])) : ?>
                        <div class="form-group">
                            <label>
                                <i class="fas fa-wallet mr-2"></i>Point Harga
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                </div>
                                <input type="text" class="form-control" value="<?= $t['poin_digunakan']; ?> Point" readonly>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Reward Untuk Kode Jenis 101 dan 105 -->
                    <?php if (in_array($t['kode_jenis'], ['101', '105'])) : ?>
                        <div class="form-group">
                            <label>
                                <i class="fas fa-gift mr-2"></i>Reward
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                </div>
                                <input type="text" class="form-control" value="<?= $t['poin_diberikan']; ?> Point" readonly>
                            </div>
                        </div>
                    <?php endif; ?> 
                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar mr-2"></i>Tanggal Transaksi
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $data['tanggal_transaksi']; ?>" readonly>
                        </div>
                    </div>                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal box Validasi-->
<?php foreach ($data_transaksi as $data) : ?>
    <div class="modal fade" id="modalValidasi<?php echo $data['id_transaksi']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit mr-2"></i>Validasi Pesanan #<?= $data['id_transaksi']; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                <form action="/Validasi/aksi/<?= $data['id_transaksi']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>NPM
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $data['npm']; ?>" readonly>
                        </div>
                    </div>      
                    <div class="form-group">
                        <label>
                            <i class="fas fa-user mr-2"></i>Nama Mahasiswa
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= isset($nama[$data['npm']]) ? $nama[$data['npm']] : '-'; ?>" readonly>
                        </div>
                    </div>      
                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>Kategori
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>                            
                            <input type="text" class="form-control" value="<?php
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
                                                    ?>" readonly>
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>Nama Transaksi
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $data['nama_transaksi']; ?>" readonly>
                        </div>
                    </div>        
                    <?php if (in_array($t['kode_jenis'], ['102', '103', '105', '106'])) : ?>
                        <div class="form-group">
                            <label>
                                <i class="fas fa-wallet mr-2"></i>Point Harga
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                </div>
                                <input type="text" class="form-control" value="<?= $t['poin_digunakan']; ?> Point" readonly>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Reward Untuk Kode Jenis 101 dan 105 -->
                    <?php if (in_array($t['kode_jenis'], ['101', '105'])) : ?>
                        <div class="form-group">
                            <label>
                                <i class="fas fa-gift mr-2"></i>Reward
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                </div>
                                <input type="text" class="form-control" value="<?= $t['poin_diberikan']; ?> Point" readonly>
                            </div>
                        </div>
                    <?php endif; ?> 
                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar mr-2"></i>Tanggal Transaksi
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $data['tanggal_transaksi']; ?>" readonly>
                        </div>
                    </div>      
                    <div class="form-group">
                        <label>
                            <i class="fas fa-check-circle mr-2"></i>Validasi
                        </label>
                        <select class="form-control" id="validation" name="validation">
                            <option value="Sudah" <?= ($t['validation'] == 'Sudah') ? 'selected' : '' ?>>Ya</option>
                            <option value="Belum" <?= ($t['validation'] == 'Belum') ? 'selected' : '' ?>>Tidak</option>
                        </select>
                    </div>    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-check-circle mr-2"></i> Validasi
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Tutup
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
<?php endforeach ?>