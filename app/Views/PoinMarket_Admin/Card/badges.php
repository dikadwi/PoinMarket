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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-list mr-2"></i>Detail Badges
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <div class="form-group text-center">
                        <img src="<?= base_url('uploads/badges/' . $b['badges']); ?>"
                            class="img-fluid"
                            alt="Gambar_Item"
                            style="width: 40%; height: auto;">
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-medal mr-2"></i>Nama
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $b['detail']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-layer-group mr-2"></i>Level
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $b['nama']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-coins mr-2"></i>Point
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $b['point']; ?>" readonly>
                        </div>
                    </div>                  

                    <div class="form-group">
                        <label>
                            <i class="fas fa-list mr-2"></i>Detail
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $b['keterangan']; ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!--Data Modal Box Edit Data-->
<?php foreach ($badges as $b) : ?>
    <div class="modal fade" id="modalEdit<?php echo $b['id_badges']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit mr-2"></i>Edit Badges
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <form action="/Badges/update/<?= $b['id_badges']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $b['id_badges'] ?>" required>
                    </div>

                    <div class="form-group text-center">
                        <img src="<?= base_url('uploads/badges/' . $b['badges']); ?>"
                            class="img-fluid"
                            alt="Gambar_Item"
                            style="width: 40%; height: auto;">
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-medal mr-2"></i>Nama
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $b['detail']; ?>" name="detail" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-layer-group mr-2"></i>Level
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $b['nama']; ?>" name="nama" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-coins mr-2"></i>Point
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $b['point']; ?>" name="point" required >
                        </div>
                    </div>                  

                    <div class="form-group">
                        <label>
                            <i class="fas fa-list mr-2"></i>Detail
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $b['keterangan']; ?>" name="keterangan" required>
                        </div>
                    </div>
                
                    <div class="form-group ">
                        <label>
                            <i class="fas fa-image mr-2"></i>Gambar 
                        </label>
                        <img src="<?= base_url('uploads/badges/' . $b['badges']); ?>" alt="Gambar" width="100" height="100">
                        <div class="input-group">                          
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                            </div>
                            <input type="hidden" name="badges_lama" value="<?= $b['badges']; ?>">
                            <input type="file" class="form-control" id="badges" name="badges">
                        </div>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> 
                            Kosongkan jika tidak ingin mengubah gambar.
                        </small>
                    </div>
              
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i> Simpan 
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Batal
                            </button>
                </div>       
            </form> 
            </div>
        </div>
    </div>
<?php endforeach ?>