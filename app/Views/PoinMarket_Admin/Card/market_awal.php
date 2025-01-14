<div class="col-12">
    <!-- Reward Transactions -->
    <h3>Reward</h3>
    <!-- Buy Card -->
    <div class="row mb-4">
        <?php foreach ($transaksi as $item): ?>
            <!-- Kode untuk kondisi Wait -->
            <?php if ($item['kode_jenis'] == '101' && ($item['valid'] == 'Yes' || $item['valid'] == 'Wait' || $item['valid'] == 'No')): // kode_jenis Pembelian dan status valid "No" 
            ?>
                <!-- Tambah kondisi untuk role, admin(validator),user(dosen) -->
                <div class="col-6 col-md-3 d-flex">
                    <div class="card flex-fill d-flex flex-column">
                        <div class="card-img-container">
                            <img src="https://gapsystudio.com/storage/1746/gamification-in-ux-11zon.webp"
                                class="card-img-top"
                                alt=""
                                style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                            <p class="card-text">
                                Reward : <strong><?= $item['poin_digunakan'] ?></strong> Point<br>
                                Status Validasi : <strong><?= $item['valid'] ?></strong> <br>
                                Status Item : <strong>Aktif / NonAktif</strong> <br>
                            </p>
                            <!-- Tambah kondisi validasi menjadi 3=Yes|No|Wait, kondisi wait terjadi saat create data -->
                        </div>
                        <div class="card-footer">
                            <div class="row d-flex justify-content-center">
                                <!-- Tombol Buy -->
                                <!-- <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <form action="<?= base_url('Role_User/market/claim') ?>" method="post">
                                            <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">
                                            <input type="hidden" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>">
                                            <button type="submit" class="btn btn-info btn-block d-flex flex-column align-items-center">
                                                <i class="fas fa-gift"></i>
                                                <span class="d-none d-md-inline">Claim</span>
                                            </button>
                                            <-- Tambahkan button validasi untuk mengambil Reward ->
                                        </form>
                                    </div> -->

                                <!-- Tombol Detail -->
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">
                                        <i class="fas fa-eye"></i> <!-- Ikon di atas teks -->
                                        <span class="d-none d-md-inline">Detail</span> <!-- Teks di bawah ikon -->
                                    </button>
                                </div>
                                <!-- User=Dosen, admin=superAdmin  -->
                                <?php if (in_groups(['superadmin', 'admin'])) : ?>
                                    <!-- Tombol Edit -->
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-warning btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalEdit<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i> <!-- Ikon di atas teks -->
                                            <span><span class="d-none d-md-inline">Edit</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- validator=admin, admin=superAdmin -->
                                <?php if (in_groups(['superadmin', 'admin'])) : ?>
                                    <!-- Tombol Validasi -->
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-danger btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalValidasi<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i> <!-- Ikon di atas teks -->
                                            <span class="d-none d-md-inline">Validasi</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="modalDetail<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel">Detail Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <strong>Nama :</strong> <?= esc($item['nama_transaksi']) ?><br>
                                <strong>Rule Item :</strong> <?= esc($item['detail']) ?><br>
                                <strong>Feedback :</strong> <?= esc($item['keterangan']) ?><br>
                                <strong>Reward :</strong> <?= esc($item['poin_digunakan']) ?> Point<br>
                                <?php
                                $status = esc($item['valid']);
                                if ($status == 'Yes') {
                                    $statusText = 'Tervalidasi';
                                } elseif ($status == 'No') {
                                    $statusText = 'Belum Tervalidasi';
                                } else {
                                    $statusText = $status; // Jika status tidak sesuai dengan Yes atau No
                                }
                                ?>
                                <!-- Tampilkan status validasi -->
                                <strong>Status :</strong> <?= $statusText ?><br>
                                <!-- Add more details as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Edit Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Marketplace/edit') ?>" method="post">
                                    <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">

                                    <div class="form-group">
                                        <label for="nama_transaksi">Nama</label>
                                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Rule Item</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($item['detail']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Feedback</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="poin_digunakan">Point Harga</label>
                                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="valid">Status</label>
                                        <input type="text" class="form-control" id="valid" name="valid" value="<?= ($item['valid'] == 'Yes') ? 'Tervalidasi' : 'Tidak Tervalidasi' ?>" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Validasi -->
                <div class="modal fade" id="modalValidasi<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Validasi Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('/Marketplace/validasi') ?>" method="post">
                                    <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">

                                    <div class="form-group">
                                        <label for="nama_transaksi">Nama</label>
                                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Rule Item</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($item['detail']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Feedback</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="poin_digunakan">Point Harga</label>
                                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="valid">Status Validasi</label>
                                        <select class="form-control" id="valid" name="valid">
                                            <option value="Validasi" <?= ($item['valid'] == 'Validasi') ? 'selected' : '' ?>>Validasi</option>
                                            <option value="Tidak" <?= ($item['valid'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Validasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Pembelian Transactions -->
    <h3>Belanja</h3>
    <!-- Buy Card -->
    <div class="row mb-4">
        <?php foreach ($transaksi as $item): ?>
            <?php if ($item['kode_jenis'] == '102' && ($item['valid'] == 'Yes' || $item['valid'] == 'Wait' || $item['valid'] == 'No')): // kode_jenis Pembelian dan status valid "No" 
            ?>
                <div class="col-6 col-md-3 d-flex">
                    <div class="card flex-fill d-flex flex-column">
                        <div class="card-img-container">
                            <img src="https://mycred.me/wp-content/uploads/2023/08/mycred-blog_Ecommerce-Gamification-Level-Up-Your-Online-Sales-with-Fun-and-Rewards-Social-Media.jpg"
                                class="card-img-top"
                                alt=""
                                style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                            <p class="card-text">
                                Harga : <strong><?= $item['poin_digunakan'] ?></strong> Point<br>
                                Status : <strong><?= $item['valid'] ?></strong> <br></p>
                        </div>
                        <div class="card-footer">
                            <div class="row d-flex justify-content-center">
                                <!-- Tombol Buy -->
                                <!-- <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <form action="<?= base_url('market/buy') ?>" method="post" class="w-100">
                                            <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                            <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                            <button type="submit" class="btn btn-primary btn-block d-flex flex-column align-items-center">
                                                <i class="fas fa-cart-plus"></i>
                                                <span class="d-none d-md-inline"> Buy</span>
                                            </button>
                                        </form>
                                    </div> -->

                                <!-- Tombol Detail -->
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">
                                        <i class="fas fa-eye"></i> <!-- Ikon di atas teks -->
                                        <span class="d-none d-md-inline">Detail</span> <!-- Teks di bawah ikon -->
                                    </button>
                                </div>
                                <!-- User=Dosen, admin=superAdmin  -->
                                <?php if (in_groups(['user', 'admin'])) : ?>
                                    <!-- Tombol Edit -->
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-warning btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalEdit<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i> <!-- Ikon di atas teks -->
                                            <span><span class="d-none d-md-inline">Edit</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- validator=admin, admin=superAdmin -->
                                <?php if (in_groups(['validator', 'admin'])) : ?>
                                    <!-- Tombol Validasi -->
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-danger btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalValidasi<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i> <!-- Ikon di atas teks -->
                                            <span class="d-none d-md-inline">Validasi</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="modalDetail<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel">Detail Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <strong>Nama :</strong> <?= esc($item['nama_transaksi']) ?><br>
                                <strong>Rule Item :</strong> <?= esc($item['detail']) ?><br>
                                <strong>Feedback :</strong> <?= esc($item['keterangan']) ?><br>
                                <strong>Reward :</strong> <?= esc($item['poin_digunakan']) ?> Point<br>
                                <?php
                                $status = esc($item['valid']);
                                if ($status == 'Yes') {
                                    $statusText = 'Tervalidasi';
                                } elseif ($status == 'No') {
                                    $statusText = 'Belum Tervalidasi';
                                } else {
                                    $statusText = $status; // Jika status tidak sesuai dengan Yes atau No
                                }
                                ?>
                                <!-- Tampilkan status validasi -->
                                <strong>Status :</strong> <?= $statusText ?><br>
                                <!-- Add more details as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Edit Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Marketplace/edit') ?>" method="post">
                                    <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">

                                    <div class="form-group">
                                        <label for="nama_transaksi">Nama</label>
                                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Rule Item</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($item['detail']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Feedback</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="poin_digunakan">Point Harga</label>
                                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="valid">Status</label>
                                        <input type="text" class="form-control" id="valid" name="valid" value="<?= ($item['valid'] == 'Yes') ? 'Tervalidasi' : 'Tidak Tervalidasi' ?>" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Validasi -->
                <div class="modal fade" id="modalValidasi<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Validasi Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('/Marketplace/validasi') ?>" method="post">
                                    <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">

                                    <div class="form-group">
                                        <label for="nama_transaksi">Nama</label>
                                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Rule Item</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($item['detail']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Feedback</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="poin_digunakan">Point Harga</label>
                                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="valid">Status Validasi</label>
                                        <select class="form-control" id="valid" name="valid">
                                            <option value="Validasi" <?= ($item['valid'] == 'Validasi') ? 'selected' : '' ?>>Validasi</option>
                                            <option value="Tidak" <?= ($item['valid'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Validasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Misi Transactions -->
    <h3>Misi</h3>
    <!-- Mission Card -->
    <div class="row mb-4">
        <?php foreach ($transaksi as $item): ?>
            <?php if ($item['kode_jenis'] == '105' && ($item['valid'] == 'Yes' || $item['valid'] == 'Wait' || $item['valid'] == 'No')): // kode_jenis Pembelian dan status valid "No" 
            ?>
                <div class="col-6 col-md-3 d-flex">
                    <!-- <div class="col-md-3 mb-4"> -->
                    <div class="card flex-fill d-flex flex-column">
                        <div class="card-img-container">
                            <img src="https://elearningindustry.com/wp-content/uploads/2014/07/Gamification_article.jpg"
                                class="card-img-top"
                                alt=""
                                style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                            <p class="card-text">
                                Reward : <strong><?= $item['poin_digunakan'] ?></strong> Point<br>
                                Status : <strong><?= $item['valid'] ?></strong> <br></p>
                        </div>
                        <div class="card-footer">
                            <div class="row d-flex justify-content-center">
                                <!-- Tombol Buy -->
                                <!-- <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <form action="<?= base_url('market/buy') ?>" method="post" class="w-100">
                                            <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                            <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                            <button type="submit" class="btn btn-primary btn-block d-flex flex-column align-items-center">
                                                <i class="fas fa-cart-plus"></i>
                                                <span class="d-none d-md-inline"> Buy</span>
                                            </button>
                                        </form>
                                    </div> -->

                                <!-- Tombol Detail -->
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">
                                        <i class="fas fa-eye"></i>
                                        <span class="d-none d-md-inline"> Detail</span>
                                    </button>
                                </div>

                                <!-- User=Dosen, admin=superAdmin  -->
                                <?php if (in_groups(['user', 'admin'])) : ?>
                                    <!-- Tombol Edit -->
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-warning btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalEdit<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i> <!-- Ikon di atas teks -->
                                            <span><span class="d-none d-md-inline">Edit</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- validator=admin, admin=superAdmin -->
                                <?php if (in_groups(['validator', 'admin'])) : ?>
                                    <!-- Tombol Validasi -->
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-danger btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalValidasi<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i> <!-- Ikon di atas teks -->
                                            <span class="d-none d-md-inline">Validasi</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="modalDetail<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel">Detail Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <strong>Nama :</strong> <?= esc($item['nama_transaksi']) ?><br>
                                <strong>Rule Item :</strong> <?= esc($item['detail']) ?><br>
                                <strong>Feedback :</strong> <?= esc($item['keterangan']) ?><br>
                                <strong>Reward :</strong> <?= esc($item['poin_digunakan']) ?> Point<br>
                                <?php
                                $status = esc($item['valid']);
                                if ($status == 'Yes') {
                                    $statusText = 'Tervalidasi';
                                } elseif ($status == 'No') {
                                    $statusText = 'Belum Tervalidasi';
                                } else {
                                    $statusText = $status; // Jika status tidak sesuai dengan Yes atau No
                                }
                                ?>
                                <!-- Tampilkan status validasi -->
                                <strong>Status :</strong> <?= $statusText ?><br>
                                <!-- Add more details as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Edit Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Marketplace/edit') ?>" method="post">
                                    <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">

                                    <div class="form-group">
                                        <label for="nama_transaksi">Nama</label>
                                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Rule Item</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($item['detail']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Feedback</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="poin_digunakan">Point Harga</label>
                                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="valid">Status</label>
                                        <input type="text" class="form-control" id="valid" name="valid" value="<?= ($item['valid'] == 'Yes') ? 'Tervalidasi' : 'Tidak Tervalidasi' ?>" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Validasi -->
                <div class="modal fade" id="modalValidasi<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Validasi Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('/Marketplace/validasi') ?>" method="post">
                                    <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">

                                    <div class="form-group">
                                        <label for="nama_transaksi">Nama</label>
                                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Rule Item</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($item['detail']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Feedback</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="poin_digunakan">Point Harga</label>
                                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="valid">Status Validasi</label>
                                        <select class="form-control" id="valid" name="valid">
                                            <option value="Validasi" <?= ($item['valid'] == 'Validasi') ? 'selected' : '' ?>>Validasi</option>
                                            <option value="Tidak" <?= ($item['valid'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Validasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Konsultasi Transactions -->
    <h3>Konsultasi</h3>
    <!-- Consult Card -->
    <div class="row mb-4">
        <?php foreach ($transaksi as $item): ?>
            <?php if ($item['kode_jenis'] == '106' && ($item['valid'] == 'Yes' || $item['valid'] == 'Wait' || $item['valid'] == 'No')): // kode_jenis Pembelian dan status valid "No" 
            ?>
                <div class="col-6 col-md-3 d-flex">
                    <div class="card flex-fill d-flex flex-column">
                        <div class="card-img-container">
                            <img src="https://trierconsulting.com/wp-content/uploads/2021/07/client-1024x657.png"
                                class="card-img-top"
                                alt=""
                                style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><strong><?= $item['nama_transaksi'] ?></strong></h5>
                            <p class="card-text">
                                Harga : <strong><?= $item['poin_digunakan'] ?></strong> Point <br>
                                Status : <strong><?= $item['valid'] ?></strong> <br></p>
                        </div>
                        <div class="card-footer">
                            <div class="row d-flex justify-content-center">
                                <!-- Tombol Buy -->
                                <!-- <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <form action="<?= base_url('market/buy') ?>" method="post" class="w-100">
                                            <input type="hidden" name="nama_transaksi" value="<?= $item['nama_transaksi'] ?>">
                                            <input type="hidden" name="poin_digunakan" value="<?= $item['poin_digunakan'] ?>">
                                            <button type="submit" class="btn btn-primary btn-block d-flex flex-column align-items-center">
                                                <i class="fas fa-cart-plus"></i>
                                                <span class="d-none d-md-inline"> Buy</span>
                                            </button>
                                        </form>
                                    </div> -->

                                <!-- Tombol Detail -->
                                <div class="col-6 col-md-3 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-info btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalDetail<?= esc($item['id_transaksi']) ?>">
                                        <i class="fas fa-eye"></i>
                                        <span class="d-none d-md-inline"> Detail</span>
                                    </button>
                                </div>

                                <!-- User=Dosen, admin=superAdmin  -->
                                <?php if (in_groups(['user', 'admin'])) : ?>
                                    <!-- Tombol Edit -->
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-warning btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalEdit<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i> <!-- Ikon di atas teks -->
                                            <span><span class="d-none d-md-inline">Edit</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- validator=admin, admin=superAdmin -->
                                <?php if (in_groups(['validator', 'admin'])) : ?>
                                    <!-- Tombol Validasi -->
                                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                                        <button type="button" class="btn btn-danger btn-block d-flex flex-column align-items-center" data-toggle="modal" data-target="#modalValidasi<?= esc($item['id_transaksi']) ?>">
                                            <i class="fas fa-edit"></i> <!-- Ikon di atas teks -->
                                            <span class="d-none d-md-inline">Validasi</span> <!-- Teks di bawah ikon -->
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="modalDetail<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel">Detail Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <strong>Nama :</strong> <?= esc($item['nama_transaksi']) ?><br>
                                <strong>Rule Item :</strong> <?= esc($item['detail']) ?><br>
                                <strong>Feedback :</strong> <?= esc($item['keterangan']) ?><br>
                                <strong>Reward :</strong> <?= esc($item['poin_digunakan']) ?> Point<br>
                                <?php
                                $status = esc($item['valid']);
                                if ($status == 'Yes') {
                                    $statusText = 'Tervalidasi';
                                } elseif ($status == 'No') {
                                    $statusText = 'Belum Tervalidasi';
                                } else {
                                    $statusText = $status; // Jika status tidak sesuai dengan Yes atau No
                                }
                                ?>
                                <!-- Tampilkan status validasi -->
                                <strong>Status :</strong> <?= $statusText ?><br>
                                <!-- Add more details as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Edit Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Marketplace/edit') ?>" method="post">
                                    <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">

                                    <div class="form-group">
                                        <label for="nama_transaksi">Nama</label>
                                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Rule Item</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($item['detail']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Feedback</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="poin_digunakan">Point Harga</label>
                                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="valid">Status</label>
                                        <input type="text" class="form-control" id="valid" name="valid" value="<?= ($item['valid'] == 'Yes') ? 'Tervalidasi' : 'Tidak Tervalidasi' ?>" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Validasi -->
                <div class="modal fade" id="modalValidasi<?= esc($item['id_transaksi']) ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Validasi Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('/Marketplace/validasi') ?>" method="post">
                                    <input type="hidden" name="id_transaksi" value="<?= esc($item['id_transaksi']) ?>">

                                    <div class="form-group">
                                        <label for="nama_transaksi">Nama</label>
                                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="<?= esc($item['nama_transaksi']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail">Rule Item</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="<?= esc($item['detail']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Feedback</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="poin_digunakan">Point Harga</label>
                                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" value="<?= esc($item['poin_digunakan']) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="valid">Status Validasi</label>
                                        <select class="form-control" id="valid" name="valid">
                                            <option value="Validasi" <?= ($item['valid'] == 'Validasi') ? 'selected' : '' ?>>Validasi</option>
                                            <option value="Tidak" <?= ($item['valid'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Validasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>