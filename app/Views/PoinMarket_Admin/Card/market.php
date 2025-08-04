<!-- Card -->
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

// Filter data berdasarkan status validasi dan kategori
$transaksi = array_filter($transaksi, function ($data) {
    // Hanya tampilkan data dengan status validasi "Yes" dan kategori 102 atau 106
    return $data['valid'] == 'Yes' && $data['status'] == 'Yes' && ($data['kode_jenis'] == '102' || $data['kode_jenis'] == '106');
});

// Kelompokkan transaksi berdasarkan kode_jenis
$grouped_transaksi = array();
foreach ($transaksi as $t) {
    $grouped_transaksi[$t['kode_jenis']][] = $t;
}

// Urutkan berdasarkan kode_jenis
ksort($grouped_transaksi);

// Loop through setiap kategori
foreach ($grouped_transaksi as $kode_jenis => $transactions) :
    // Tentukan judul berdasarkan kode_jenis
    $judul_kategori = '';
    switch ($kode_jenis) {
        case '102':
            $judul_kategori = 'Belanja';
            break;
        case '106':
            $judul_kategori = 'Konsultasi';
            break;
    }
?>
    <!-- Judul Kategori -->
    <div class="row mt-4">
        <!-- <div class="col">
            <h4><?= $judul_kategori ?></h4>
        </div> -->
    </div>

    <!-- Baris Card untuk Kategori Ini -->
    <div class="row">
        <?php foreach ($transactions as $t) : ?>
            <div class="col-6 col-md-3 d-flex">
                <div class="card flex-fill d-flex flex-column">
                    <!-- Card Header -->
                    <!-- <div class="card-header text-center">
                        <h5 class="card-title"><strong><?= $t['nama_transaksi']; ?></strong></h5>
                    </div> -->

                    <!-- Card Image -->
                    <div class="card-img-container">
                        <img src="<?= base_url('uploads/' . $t['gambar']); ?>"
                            class="card-img-top"
                            alt="Gambar_Item"
                            style="width: 100%; height: auto;">
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title"><strong><?= $t['nama_transaksi']; ?></strong></h5><br>
                        <p class="card-text"><?= $t['keterangan']; ?></p>
                        <p class="card-text">
                            <strong>
                                <!-- <php
                            if ($kode_jenis == '101' || $kode_jenis == '105') {
                                echo 'Reward :';
                            } else if ($kode_jenis == '103') {
                                echo 'Penalti :';
                            } else {
                                echo 'Harga :';
                            }
                            ?> -->
                                Harga :
                            </strong> <?= $t['poin_digunakan']; ?> Point
                        </p>
                        <!-- <php
                        $validstatus = esc($t['valid']);
                        if ($validstatus == 'Yes') {
                            $validstatusText = 'Tervalidasi';
                            $btnClass = 'btn-success';
                        } elseif ($validstatus == 'No') {
                            $validstatusText = 'Tidak Tervalidasi';
                            $btnClass = 'btn-danger';
                        } elseif ($validstatus == 'Wait') {
                            $validstatusText = 'Menunggu Validasi';
                            $btnClass = 'btn-warning';
                        } else {
                            $validstatusText = $validstatus;
                            $btnClass = 'btn-secondary';
                        }
                        ?>
                        <strong>Status Validasi :</strong> 
                        <button type="button" class="btn btn-sm <= $btnClass ?> d-inline-block">
                            <= $validstatusText ?>
                        </button><br>
                        <php
                        $itemstatus = esc($t['status']);
                        if ($itemstatus == 'Yes') {
                            $itemstatusText = 'Aktif';
                            $btnItemClass = 'btn-success';
                            $iconClass = 'fa-check';
                        } else {
                            $itemstatusText = 'Tidak Aktif';
                            $btnItemClass = 'btn-danger';
                            $iconClass = 'fa-times';
                        }
                        ?>
                        <strong>Status Item :</strong> 
                        <button type="button" class="btn btn-sm <= $btnItemClass ?> d-inline-block">
                            <i class="fas <= $iconClass ?>"></i>
                        </button> -->
                    </div>
                    <div class="d-flex justify-content-between mb-2 mx-3">
                        <!-- Creator -->
                        <button type="button" class="btn btn-pembuat btn-primary d-inline-block text-center opacity-50" data-toggle="modal" data-target="#modalCreator<?= esc($t['id_transaksi']) ?>">
                            <i class="fas fa-user"></i>
                            <span> <?= $t['creator']; ?></span>
                        </button>
                    </div>

                    <!-- Modal Creator Profile -->
                    <div class="modal fade" id="modalCreator<?= esc($t['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalCreatorLabel<?= esc($t['id_transaksi']) ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCreatorLabel<?= esc($t['id_transaksi']) ?>">Profil Creator</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <i class="fas fa-user-circle fa-5x text-primary"></i>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"><strong>Username</strong></div>
                                        <div class="col-8">: <?= $t['creator']; ?></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-4"><strong>Role</strong></div>
                                        <!-- Benahi lagi bagian Role -->
                                        <div class="col-8">:
                                            <!-- <php
                                            if (in_groups(['superadmin'])) {
                                                echo 'SuperAdmin';
                                            } elseif (in_groups(['admin'])) {
                                                echo 'Admin';
                                            } elseif (in_groups(['dosen'])) {
                                                echo 'Dosen';
                                            } else {
                                                echo 'User';
                                            }
                                            ?> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
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

                            <!-- Jadi Hapus In groups karena semua memiliki akses, hanya bedakan menggunakan filter / if -->
                            <!-- Dosen Hanya bisa edit dan hapus berdasarkan itemnya dan tidak bisa edit punishment -->
                            <!-- Tombol Edit (Superadmin | Admin & Dosen hanya mengedit item yang di create) -->
                            <?php if (in_groups(['superadmin', 'dosen'])) : ?>
                                <?php if (($t['kode_jenis'] != '103' && in_groups(['dosen']) && $t['creator'] == user()->username) || in_groups(['superadmin'])) : ?>
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-warning btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalEdit<?= esc($t['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i>
                                            <span class="d-none d-md-inline"> Edit</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <!-- Tombol Hapus (Hanya untuk SuperAdmin| Admin & Dosen hanya menghapus item yang di create) -->
                            <!-- Tombol Hapus pada Market Management berfungsi untuk menonaktifkan Item -->
                            <?php if (in_groups(['superadmin','dosen'])) : ?>
                                <?php if (($t['creator'] == user()->username && in_groups(['dosen'])) || in_groups(['superadmin'])) : ?>
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button href="/Jenis_Transaksi/delete/<?= $t['id_transaksi']; ?>" class="btn btn-danger btn-hapus btn-block d-flex flex-column align-items-center">
                                            <i class="fas fa-trash"></i>
                                            <span class="d-none d-md-inline"> Hapus</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<!-- Modal box Detail -->
<?php foreach ($transaksi as $t) : ?>
    <div class="modal fade" id="modalDetail<?php echo $t['id_transaksi']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-list mr-2"></i>Detail <b><?= $t['nama_transaksi']; ?></b>
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

<!--Data Modal Box Aktivasi Item-->
<?php foreach ($transaksi as $t) : ?>
    <div class="modal fade" id="modalEdit<?php echo $t['id_transaksi']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Aktivasi Item </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <form action="/Jenis_Transaksi/update_Jenis/<?= $t['id_transaksi']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="id" class="col-form-label">Id Transaksi</label>
                            <input type="number" class="form-control" id="id" name="id" value="<?php echo $t['id_transaksi'] ?>" required readonly>
                        </div>
                        <div class="form-group ">
                            <label for="nama_transaksi" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?php echo $t['nama_transaksi'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="detail" class="col-form-label">Rule Item</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="<?php echo $t['detail'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="keterangan" class="col-form-label">Feedback</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $t['keterangan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <!-- Menampilkan poin berdasarkan kode_jenis -->
                        <?php if (in_array($t['kode_jenis'], [102, 103, 105, 106])): ?>
                            <div class="form-group">
                                <label for="poin_digunakan" class="col-form-label">Poin Harga</label>
                                <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?php echo $t['poin_digunakan']; ?>" required>
                            </div>
                        <?php endif; ?>
                        <?php if (in_array($t['kode_jenis'], [101, 105])): ?>
                            <div class="form-group">
                                <label for="poin_diberikan" class="col-form-label">Poin Reward</label>
                                <input type="number" class="form-control" id="poin_diberikan" name="poin_diberikan" value="<?php echo isset($t['poin_diberikan']) ? $t['poin_diberikan'] : ''; ?>" required>
                            </div>
                        <?php endif; ?>
                        <div class="form-group ">
                            <label for="gambar" class="col-form-label">Gambar</label>
                            <img src="<?= base_url('uploads/' . $t['gambar']); ?>" alt="Gambar" width="100" height="100">
                            <input type="hidden" name="gambar_lama" value="<?= $t['gambar']; ?>">
                            <input type="file" class="form-control" id="gambar" name="gambar">
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status Item</label>
                            <select class="form-control" id="status" name="status" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                <option value="Yes" <?php echo ($t['status'] == 'Yes') ? 'selected' : ''; ?>>Aktif</option>
                                <option value="No" <?php echo ($t['status'] == 'No') ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <?php if (in_groups(['superadmin'])) : ?>
                            <div class="form-group ">
                                <label for="creator" class="col-form-label">Creator</label>
                                <input type="text" class="form-control" id="creator" name="creator" value="<?php echo $t['creator'] ?>">
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="creator" value="<?php echo $t['creator'] ?>">
                        <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Validasi -->
<?php foreach ($transaksi as $t) : ?>
    <div class="modal fade" id="modalValidasi<?= esc($t['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Validasi Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('/Marketplace/validasi') ?>" method="post">
                        <input type="hidden" name="id_transaksi" value="<?= esc($t['id_transaksi']) ?>">

                        <div class="form-group">
                            <label for="nama_transaksi">Nama</label>
                            <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($t['nama_transaksi']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="detail">Rule Item</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($t['detail']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Feedback</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($t['keterangan']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="poin_digunakan">Point Harga</label>
                            <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($t['poin_digunakan']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="valid">Status Validasi</label>
                            <select class="form-control" id="valid" name="valid">
                                <option value="Validasi" <?= ($t['valid'] == 'Validasi') ? 'selected' : '' ?>>Validasi</option>
                                <option value="Tidak" <?= ($t['valid'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Validasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>