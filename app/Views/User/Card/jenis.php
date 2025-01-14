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
                        <img src="https://mycred.me/wp-content/uploads/2023/08/mycred-blog_Ecommerce-Gamification-Level-Up-Your-Online-Sales-with-Fun-and-Rewards-Social-Media.jpg"
                            class="card-img-top"
                            alt=""
                            style="width: 100%; height: auto;">
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <p class="card-text">
                            <!-- Kategori -->
                            <strong>Kategori:</strong> <?= $judul_kategori; ?><br>

                            <!-- Rule Item -->
                            <strong>Rule Item:</strong> <?= $t['detail']; ?><br>

                            <!-- Feedback -->
                            <strong>Feedback:</strong> <?= $t['keterangan']; ?><br>

                            <!-- Poin (Reward, Penalti, atau Harga) -->
                            <strong>
                                <?php
                                if ($kode_jenis == '101') {
                                    echo 'Reward :';
                                } else if ($kode_jenis == '103') {
                                    echo 'Penalti :';
                                } else {
                                    echo 'Harga :';
                                }
                                ?>
                            </strong> <?= $t['poin_digunakan']; ?> Point
                        </p>
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