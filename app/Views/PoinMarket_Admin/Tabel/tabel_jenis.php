<?php
// Tentukan jumlah data per halaman
$limit = 10;

// Ambil halaman saat ini dari URL, jika tidak ada, set ke 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Hitung total data
$total_data = count($transaksi);

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Hitung offset untuk query
$offset = ($page - 1) * $limit;

// Ambil data untuk halaman saat ini
$transaksi = array_slice($transaksi, $offset, $limit);

// Hitung data yang ditampilkan
$start = $offset + 1; // Data pertama yang ditampilkan
$end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan
?>

<table class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Transaksi</th>
            <!-- <th scope="col">Jenis Transaksi</th> -->
            <th scope="col">Nama</th>
            <th scope="col">Detail</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Poin Harga</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
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
            // Perbarui total data setelah pencarian
            $total_data = count($transaksi); // Total data setelah filter

            // Hitung total halaman
            $total_pages = ceil($total_data / $limit); // Total halaman berdasarkan limit

            // Hitung offset untuk query
            $offset = ($page - 1) * $limit; // Offset untuk data yang diambil

            // Ambil data untuk halaman saat ini
            $transaksi = array_slice($transaksi, $offset, $limit); // Ambil data sesuai offset dan limit

            // Hitung data yang ditampilkan
            $start = $offset + 1; // Data pertama yang ditampilkan
            $end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan

            // Jika total data adalah 6, maka end akan menjadi 6
            if ($total_data < $limit) {
                $end = $total_data; // Set end ke total data jika kurang dari limit
            }
        }
        foreach ($transaksi as $t) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $t['id_transaksi']; ?></td>
                <!-- <td><?= $t['kode_jenis'] ?></td> -->
                <td><?= $t['nama_transaksi']; ?></td>
                <td><?= $t['detail']; ?></td>
                <!-- Detail pada misi tambahan tambahkan untuk misi berupa file upload atau data  -->
                <td><?= $t['keterangan']; ?></td>
                <td><?= $t['poin_digunakan']; ?></td>
                <td>
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $t['id_transaksi']; ?>"><i class="fas fa-eye"></i> Detail</button>
                </td>
                <?php if (in_groups(['admin', 'user'])) : ?>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $t['id_transaksi']; ?>"><i class="fas fa-edit"></i> Edit</button>
                    </td>
                <?php endif ?>
                <?php if (in_groups('admin')) : ?>
                    <td>
                        <button href="/Jenis_Transaksi/delete/<?= $t['id_transaksi']; ?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i> Hapus</button>
                    </td>
                <?php endif; ?>
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

<!--Data Modal Box Edit Data-->
<?php foreach ($transaksi as $t) : ?>
    <div class="modal fade" id="modalEdit<?php echo $t['id_transaksi']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit <?= $title; ?> </h5>
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
                            <label for="detail" class="col-form-label">Detail</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="<?php echo $t['detail'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="keterangan" class="col-form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $t['keterangan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="poin_digunakan" class="col-form-label">Point</label>
                            <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?php echo $t['poin_digunakan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
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