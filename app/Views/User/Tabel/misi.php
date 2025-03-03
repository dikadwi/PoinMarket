<?php
// Tentukan jumlah data per halaman
$limit = 10;

// Ambil halaman saat ini dari URL, jika tidak ada, set ke 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Hitung total data
$total_data = count($data_transaksi);

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Hitung offset untuk query
$offset = ($page - 1) * $limit;

// Ambil data untuk halaman saat ini
$data_transaksi = array_slice($data_transaksi, $offset, $limit);

// Hitung data yang ditampilkan
$start = $offset + 1; // Data pertama yang ditampilkan
$end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan
?>

<table class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Transaksi</th>
            <th scope="col">Poin Diperoleh</th><!-- total point mahasiswa (hasil dari transaksi) -->
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col" colspan="3">Progress</th>
            <th scope="col" colspan="3">Upload File</th>
            <th scope="col">Status Misi </th> <!-- Diambil dari status validasi,hanya tampilkan dengan status belum, jika validasi sudah maka point dapat diclaim pada menu market di reward -->
            <th scope="col" colspan="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data_transaksi as $data) : ?>
            <?php if ($data['validation'] == 'Sudah'): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <!-- <td><?= $data['id_transaksi']; ?></td> -->
                    <td><?= $data['nama_transaksi']; ?></td>
                    <td><?= $data['poin_digunakan']; ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
                    <!-- Ambil File dari database, jika belum ada file tampilkan button untuk upload file -->
                    <!-- Progress files -->
                <?php
                    $totalFiles = 3; // Total file yang harus diupload
                    $uploadedFiles = 0; // Hitung file yang sudah diupload
                    if (!empty($data['file1'])) $uploadedFiles++;
                    if (!empty($data['file2'])) $uploadedFiles++;
                    if (!empty($data['file3'])) $uploadedFiles++;
                    $progressPercentage = ($uploadedFiles / $totalFiles) * 100;
                ?>
                <td colspan="3">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: <?= $progressPercentage ?>%;" 
                             aria-valuenow="<?= $progressPercentage ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            <?= number_format($progressPercentage) ?>%
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted"><?= $uploadedFiles ?> dari <?= $totalFiles ?> file telah diupload</small>
                    </div>
                </td>
                <!-- File upload buttons -->
                <td>
                    <button type="button" class="btn btn-sm <?= !empty($data['file1']) ? 'btn-success' : 'btn-warning' ?>" data-toggle="modal">
                        File 1 <?= !empty($data['file1']) ? '<i class="fas fa-check"></i>' : '' ?>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm <?= !empty($data['file2']) ? 'btn-success' : 'btn-warning' ?>" data-toggle="modal">
                        File 2 <?= !empty($data['file2']) ? '<i class="fas fa-check"></i>' : '' ?>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm <?= !empty($data['file3']) ? 'btn-success' : 'btn-warning' ?>" data-toggle="modal">
                        File 3 <?= !empty($data['file3']) ? '<i class="fas fa-check"></i>' : '' ?>
                    </button>
                </td>
                <!-- Tambahkan status, dari claim. Jika misi selesai status claim"sudah=Selesai", jika belum status "Belum" -->
                <td> <?php
                            switch ($data['claim']) {
                                case 'Sudah':
                                    echo '<span class="badge badge-success">Selesai</span>';
                                    break;
                                case 'Belum':
                                    echo '<span class="badge badge-danger">Belum</span>';
                                    break;
                                default:
                                    echo '<span class="badge badge-secondary">Tidak Ada</span>';
                                    break;
                            } ?>
                    </td>
                    <td>
                        <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $data['id_transaksi']; ?>">Detail</button>
                    </td>
                    <td>
                        <!-- Untuk membatalkan misi, data terhapus Poin tidak terpengaruh -->
                        <button type=" button" class="btn btn-danger" data-toggle="modal">Batalkan</button>
                    </td>
                <?php endif; ?>
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