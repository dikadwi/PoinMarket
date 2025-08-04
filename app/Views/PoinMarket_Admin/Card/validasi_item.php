<!-- Card -->
<div class="row">
    <?php
    // Cari data transaksi berdasarkan kata kunci
    if (isset($_GET['search'])) {
        $search = strtolower($_GET['search']);  // Mengonversi kata kunci pencarian menjadi huruf kecil
        $transaksi = array_filter($transaksi, function ($data) use ($search) {
            // Mengonversi data transaksi dan search menjadi huruf kecil
            return strpos(strtolower(strval($data['id_transaksi'])), $search) !== false ||
                strpos(strtolower(strval($data['nama_transaksi'])), $search) !== false ||
                strpos(strtolower(strval($data['poin_digunakan'])), $search) !== false;
        });
    }


    // Tampilkan card untuk setiap transaksi
    if (empty($transaksi) || (isset($creator) && empty(array_filter($transaksi, function ($t) use ($creator) {
        return $t['creator'] == $creator;
    })))) : ?>
        <div class="col-12 text-center">
            <h5 class="text-muted"><strong>Tidak ada data yang tersedia.</strong></h5>
        </div>
    <?php else : ?>
        <?php $i = 1; ?>
        <?php foreach ($transaksi as $t) : ?>
            <?php if (isset($creator) && $t['creator'] != $creator) continue; ?>
            <div class="col-6 col-md-3 d-flex">
                <div class="card flex-fill d-flex flex-column">
                    <!-- Card Header -->
                    <div class="card-header text-center">
                        <h5 class="card-title"><strong><?= $t['nama_transaksi']; ?></strong></h5>
                    </div>

                    <!-- Card Image -->
                    <div class="card-img-container">
                        <img src="<?= base_url('uploads/' . $t['gambar']); ?>"
                            class="card-img-top"
                            alt="Gambar_Item"
                            style="width: 100%; height: auto;">
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <p class="card-text">
                            <!-- Kategori -->
                            <!-- <strong>Kategori:</strong> <= $t['kode_jenis']; ?><br> -->
                            <!-- Rule Item -->
                            <strong>Rule Item:</strong> <?= $t['detail']; ?><br>
                            <!-- Feedback -->
                            <strong>Feedback:</strong> <?= $t['keterangan']; ?><br>
                            <!-- Poin (Reward, Penalti, atau Harga) -->
                            <!-- Untuk Poin Harga -->
                            <?php if (in_array($t['kode_jenis'], ['102', '103', '105', '106'])) : ?>
                                <strong>
                                    <?php
                                    if ($t['kode_jenis'] == '103') {
                                        echo 'Penalti :';
                                    } else {
                                        echo 'Harga :';
                                    }
                                    ?>
                                </strong> <?= $t['poin_digunakan']; ?> Point <br>
                            <?php endif; ?>
                            <!-- Reward Untuk Kode Jenis 101 dan 105 -->
                            <?php if (in_array($t['kode_jenis'], ['101', '105'])) : ?>
                                <strong>Reward:</strong> <?= $t['poin_diberikan']; ?> Point<br>
                            <?php endif; ?>
                            <?php
                            $status = esc($t['valid']);
                            if ($status == 'Yes') {
                                $statusText = 'Tervalidasi';
                                $btnClass = 'btn-success';
                            } elseif ($status == 'No') {
                                $statusText = 'Tidak Tervalidasi';
                                $btnClass = 'btn-danger';
                            } elseif ($status == 'Wait') {
                                $statusText = 'Menunggu Validasi';
                                $btnClass = 'btn-warning';
                            } else {
                                $statusText = $status; // Jika status tidak sesuai dengan Yes atau No
                                $btnClass = 'btn-secondary';
                            }
                            ?>
                            <strong>Status :</strong>
                            <button type="button" class="btn btn-sm <?= $btnClass ?> d-inline-block mb-2">
                                <?= $statusText ?>
                            </button><br>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between mb-2 mx-3">
                        <!-- Creator -->
                        <!-- <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center">
                    <i class="fas fa-user"></i>
                    <span class="d-none d-md-inline"><?= $t['creator']; ?></span>
                </button> -->
                        <button type="button" class="btn btn-pembuat btn-primary d-inline-block text-center opacity-50" data-toggle="modal" data-target="">
                            <i class="fas fa-user"></i> <!-- Ikon di atas teks -->
                            <span> <?= $t['creator']; ?></span> <!-- Teks di bawah ikon -->
                        </button>
                    </div>
                    <!-- Card Footer (Tombol Aksi) -->
                    <div class="card-footer">
                        <div class="row d-flex justify-content-center">
                            <!-- Tombol Detail -->
                            <div class="col-6 col-md-3 mb-2 mb-md-0">
                                <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($t['id_transaksi']) ?>">
                                    <i class="fas fa-eye"></i>
                                    <span class="d-none d-md-inline"> Detail</span>
                                </button>
                            </div>
                            <!-- Tombol Validasi -->
                            <?php if (in_groups(['superadmin', 'admin'])) : ?>
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-secondary btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalValidasi<?= esc($t['id_transaksi']) ?>">
                                        <i class="fas fa-check-circle"></i> <!-- Ikon di atas teks -->
                                        <span class="d-none d-md-inline">Validasi</span> <!-- Teks di bawah ikon -->
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
<?php foreach ($transaksi as $t) : ?>
    <div class="modal fade" id="modalDetail<?php echo $t['id_transaksi']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-list mr-2"></i>Detail Item #<?= $t['id_transaksi']; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>Id Transaksi
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['id_transaksi']; ?>" readonly>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>Nama Item
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['nama_transaksi']; ?>" readonly>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label>
                            <i class="fas fa-layer-group mr-2"></i>Rule Item
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['detail']; ?>" readonly>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label>
                            <i class="fas fa-layer-group mr-2"></i>Feedback
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['keterangan']; ?>" readonly>
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
                            <i class="fas fa-user mr-2"></i>Creator
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['creator']; ?>" readonly>
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

<!-- Modal Validasi -->
<?php foreach ($transaksi as $t) : ?>
    <div class="modal fade" id="modalValidasi<?= esc($t['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit mr-2"></i>Validasi Item #<?= $t['id_transaksi']; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <form action="<?= base_url('/Validasi_Item/aksi/' . esc($t['id_transaksi'])) ?>" method="post">
                        <input type="hidden" name="id_transaksi" value="<?= esc($t['id_transaksi']) ?>">

                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag mr-2"></i>Nama Item
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['nama_transaksi']; ?>" readonly>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label>
                            <i class="fas fa-layer-group mr-2"></i>Rule Item
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['detail']; ?>" readonly>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label>
                            <i class="fas fa-layer-group mr-2"></i>Feedback
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['keterangan']; ?>" readonly>
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
                            <i class="fas fa-user mr-2"></i>Creator
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $t['creator']; ?>" readonly>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label>
                            <i class="fas fa-check-circle mr-2"></i>Validasi
                        </label>
                        <select class="form-control" id="valid" name="valid">
                            <option value="Validasi" <?= ($t['valid'] == 'Validasi') ? 'selected' : '' ?>>Validasi</option>
                            <option value="Tidak" <?= ($t['valid'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
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