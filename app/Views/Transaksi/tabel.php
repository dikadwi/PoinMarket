<table class="table table-bordered border-dark">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <!-- <th scope="col">Jenis Transaksi</th> -->
            <th scope="col">Nama</th>
            <th scope="col">Detail</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Point</th>
            <th scope="col" colspan="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($transaksi as $t) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <!-- <td><?= $t['kode_jenis'] ?></td> -->
                <td><?= $t['nama']; ?></td>
                <td><?= $t['detail']; ?></td>
                <td><?= $t['keterangan']; ?></td>
                <td><?= $t['point']; ?></td>
                <td>
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $t['id_transaksi']; ?>">Detail</button>
                    <?php if (in_groups('admin')) : ?>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $t['id_transaksi']; ?>">Edit</button>
                        <button href="/Transaksi/delete/<?= $t['id_transaksi']; ?>" class="btn btn-danger btn-hapus">Hapus</button>
                    <?php endif; ?>
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
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $t['nama']; ?> </h5>
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
                                            <h5 class="card-title"><b>Nama :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $t['nama']; ?></h4>
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
                                                <h4><?= $t['point']; ?></h4>
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

                <div class="modal-body">
                    <form action="/Transaksi/update_transaksi/<?= $t['id_transaksi']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="id" class="col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $t['id_transaksi'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="nama" class="col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $t['nama'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="detail" class="col-form-label">Detail</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="detail" name="detail" value="<?php echo $t['detail'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="keterangan" class="col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $t['keterangan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="point" class="col-form-label">Point</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="point" name="point" value="<?php echo $t['point'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
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