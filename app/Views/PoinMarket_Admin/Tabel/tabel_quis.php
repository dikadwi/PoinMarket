<?php
// Tentukan jumlah data per halaman
$limit = 10;

// Ambil halaman saat ini dari URL, jika tidak ada, set ke 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Hitung total data
$total_data = count($quis);

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Hitung offset untuk query
$offset = ($page - 1) * $limit;

// Ambil data untuk halaman saat ini
$quis = array_slice($quis, $offset, $limit);

// Hitung data yang ditampilkan
$start = $offset + 1; // Data pertama yang ditampilkan
$end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan
?>

<table class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Pertanyaan</th>
            <th scope="col">Opsi A</th>
            <th scope="col">Opsi B</th>
            <th scope="col">Opsi C</th>
            <th scope="col">Opsi D</th>
            <th scope="col">Jawaban Benar</th>
            <th scope="col">Poin</th>
            <th scope="col">Kategori</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php
        // Cari data quis berdasarkan kata kunci
        if (isset($_GET['search'])) {
            $search = strtolower($_GET['search']);  // Mengonversi kata kunci pencarian menjadi huruf kecil
            $quis = array_filter($quis, function ($data) use ($search) {
                // Mengonversi data transaksi dan search menjadi huruf kecil
                return strpos(strtolower(strval($data['pertanyaan'])), $search) !== false ||
                    strpos(strtolower(strval($data['opsi_a'])), $search) !== false ||
                    strpos(strtolower(strval($data['opsi_b'])), $search) !== false ||
                    strpos(strtolower(strval($data['opsi_c'])), $search) !== false ||
                    strpos(strtolower(strval($data['opsi_d'])), $search) !== false ||
                    strpos(strtolower(strval($data['jawaban_benar'])), $search) !== false ||
                    strpos(strtolower(strval($data['poin'])), $search) !== false ||
                    strpos(strtolower(strval($data['kategori'])), $search) !== false;
            });
            // Perbarui total data setelah pencarian
            $total_data = count($quis); // Total data setelah filter

            // Hitung total halaman
            $total_pages = ceil($total_data / $limit); // Total halaman berdasarkan limit

            // Hitung offset untuk query
            $offset = ($page - 1) * $limit; // Offset untuk data yang diambil

            // Ambil data untuk halaman saat ini
            $quis = array_slice($quis, $offset, $limit); // Ambil data sesuai offset dan limit

            // Hitung data yang ditampilkan
            $start = $offset + 1; // Data pertama yang ditampilkan
            $end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan

            // Jika total data adalah 6, maka end akan menjadi 6
            if ($total_data < $limit) {
                $end = $total_data; // Set end ke total data jika kurang dari limit
            }
        }
        foreach ($quis as $quiz) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $quiz['pertanyaan'] ?></td>
                <td><?= $quiz['opsi_a'] ?></td>
                <td><?= $quiz['opsi_b'] ?></td>
                <td><?= $quiz['opsi_c'] ?></td>
                <td><?= $quiz['opsi_d'] ?></td>
                <td><?= $quiz['jawaban_benar'] ?></td>
                <td><?= $quiz['poin'] ?></td>
                <td><?= $quiz['kategori'] ?></td>
                <td>
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $quiz['id']; ?>"><i class="fas fa-eye"></i> Detail</button>
                </td>
                <td>
                    <button type=" button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $quiz['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                </td>
                <td>
                    <button href="/Quis/delete/<?= $quiz['id']; ?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i> Hapus</button>
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
<?php foreach ($quis as $q) : ?>
    <div class="modal fade" id="modalDetail<?php echo $q['id']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail Quis</h5>
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
                                            <h5 class="card-title"><b>Pertanyaan :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $q['pertanyaan']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Opsi A :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $q['opsi_a']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Opsi B :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $q['opsi_b']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Opsi C :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $q['opsi_c']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Opsi D :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $q['opsi_d']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Jawaban :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $q['jawaban_benar']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Poin :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $q['poin']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Kategori :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $q['kategori']; ?></h4>
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
<?php foreach ($quis as $q) : ?>
    <div class="modal fade" id="modalEdit<?php echo $q['id']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Quis </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <form action="/Quis/updateQuis/<?= $q['id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="id" class="col-form-label"></label>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $q['id'] ?>" required>
                        </div>
                        <div class="form-group ">
                            <label for="pertanyaan" class="col-form-label">Pertanyaan </label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="<?php echo $q['pertanyaan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="opsi_a" class="col-form-label">Opsi A</label>
                                    <input type="text" class="form-control" id="opsi_a" name="opsi_a" value="<?php echo $q['opsi_a'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                </div>
                                <div class="form-group ">
                                    <label for="opsi_b" class="col-form-label">Opsi B</label>
                                    <input type="text" class="form-control" id="opsi_b" name="opsi_b" value="<?php echo $q['opsi_b'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="opsi_c" class="col-form-label">Opsi C</label>
                                    <input type="text" class="form-control" id="opsi_c" name="opsi_c" value="<?php echo $q['opsi_c'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                </div>
                                <div class="form-group ">
                                    <label for="opsi_d" class="col-form-label">Opsi D</label>
                                    <input type="text" class="form-control" id="opsi_d" name="opsi_d" value="<?php echo $q['opsi_d'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="jawaban_benar" class="col-form-label">Jawaban Benar</label>
                            <input type="text" class="form-control" id="jawaban_benar" name="jawaban_benar" value="<?php echo $q['jawaban_benar'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="poin" class="col-form-label">Point</label>
                            <input type="number" class="form-control" id="poin" name="poin" value="<?php echo $q['poin'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="kategori" class="col-form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $q['kategori'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
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

<!--Data Modal Box Edit Data-->
<?php foreach ($quis as $q) : ?>
    <div class="modal fade" id="modalEdit<?php echo $q['id']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Quis </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <form action="/Badges/update_badges/<?= $q['id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="id" class="col-form-label"></label>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $q['id'] ?>" required>
                        </div>
                        <div class="form-group ">
                            <label for="pertanyaan" class="col-form-label">Pertanyaan </label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="<?php echo $q['pertanyaan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="opsi_a" class="col-form-label">Opsi A</label>
                                    <input type="text" class="form-control" id="opsi_a" name="opsi_a" value="<?php echo $q['opsi_a'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                </div>
                                <div class="form-group ">
                                    <label for="opsi_b" class="col-form-label">Opsi B</label>
                                    <input type="text" class="form-control" id="opsi_b" name="opsi_b" value="<?php echo $q['opsi_b'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="opsi_c" class="col-form-label">Opsi C</label>
                                    <input type="text" class="form-control" id="opsi_c" name="opsi_c" value="<?php echo $q['opsi_c'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                </div>
                                <div class="form-group ">
                                    <label for="opsi_d" class="col-form-label">Opsi D</label>
                                    <input type="text" class="form-control" id="opsi_d" name="opsi_d" value="<?php echo $q['opsi_d'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="jawaban_benar" class="col-form-label">Jawaban Benar</label>
                            <input type="text" class="form-control" id="jawaban_benar" name="jawaban_benar" value="<?php echo $q['jawaban_benar'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="poin" class="col-form-label">Point</label>
                            <input type="number" class="form-control" id="poin" name="poin" value="<?php echo $q['poin'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="kategori" class="col-form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $q['kategori'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
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