<table class="table table-bordered border-dark">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">NPM</th>
            <th scope="col">Jenis Transaksi</th>
            <th scope="col">Nama Transaksi</th>
            <th scope="col">Poin Didapatkan</th><!-- total point mahasiswa (hasil dari transaksi) -->
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Validasi</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php
        // Buat array sementara untuk menyimpan data transaksi yang telah dikelompokkan berdasarkan NPM
        $groupedTransactions = [];

        foreach ($data_transaksi as $data) {
            $npm = $data['npm'];
            if (!isset($groupedTransactions[$npm])) {
                $groupedTransactions[$npm] = [];
            }
            // Menyimpan transaksi ke dalam array berdasarkan NPM
            $groupedTransactions[$npm][] = $data;
        }

        // Loop melalui data yang telah dikelompokkan berdasarkan NPM
        foreach ($groupedTransactions as $npm => $transactions) {
            foreach ($transactions as $data) {
        ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <!-- <td><?= $data['id_transaksi']; ?></td> -->
                    <td> <?= $npm; ?></td>
                    <td>
                        <?php
                        switch ($data['jenis_transaksi']) {
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
                                echo $data['jenis_transaksi'];
                        }
                        ?>
                    </td>
                    <td><?= $data['nama_transaksi']; ?></td>
                    <td><?= $data['poin_digunakan']; ?></td>
                    <td><?= $data['tanggal_transaksi']; ?></td>
                    <td> <?php
                            switch ($data['validation']) {
                                case 'Sudah':
                                    echo '<span class="badge badge-success">Sudah</span>';
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
                    <?php if (in_groups('admin')) : ?>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $data['id_transaksi']; ?>">Edit</button>
                        </td>
                        <td>
                            <button href="/Misi_tambah/delete_Misi/<?= $data['id_transaksi']; ?>" class="btn btn-danger btn-hapus">Hapus</button>
                        </td>
                    <?php endif; ?>
            <?php
            }
        }
            ?>
    </tbody>
</table>

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
                <div class="modal-body">
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
                                                    switch ($data['jenis_transaksi']) {
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
                                                            echo $data['jenis_transaksi'];
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
                                                <h4><?= $data['tanggal_transaksi']; ?></h4>
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
<?php foreach ($data_transaksi as $data) : ?>
    <div class="modal fade" id="modalEdit<?php echo $data['id_transaksi']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit <?= $title; ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/Misi_tambah/update_Misi/<?= $data['id_transaksi']; ?>" method="post" enctype="multipart/form-data">
                        <!-- <div class="form-group ">
                            <label for="id_transaksi" class="col-form-label">Kode Transaksi</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="id_transaksi" name="id_transaksi" value="<?php echo $data['id_transaksi'] ?>" required readonly>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="jenis_transaksi" class="col-form-label">Jenis Transaksi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?php echo $data['jenis_transaksi'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="nama_transaksi" class="col-form-label">Nama Transaksi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?php echo $data['nama_transaksi'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div> -->
                        <div class="form-group ">
                            <label for="npm" class="col-form-label">NPM</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="npm" name="npm" value="<?php echo $data['npm'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <!-- <div class="form-group ">
                            <label for="poin_digunakan" class="col-form-label">Poin Digunakan</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?php echo $data['poin_digunakan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div> -->
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