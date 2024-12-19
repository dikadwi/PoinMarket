<table class="table table-bordered border-dark">
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
        <?php foreach ($transaksi as $t) : ?>
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
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $t['id_transaksi']; ?>">Detail</button>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

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
                                <div class="col-md-8">
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