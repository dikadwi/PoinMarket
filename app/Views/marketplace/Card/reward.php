<h3>Reward</h3>
<!-- Aktif : dosen menampilkan item yg sudah tervalidasi ke marketplace (Yes/No) Status-->
<!-- Admin : validasi item yang di create Dosen (Yes/No) Valid-->
<!-- Reward Card -->
<div class="row mb-4">
    <?php if (!empty($datatransaksi)): ?>
        <?php $no_more_rewards = true; ?>
        <?php foreach ($datatransaksi as $item): ?>
            <?php if ($item['claim'] === 'Belum'): // Menampilkan Data Reward jika reward belum diambil dengan status claim "Belum" 
            ?>
                <div class="col-6 col-md-3">
                    <div class="card">
                        <img src="https://cdn.prod.website-files.com/64889df33626cba8b4463219/6580a6236b0c485a43d21338_620ebadbfc0b50324e0a295b_Gamification_Blog-Feat-Image_1080x680.webp" class="card-img-top" alt="<?= $item['nama_transaksi'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><strong><?= esc($item['nama_transaksi']) ?></strong></h5>
                            <p class="card-text">Point Diperoleh: <?= esc($item['poin_digunakan']) ?></p>
                        </div>
                        <div class="card-footer">
                            <div class="row d-flex justify-content-center">
                                <!-- Tombol Buy -->
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <form action="<?= base_url('Role_User/market/claim') ?>" method="post" class="claim-form">
                                        <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">
                                        <input type="hidden" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>">
                                        <input type="hidden" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>">
                                        <button type="submit" class="btn btn-success btn-block btn-claim d-flex flex-column align-items-center">
                                            <i class="fas fa-gift"></i>
                                            <span class="d-none d-md-inline">Claim</span>
                                        </button>
                                        <!-- Tambahkan button validasi untuk mengambil Reward -->
                                    </form>
                                </div>

                                <!-- Tombol Detail -->
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">
                                        <i class="fas fa-eye"></i> <!-- Ikon di atas teks -->
                                        <span class="d-none d-md-inline">Detail</span> <!-- Teks di bawah ikon -->
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $no_more_rewards = false; ?>
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
                                <strong>Point Harga:</strong> <?= esc($item['poin_digunakan']) ?><br>
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
        <!-- Jika tidak ada reward yang bisa diklaim (reward sudah diambil atau semua reward sudah 'claim' = 'Sudah') -->
        <?php if ($no_more_rewards): ?>
            <div class="col-12">
                <p class="text-center">Tidak ada reward yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="col-12">
            <p class="text-center">Tidak Ada Reward yang tersedia saat ini.</p>
        </div>
    <?php endif; ?>
</div>