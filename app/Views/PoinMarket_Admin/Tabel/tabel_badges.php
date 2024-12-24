<?php
// Tentukan jumlah data per halaman
$limit = 10;

// Ambil halaman saat ini dari URL, jika tidak ada, set ke 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Hitung total data
$total_data = count($badges);

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Hitung offset untuk query
$offset = ($page - 1) * $limit;

// Ambil data untuk halaman saat ini
$badges = array_slice($badges, $offset, $limit);

// Hitung data yang ditampilkan
$start = $offset + 1; // Data pertama yang ditampilkan
$end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan
?>

<table class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Point</th>
            <th scope="col">Detail</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Badges</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php
        // Cari data transaksi berdasarkan kata kunci
        if (isset($_GET['search'])) {
            $search = strtolower($_GET['search']);  // Mengonversi kata kunci pencarian menjadi huruf kecil
            $badges = array_filter($badges, function ($data) use ($search) {
                // Mengonversi data transaksi dan search menjadi huruf kecil
                return strpos(strtolower(strval($data['nama'])), $search) !== false ||
                    strpos(strtolower(strval($data['detail'])), $search) !== false;
            });
            // Perbarui total data setelah pencarian
            $total_data = count($badges); // Total data setelah filter

            // Hitung total halaman
            $total_pages = ceil($total_data / $limit); // Total halaman berdasarkan limit

            // Hitung offset untuk query
            $offset = ($page - 1) * $limit; // Offset untuk data yang diambil

            // Ambil data untuk halaman saat ini
            $badges = array_slice($badges, $offset, $limit); // Ambil data sesuai offset dan limit

            // Hitung data yang ditampilkan
            $start = $offset + 1; // Data pertama yang ditampilkan
            $end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan

            // Jika total data adalah 6, maka end akan menjadi 6
            if ($total_data < $limit) {
                $end = $total_data; // Set end ke total data jika kurang dari limit
            }
        }
        foreach ($badges as $b) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $b['nama']; ?></td>
                <td><?= $b['point']; ?></td>
                <td><?= $b['detail']; ?></td>
                <td><?= $b['keterangan']; ?></td>
                <td>
                    <?php if ($b['badges']) : ?>
                        <img src="data:image/png;base64,<?= base64_encode($b['badges']); ?>" alt="Badge Image" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $b['id_badges']; ?>">Detail</button>
                </td>
                <?php if (in_groups(['admin', 'user'])) : ?> <!--Role admin-->
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $b['id_badges']; ?>">Edit</button>
                    </td>
                <?php endif ?>
                <?php if (in_groups('admin')) : ?>
                    <td>
                        <a href="/Badges/delete_badges/<?= $b['id_badges']; ?>" class="btn btn-danger btn-hapus">Hapus</a>
                    </td>
                <?php endif; ?>
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

<!-- Modal box Detail -->
<?php foreach ($badges as $b) : ?>
    <div class="modal fade" id="modalDetail<?php echo $b['id_badges']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $b['nama']; ?> </h5>
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
                                            <li class="list-group-item">
                                                <center>
                                                    <?php if ($b['badges']) : ?>
                                                        <img src="data:image/png;base64,<?= base64_encode($b['badges']); ?>" alt="Badge Image" width="100">
                                                    <?php endif; ?>
                                                </center>
                                            </li>
                                            <h5 class="card-title"><b>Nama :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $b['nama']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Point :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $b['point']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Detail :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $b['detail']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Keterangan :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $b['keterangan']; ?></h4>
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

<!--Data Modal Box Edit Data-->
<?php foreach ($badges as $b) : ?>
    <div class="modal fade" id="modalEdit<?php echo $b['id_badges']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Badges </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="/Badges/update_badges/<?= $b['id_badges']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="id" class="col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $b['id_badges'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <center>
                                <?php if ($b['badges']) : ?>
                                    <img src="data:image/png;base64,<?= base64_encode($b['badges']); ?>" alt="Badge Image" width="100">
                                <?php endif; ?>
                            </center>
                        </div>
                        <div class="form-group ">
                            <label for="nama" class="col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $b['nama'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="point" class="col-form-label">Point</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="point" name="point" value="<?php echo $b['point'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="detail" class="col-form-label">Detail</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="detail" name="detail" value="<?php echo $b['detail'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="keterangan" class="col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $b['keterangan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="badges" class="col-form-label">Badges</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="badges" name="badges">
                            </div>
                        </div>


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