<?php
// Tentukan jumlah data per halaman
$limit = 10;


// Ambil halaman saat ini dari URL, jika tidak ada, set ke 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Mengurutkan data mahasiswa secara numerik dengan NPM
usort($mahasiswa, function ($a, $b) {
    return ($a['npm'] - $b['npm']);
});

// Hitung total data
$total_data = count($mahasiswa);

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Hitung offset untuk query
$offset = ($page - 1) * $limit;

// Ambil data untuk halaman saat ini
$mahasiswa = array_slice($mahasiswa, $offset, $limit);

// Hitung data yang ditampilkan
$start = $offset + 1; // Data pertama yang ditampilkan
$end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan
?>

<!-- Tabel -->
<!-- <table class="table table-bordered border-dark table_mahasiswa"> -->
<table class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">NPM</th>
            <th scope="col">Nama</th>
            <th scope="col">
                <form action="" method="get">
                    <div class="input-group mb-2">
                        <select id="gaya_belajar" name="gaya_belajar" class="form-control form-control-sm select font-italic">
                            <option value="" disabled selected class="font-italic">Gaya Belajar</option>
                            <option value="Visual">Visual</option>
                            <option value="Auditori">Auditori</option>
                            <option value="Kinestetik">Kinestetik</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <span>Gaya Belajar</span>
            </th>
            <th scope="col">Point</th>
            <th scope="col">Reward</th>
            <th scope="col">Pembelian</th>
            <th scope="col">Punishmment</th>
            <th scope="col">Misi Tambahan</th>
            <th scope="col">
                <form action="" method="get">
                    <div class="input-group mb-2">
                        <select id="level" name="level" class="form-control form-control-sm select font-italic">
                            <option value="" disabled selected class="font-italic">Level</option>
                            <?php foreach ($badges as $badge): ?>
                                <option value="<?= $badge['nama']; ?>"><?= $badge['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <span>Level</span>
            </th>
            <th scope="col">Badges</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>

    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php
        // Tambahkan filter untuk NPM
        if (isset($_GET['gaya_belajar'])) {
            $gaya = $_GET['gaya_belajar'];
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($gaya) {
                return $data['gaya_belajar'] == $gaya;
            });
        }

        // Definisikan batas poin untuk setiap level
        $level_limits = [
            'Negative' => [-1000, 10],
            'Master' => [10, 50],
            'Silver' => [50, 100], // Misalnya, Gold memiliki batas 60-100
            'Gold' => [100, 150],
            'Platinum' => [150, 200],
            'Diamond' => [200, 250],
            'King' => [250, 10000],
            // Tambahkan level lain sesuai kebutuhan
        ];
        // Tambahkan filter untuk Level
        if (isset($_GET['level'])) {
            $level = $_GET['level'];
            if (array_key_exists($level, $level_limits)) {
                $min_point = $level_limits[$level][0];
                $max_point = $level_limits[$level][1];

                $mahasiswa = array_filter($mahasiswa, function ($data) use ($min_point, $max_point) {
                    return $data['point'] >= $min_point && $data['point'] < $max_point;
                });
            }
        }
        // Tambahkan filter untuk Pencarian  semua data
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = strtolower($_GET['search']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($search, $badges) {
                // Cek nama, NPM, gaya belajar, point
                $level = null;
                foreach ($badges as $badge) {
                    if ($data['point'] >= $badge['point']) {
                        $level = $badge['nama'];
                    } else {
                        break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                    }
                }

                return strpos(strtolower($data['nama']), $search) !== false ||
                    strpos(strtolower($data['npm']), $search) !== false ||
                    strpos(strtolower($data['gaya_belajar']), $search) !== false ||
                    strpos(strtolower($data['point']), $search) !== false ||
                    (isset($level) && strpos(strtolower($level), $search) !== false); // Cek level
            });
            // Perbarui total data setelah pencarian
            $total_data = count($mahasiswa); // Total data setelah filter

            // Hitung total halaman
            $total_pages = ceil($total_data / $limit); // Total halaman berdasarkan limit

            // Hitung offset untuk query
            $offset = ($page - 1) * $limit; // Offset untuk data yang diambil

            // Ambil data untuk halaman saat ini
            $mahasiswa = array_slice($mahasiswa, $offset, $limit); // Ambil data sesuai offset dan limit

            // Hitung data yang ditampilkan
            $start = $offset + 1; // Data pertama yang ditampilkan
            $end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan

            // Jika total data adalah 6, maka end akan menjadi 6
            if ($total_data < $limit) {
                $end = $total_data; // Set end ke total data jika kurang dari limit
            }
        }

        // Tambahkan filter untuk Pencarian tiap kolom
        if (isset($_GET['search_reward']) && !empty($_GET['search_reward'])) {
            $searchReward = strtolower($_GET['search_reward']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($searchReward, $reward) {
                return (isset($reward[$data['npm']]) && strpos(strtolower((string)$reward[$data['npm']]), $searchReward) !== false);
            });
        }

        if (isset($_GET['search_pembelian']) && !empty($_GET['search_pembelian'])) {
            $searchPembelian = strtolower($_GET['search_pembelian']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($searchPembelian, $pembelian) {
                return (isset($pembelian[$data['npm']]) && strpos(strtolower((string)$pembelian[$data['npm']]), $searchPembelian) !== false);
            });
        }

        if (isset($_GET['search_punishment']) && !empty($_GET['search_punishment'])) {
            $searchPunishment = strtolower($_GET['search_punishment']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($searchPunishment, $punishment) {
                return (isset($punishment[$data['npm']]) && strpos(strtolower((string)$punishment[$data['npm']]), $searchPunishment) !== false);
            });
        }

        if (isset($_GET['search_misi']) && !empty($_GET['search_misi'])) {
            $searchMisi = strtolower($_GET['search_misi']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($searchMisi, $misi) {
                return (isset($misi[$data['npm']]) && strpos(strtolower((string)$misi[$data['npm']]), $searchMisi) !== false);
            });
        }
        ?>
        <?php foreach ($mahasiswa as $m) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $m['npm']; ?></td>
                <td><?= $m['nama']; ?></td>
                <td><?= $m['gaya_belajar']; ?></td>
                <td><?= $m['point']; ?></td>
                <td><?= isset($reward[$m['npm']]) ? $reward[$m['npm']] : 0; ?> </td>
                <td><?= isset($pembelian[$m['npm']]) ? $pembelian[$m['npm']] : 0; ?></td>
                <td><?= isset($punishment[$m['npm']]) ? $punishment[$m['npm']] : 0; ?></td>
                <td><?= isset($misi[$m['npm']]) ? $misi[$m['npm']] : 0; ?></td>
                <td>
                    <?php
                    $selectedBadge = null;
                    foreach ($badges as $badge) {
                        if ($m['point'] >= $badge['point']) {
                            $selectedBadge = $badge;
                        } else {
                            break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                        }
                    }

                    if ($selectedBadge !== null) {
                        echo $selectedBadge['nama'];
                    } else {
                        echo 'Tidak ada Level';
                    }
                    ?>
                </td>
                <td class="text-center">
                    <?php
                    $selectedBadge = null;
                    foreach ($badges as $badge) {
                        if ($m['point'] >= $badge['point']) {
                            $selectedBadge = $badge;
                        } else {
                            break;
                        }
                    }

                    if ($selectedBadge !== null) {
                        echo '<img src="' . base_url('uploads/badges/' . $selectedBadge['badges']) . '" 
                                 alt="Badge" 
                                 class="img-fluid"
                                 style="max-width: 70px; height: auto;">';
                    } else {
                        echo '<span class="badge badge-secondary">Tidak ada badge</span>';
                    }
                    ?>
                </td>
                <td>
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $m['id']; ?>"><i class="fas fa-eye"></i><span class="d-none d-md-inline"> Detail</span></button>
                </td>
                <!-- <php if (in_groups(['superadmin', 'dosen'])) : ?> -->
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $m['id']; ?>"><i class="fas fa-edit"></i><span class="d-none d-md-inline"> Edit</span></button>
                    </td>
                    <td>
                        <button href="/Mahasiswa/delete/<?= $m['id']; ?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i><span class="d-none d-md-inline"> Hapus</span></button>
                    </td>
                <!-- <php endif; ?> -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Pagination -->
<nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
    <!-- Menampilkan informasi jumlah data di kiri -->
    <div class="mb-3">
        Showing <?= $start; ?> to <?= $end; ?> of <?= $total_data; ?> entries
    </div>
    <!-- Menampilkan pagination di kanan -->
    <ul class="pagination mb-0">
        <!-- Tombol Previous -->
        <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?= $i; ?>">
                    <?= $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Tombol Next -->
        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<!-- Modal Detail Mahasiswa -->
<?php foreach ($mahasiswa as $m) : ?>
    <div class="modal fade" id="modalDetail<?php echo $m['id']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-list mr-2"></i>Detail Mahasiswa
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
                            <input type="text" class="form-control" value="<?= $m['npm']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-user mr-2"></i>Nama
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $m['nama']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-brain mr-2"></i> Gaya Belajar
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <?php
                                    // Menentukan ikon berdasarkan gaya belajar mahasiswa
                                    $icon = "fas fa-question-circle"; // Default jika tidak ditemukan
                                    switch ($m['gaya_belajar']) {
                                        case "Visual":
                                            $icon = "fas fa-eye";
                                            break;
                                        case "Auditori":
                                            $icon = "fas fa-headphones";
                                            break;
                                        case "Reading":
                                            $icon = "fas fa-book";
                                            break;
                                        case "Kinestetik":
                                            $icon = "fas fa-running";
                                            break;                   
                                    }
                                    ?>
                                    <i class="<?= $icon; ?>"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="<?= $m['gaya_belajar']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-coins mr-2"></i>Point
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $m['point']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-medal mr-2"></i>Level & Badges
                        </label>
                        <div class="alert 
                            <?php
                            $selectedBadge = null;
                            foreach ($badges as $badge) {
                                if ($m['point'] >= $badge['point']) {
                                    $selectedBadge = $badge;
                                }
                            }
                            if ($selectedBadge) {
                                switch ($selectedBadge['nama']) {
                                        default:
                                        echo 'alert-light';
                                }
                            }
                            ?>" role="alert">
                            <?= $selectedBadge ? $selectedBadge['nama'] : 'Negative'; ?>
                            <?php if ($selectedBadge) : ?>
                                <img src="<?= base_url('uploads/badges/' . $selectedBadge['badges']); ?>" 
                                     alt="Badge" 
                                     style="height: 30px; width: auto;"
                                     class="ml-2">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-chart-bar mr-2"></i>Statistik</label>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <td><i class="fas fa-gift text-success"></i> Reward</td>
                                <td><?= isset($reward[$m['npm']]) ? $reward[$m['npm']] : 0; ?></td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-shopping-cart text-primary"></i> Pembelian</td>
                                <td><?= isset($pembelian[$m['npm']]) ? $pembelian[$m['npm']] : 0; ?></td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-exclamation-triangle text-danger"></i> Punishment</td>
                                <td><?= isset($punishment[$m['npm']]) ? $punishment[$m['npm']] : 0; ?></td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-tasks text-info"></i> Misi Tambahan</td>
                                <td><?= isset($misi[$m['npm']]) ? $misi[$m['npm']] : 0; ?></td>
                            </tr>
                        </table>
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

<!-- Modal Edit Mahasiswa -->
<?php foreach ($mahasiswa as $m) : ?>
    <div class="modal fade" id="modalEdit<?php echo $m['id']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit mr-2"></i>Edit Mahasiswa
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>               
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                <form action="/Mahasiswa/update_Mhs/<?= $m['id']; ?>" method="post">
                        <input type="hidden" name="id" value="<?= $m['id']; ?>">
                        
                        <div class="form-group">
                            <label for="npm<?= $m['id']; ?>">
                                <i class="fas fa-hashtag mr-2"></i>NPM
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" class="form-control" id="npm<?= $m['id']; ?>" 
                                    name="npm" value="<?= $m['npm']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama<?= $m['id']; ?>">
                                <i class="fas fa-user mr-2"></i>Nama
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nama<?= $m['id']; ?>" 
                                    name="nama" value="<?= $m['nama']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gaya_belajar<?= $m['id']; ?>">
                                <i class="fas fa-brain mr-2"></i>Gaya Belajar
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <?php
                                    // Menentukan ikon berdasarkan gaya belajar mahasiswa
                                    $icon = "fas fa-question-circle"; // Default jika tidak ditemukan
                                    switch ($m['gaya_belajar']) {
                                        case "Visual":
                                            $icon = "fas fa-eye";
                                            break;
                                        case "Auditori":
                                            $icon = "fas fa-headphones";
                                            break;
                                        case "Reading":
                                            $icon = "fas fa-book";
                                            break;
                                        case "Kinestetik":
                                            $icon = "fas fa-running";
                                            break;                   
                                    }
                                    ?>
                                    <i class="<?= $icon; ?>"></i>
                                    </span>
                                </div>
                                <select class="form-control" id="gaya_belajar<?= $m['id']; ?>" name="gaya_belajar" required>
                                    <option value="Visual" <?= ($m['gaya_belajar'] == 'Visual') ? 'selected' : ''; ?>>Visual</option>
                                    <option value="Auditori" <?= ($m['gaya_belajar'] == 'Auditori') ? 'selected' : ''; ?>>Auditori</option>
                                    <option value="Kinestetik" <?= ($m['gaya_belajar'] == 'Kinestetik') ? 'selected' : ''; ?>>Kinestetik</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="point<?= $m['id']; ?>">
                                <i class="fas fa-coins mr-2"></i>Point
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                                </div>
                                <input type="number" class="form-control" id="point<?= $m['id']; ?>" 
                                    name="point" value="<?= $m['point']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Simpan 
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>