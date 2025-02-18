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

// // Filter data berdasarkan role dan status validasi
// if (in_groups(['dosen'])) {
//     $transaksi = array_filter($transaksi, function ($data) {
//         return $data['valid'] == 'Yes'; // Hanya tampilkan data dengan status validasi "Yes" (Sudah)
//     });
// }

// Filter data berdasarkan status validasi
$transaksi = array_filter($transaksi, function ($data) {
    return $data['valid'] == 'Yes'; // Hanya tampilkan data dengan status validasi "Yes" (Sudah)
});

// Kelompokkan transaksi berdasarkan kode_jenis
$grouped_transaksi = [];
foreach ($transaksi as $t) {
    $kode_jenis = $t['kode_jenis'];
    if (!isset($grouped_transaksi[$kode_jenis])) {
        $grouped_transaksi[$kode_jenis] = [];
    }
    $grouped_transaksi[$kode_jenis][] = $t;
}

// Tampilkan card untuk setiap kelompok kode_jenis
foreach ($grouped_transaksi as $kode_jenis => $transaksi_group) :
    // Tentukan judul berdasarkan kode_jenis
    $judul_kategori = '';
    switch ($kode_jenis) {
        case '101':
            $judul_kategori = 'Reward';
            break;
        case '102':
            $judul_kategori = 'Belanja';
            break;
        case '103':
            $judul_kategori = 'Punishment';
            break;
        case '105':
            $judul_kategori = 'Misi';
            break;
        case '106':
            $judul_kategori = 'Konsultasi';
            break;
        default:
            $judul_kategori = 'Lainnya';
    }
?>
    <!-- Judul Kategori -->
    <h3 class="mt-4 mb-3"><?= $judul_kategori; ?></h3>

    <!-- Baris Card untuk Kategori Ini -->
    <div class="row">
        <?php foreach ($transaksi_group as $t) : ?>
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
                        <h5><strong><?= $t['keterangan']; ?> </strong></h5>
                        <strong>
                            <?php
                            if ($kode_jenis == '101' || $kode_jenis == '105') {
                                echo 'Reward :';
                            } else if ($kode_jenis == '103') {
                                echo 'Penalti :';
                            } else {
                                echo 'Harga :';
                            }
                            ?>
                        </strong> <?= $t['poin_digunakan']; ?> Point <br>
                        <?php
                        $validstatus = esc($t['valid']);
                        if ($validstatus == 'Yes') {
                            $validstatusText = 'Tervalidasi';
                        } elseif ($validstatus == 'No') {
                            $validstatusText = 'Tidak Tervalidasi';
                        } elseif ($validstatus == 'Wait') {
                            $validstatusText = 'Menunggu Validasi';
                        } else {
                            $validstatusText = $validstatus; // Jika status tidak sesuai dengan Yes atau No
                        }
                        ?>
                        <strong>Status Validasi :</strong> <?= $validstatusText ?><br>
                        <?php
                        $itemstatus = esc($t['status']);
                        if ($itemstatus == 'Yes') {
                            $itemstatusText = 'Aktif';
                        } elseif ($itemstatus == 'No') {
                            $itemstatusText = 'Tidak Aktif';
                        } else {
                            $itemstatusText = $itemstatus; // Jika status tidak sesuai dengan Yes atau No
                        }
                        ?>
                        <strong>Status Item :</strong> <?= $itemstatusText ?><br>
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

                            <!-- Dosen Hanya bisa edit dan hapus berdasarkan itemnya dan tidak bisa edit punishment -->
                            <!-- Tombol Edit (Hanya untuk Admin & Dosen) -->
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
                            <!-- Tombol Hapus (Hanya untuk SuperAdmin & Admin) -->
                            <?php if (in_groups(['superadmin', 'admin'])) : ?>
                                <!-- Tombol Validasi -->
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-secondary btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalValidasi<?= esc($t['id_transaksi']) ?>">
                                        <i class="fas fa-check-circle"></i> <!-- Ikon di atas teks -->
                                        <span class="d-none d-md-inline"> Validasi</span> <!-- Teks di bawah ikon -->
                                    </button>
                                </div>
                            <?php endif; ?>
                            <!-- Tombol Hapus (Hanya untuk SuperAdmin & Admin) -->
                            <?php if (in_groups(['superadmin', 'dosen'])) : ?>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $t['nama_transaksi']; ?> </h5>
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
                                            <h5 class="card-title"><b>Id Transaksi :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $t['id_transaksi']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Nama :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $t['nama_transaksi']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Detail :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $t['detail']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Keterangan :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $t['keterangan']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Poin :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $t['poin_digunakan']; ?></h4>
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