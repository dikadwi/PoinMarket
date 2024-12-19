<table class="table table-bordered border-dark">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">NPM</th>
            <th scope="col">Jenis Transaksi</th>
            <th scope="col">Nama Transaksi</th>
            <th scope="col">Poin Digunakan</th><!-- total point mahasiswa (hasil dari transaksi) -->
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Validasi</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data_transaksi as $data) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <!-- <td><?= $data['id_transaksi']; ?></td> -->
                <td><?= $data['npm']; ?></td>
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
                <td><?= date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
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
            <?php endforeach; ?>
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