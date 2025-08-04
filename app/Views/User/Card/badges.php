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
                            <img src="<?= base_url('uploads/badges/' . $t['badges']); ?>"
                            class="card-img-top"
                            alt="Gambar_Item"
                            style="width: 100%; height: auto;">
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
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

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
                <div class="modal-body">
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