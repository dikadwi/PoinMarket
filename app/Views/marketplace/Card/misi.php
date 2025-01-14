<h3>Misi Tambahan</h3>
<!-- Mission Card -->
<div class="row mb-4">
    <?php foreach ($transaksi as $item): ?>
        <?php if ($item['kode_jenis'] == '105'): // kode_jenis Misi Tambahan 
        ?>
            <div class="col-6 col-md-3 d-flex">
                <div class="card flex-fill d-flex flex-column">
                    <img src="https://elearningindustry.com/wp-content/uploads/2014/07/Gamification_article.jpg" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                        <p class="card-text">Point Diperoleh : <strong><?= $item['poin_digunakan'] ?></strong></p>
                    </div>
                    <div class="card-footer">
                        <div class="row d-flex justify-content-center">
                            <!-- <form action="<?= base_url('Role_User/market/misi_tambah') ?>" method="post" class="misi-form"> -->
                            <!-- <div class="col-6 col-md-4 mb-2 mb-md-0"> -->
                            <div>
                                <form action="<?= base_url('market/misi') ?>" method="post" class="misi-form mr-2">
                                    <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                    <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                    <button type="submit" class="btn btn-success btn-block btn-misi d-flex flex-column align-items-center">
                                        <i class="fas fa-rocket"></i>
                                        <span class="d-none d-md-inline">Complete Mission</span>
                                    </button>
                                </form>
                            </div>
                            <!-- Tombol Detail -->
                            <div class="col-6 col-md-4 mb-2 mb-md-0">
                                <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">
                                    <i class="fas fa-eye"></i> <!-- Ikon di atas teks -->
                                    <span class="d-none d-md-inline">Detail</span> <!-- Teks di bawah ikon -->
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="modalDetail<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetailLabel">Detail Transaksi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <strong>Nama Transaksi:</strong> <?= esc($item['nama_transaksi']) ?><br>
                            <strong>Detail Transaksi:</strong> <?= esc($item['detail']) ?><br>
                            <strong>Point Diperoleh:</strong> <?= esc($item['poin_digunakan']) ?><br>
                            <!-- Add more details as needed -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>