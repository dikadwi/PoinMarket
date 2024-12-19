<!-- Tabel -->
<table class="table table-bordered border-dark">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">
                <!-- <form action="" method="get"> -->
                <!-- <div class="input-group mb-2"> -->
                <!-- Mengecilkan ukuran dropdown -->
                <!-- <select id="npm" name="npm" onchange="filterNPM(this.value)" class="form-control form-control-sm select font-italic">
                            <option value="" disabled selected class="font-italic">NPM</option>
                            <?php foreach ($npm as $mhs) { ?>
                                <option value="<?php echo $mhs['npm']; ?>"><?php echo $mhs['npm']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="input-group-append"> -->
                <!-- Mengecilkan ukuran tombol -->
                <!-- <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form> -->
                <!-- Teks 'Validasi' di bawah form filter -->
                <span>NPM</span>
            </th>
            <th scope="col">
                <form action="" method="get">
                    <div class="input-group mb-2">
                        <select id="filter_jenis_transaksi" name="filter_jenis_transaksi" class="form-control form-control-sm select font-italic">
                            <option value="" disabled selected class="font-italic">Jenis Transaksi</option>
                            <option value="101">Reward</option>
                            <option value="102">Pembelian</option>
                            <option value="103">Punishment</option>
                            <option value="105">Misi Tambahan</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <span>Jenis Transaksi</span>
            </th>
            <th scope="col">Nama Transaksi</th>
            <th scope="col">Poin Digunakan</th><!-- total point mahasiswa (hasil dari transaksi) -->
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Jam</th>
            <!-- <th scope="col">
                <form action="" method="get">
                    <div class="input-group mb-2">
                        <select id="validasi" name="validasi" class="form-control form-control-sm select font-italic">
                            <option value="" disabled selected class="font-italic">Validasi</option>
                            <option value="Sudah">Sudah</option>
                            <option value="Belum">Belum</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <span>Validasi</span>
            </th> -->
            <th scope="col" colspan="3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php
        // Urutkan data transaksi berdasarkan tanggal transaksi terbaru
        usort($data_transaksi, function ($a, $b) {
            return strtotime($b['tanggal_transaksi']) - strtotime($a['tanggal_transaksi']);
        });

        $jenis_transaksi_map = [
            '101' => 'Reward',
            '102' => 'Pembelian',
            '103' => 'Punishment',
            '105' => 'Misi Tambahan',
        ];

        // Cari data transaksi berdasarkan kata kunci
        if (isset($_GET['search'])) {
            $search = strtolower($_GET['search']);  // Mengonversi kata kunci pencarian menjadi huruf kecil
            $data_transaksi = array_filter($data_transaksi, function ($data) use ($search, $jenis_transaksi_map) {
                // Menyimpan nama jenis transaksi berdasarkan kode
                $jenis_transaksi_name = isset($jenis_transaksi_map[$data['jenis_transaksi']]) ? $jenis_transaksi_map[$data['jenis_transaksi']] : '';

                // Mengonversi data transaksi dan search menjadi huruf kecil
                return strpos(strtolower(strval($data['npm'])), $search) !== false ||
                    strpos(strtolower($jenis_transaksi_name), $search) !== false ||
                    strpos(strtolower(strval($data['nama_transaksi'])), $search) !== false ||
                    strpos(strtolower(strval($data['poin_digunakan'])), $search) !== false ||
                    strpos(strtolower(strval($data['tanggal_transaksi'])), $search) !== false;
            });
        }

        // Tambahkan filter untuk NPM
        if (isset($_GET['npm'])) {
            $npm = $_GET['npm'];
            $data_transaksi = array_filter($data_transaksi, function ($data) use ($npm) {
                return $data['npm'] == $npm;
            });
        }

        // Tambahkan filter untuk jenis transaksi
        if (isset($_GET['filter_jenis_transaksi'])) {
            $jenis_transaksi = $_GET['filter_jenis_transaksi'];
            $data_transaksi = array_filter($data_transaksi, function ($data) use ($jenis_transaksi) {
                return $data['jenis_transaksi'] == $jenis_transaksi;
            });
        }

        // Tambahkan filter untuk validasi
        if (isset($_GET['validasi'])) {
            $validasi = $_GET['validasi'];
            $data_transaksi = array_filter($data_transaksi, function ($data) use ($validasi) {
                return $data['validation'] == $validasi;
            });
        }

        // // Buat array sementara untuk menyimpan data transaksi yang telah dikelompokkan berdasarkan NPM
        // $groupedTransactions = [];

        // foreach ($data_transaksi as $data) {
        //     $npm = $data['npm'];
        //     if (!isset($groupedTransactions[$npm])) {
        //         $groupedTransactions[$npm] = [];
        //     }
        //     // Menyimpan transaksi ke dalam array berdasarkan NPM
        //     $groupedTransactions[$npm][] = $data;
        // }

        // // Loop melalui data yang telah dikelompokkan berdasarkan NPM
        // foreach ($groupedTransactions as $npm => $transactions) {
        //     foreach ($transactions as $data) {
        foreach ($data_transaksi as $data) {
        ?>
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
                <td><?= date('H:i', strtotime($data['tanggal_transaksi'])); ?></td>
                <!-- <td> <?php
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
                </td> -->
                <td>
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $data['id_transaksi']; ?>">Detail</button>
                </td>
                <?php if (in_groups('admin')) : ?>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $data['id_transaksi']; ?>">Edit</button>
                    </td>
                    <td>
                        <button href="/Transaksi/delete_Transaksi/<?= $data['id_transaksi']; ?>" class="btn btn-danger btn-hapus">Hapus</button>
                    </td>
                <?php endif; ?>
            <?php
        }
        // }
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
                                            <h5 class="card-title"><b>NPM :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $data['npm']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Nama Mahasiswa :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= isset($nama[$data['npm']]) ? $nama[$data['npm']] : '-'; ?></h4>
                                            </li>
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
                    <form action="/Transaksi/update_Transaksi/<?= $data['id_transaksi']; ?>" method="post" enctype="multipart/form-data">
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