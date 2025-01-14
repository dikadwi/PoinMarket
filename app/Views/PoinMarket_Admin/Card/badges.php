<div class="row">
    <?php $i = 1; ?>
    <?php foreach ($badges as $t) : ?>
        <div class="col-6 col-md-3 d-flex">
            <div class="card flex-fill d-flex flex-column">
                <div class="card-header text-center">
                    <h5 class="card-title"><strong><?= $t['detail']; ?></strong></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <!-- Kolom Gambar -->
                            <?php if ($t['badges']) : ?>
                                <img src="data:image/png;base64,<?= base64_encode($t['badges']); ?>" alt="Badge Image" width="100">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <!-- Kolom Teks -->
                            <div class="card-text">
                                <p>
                                    <strong>Level:</strong> <?= $t['nama']; ?><br>
                                    <strong>Point:</strong> <?= $t['point']; ?><br>
                                    <strong>Detail:</strong> <?= $t['keterangan']; ?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Footer untuk Tombol -->
                <div class="card-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#modalDetail<?php echo $t['id_badges']; ?>">
                        <i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span>
                    </button>
                    <?php if (in_groups(['superadmin', 'admin'])) : ?>
                        <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#modalEdit<?php echo $t['id_badges']; ?>">
                            <i class="fas fa-edit"></i><span class="d-none d-md-inline"> Edit </span>
                        </button>
                        <button href="/Badges/delete/<?= $t['id_badges']; ?>" class="btn btn-danger btn-hapus mr-2">
                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Hapus </span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal box Detail -->
<?php foreach ($badges as $b) : ?>
    <div class="modal fade" id="modalDetail<?php echo $b['id_badges']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail Badges</h5>
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
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <form action="/Badges/update_badges/<?= $b['id_badges']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="id" class="col-form-label"></label>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $b['id_badges'] ?>" required>
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
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $b['nama'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="point" class="col-form-label">Point</label>
                            <input type="number" class="form-control" id="point" name="point" value="<?php echo $b['point'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="detail" class="col-form-label">Detail</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="<?php echo $b['detail'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="keterangan" class="col-form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $b['keterangan'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                        <div class="form-group ">
                            <label for="badges" class="col-form-label">Badges</label>
                            <input type="file" class="form-control" id="badges" name="badges">
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