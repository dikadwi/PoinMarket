<!-- Tabel -->
<table class="table table-bordered border-dark table_mahasiswa">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">NPM</th>
            <th scope="col">Nama</th>
            <th scope="col">
                <form action="" method="get">
                    <div class="input-group mb-2">
                        <select id="gaya_belajar" name="gaya_belajar" class="form-control form-control-sm select font-italic">
                            <option value="" disabled selected class="font-italic">Gaya Belajar</option>
                            <option value="Visual">Visual</option>
                            <option value="Auditori">Auditori</option>
                            <option value="Kinestetik">Kinestetik</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <span>Gaya Belajar</span>
            </th>
            <th scope="col">Point</th>
            <th scope="col">Reward</th>
            <th scope="col">Pembelian</th>
            <th scope="col">Punishmment</th>
            <th scope="col">Misi Tambahan</th>
            <th scope="col">
                <form action="" method="get">
                    <div class="input-group mb-2">
                        <select id="level" name="level" class="form-control form-control-sm select font-italic">
                            <option value="" disabled selected class="font-italic">Level</option>
                            <?php foreach ($badges as $badge): ?>
                                <option value="<?= $badge['nama']; ?>"><?= $badge['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <span>Level</span>
            </th>
            <th scope="col">Badges</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>

    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php

        // Tambahkan filter untuk NPM
        if (isset($_GET['gaya_belajar'])) {
            $gaya = $_GET['gaya_belajar'];
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($gaya) {
                return $data['gaya_belajar'] == $gaya;
            });
        }
        // Tambahkan filter untuk Level
        if (isset($_GET['level'])) {
            $level = $_GET['level'];
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($level, $badges) {
                foreach ($badges as $badge) {
                    if ($badge['nama'] == $level && $data['point'] >= $badge['point']) {
                        return true;
                    }
                }
                return false;
            });
        }
        // Tambahkan filter untuk Pencarian  semua data
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = strtolower($_GET['search']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($search, $badges) {
                // Cek nama, NPM, gaya belajar, point
                $level = null;
                foreach ($badges as $badge) {
                    if ($data['point'] >= $badge['point']) {
                        $level = $badge['nama'];
                    } else {
                        break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                    }
                }

                return strpos(strtolower($data['nama']), $search) !== false ||
                    strpos(strtolower($data['npm']), $search) !== false ||
                    strpos(strtolower($data['gaya_belajar']), $search) !== false ||
                    strpos(strtolower($data['point']), $search) !== false ||
                    (isset($level) && strpos(strtolower($level), $search) !== false); // Cek level
            });
        }

        // Tambahkan filter untuk Pencarian tiap kolom
        if (isset($_GET['search_reward']) && !empty($_GET['search_reward'])) {
            $searchReward = strtolower($_GET['search_reward']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($searchReward, $reward) {
                return (isset($reward[$data['npm']]) && strpos(strtolower((string)$reward[$data['npm']]), $searchReward) !== false);
            });
        }

        if (isset($_GET['search_pembelian']) && !empty($_GET['search_pembelian'])) {
            $searchPembelian = strtolower($_GET['search_pembelian']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($searchPembelian, $pembelian) {
                return (isset($pembelian[$data['npm']]) && strpos(strtolower((string)$pembelian[$data['npm']]), $searchPembelian) !== false);
            });
        }

        if (isset($_GET['search_punishment']) && !empty($_GET['search_punishment'])) {
            $searchPunishment = strtolower($_GET['search_punishment']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($searchPunishment, $punishment) {
                return (isset($punishment[$data['npm']]) && strpos(strtolower((string)$punishment[$data['npm']]), $searchPunishment) !== false);
            });
        }

        if (isset($_GET['search_misi']) && !empty($_GET['search_misi'])) {
            $searchMisi = strtolower($_GET['search_misi']);
            $mahasiswa = array_filter($mahasiswa, function ($data) use ($searchMisi, $misi) {
                return (isset($misi[$data['npm']]) && strpos(strtolower((string)$misi[$data['npm']]), $searchMisi) !== false);
            });
        }
        ?>
        <?php foreach ($mahasiswa as $m) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $m['npm']; ?></td>
                <td><?= $m['nama']; ?></td>
                <td><?= $m['gaya_belajar']; ?></td>
                <td><?= $m['point']; ?></td>
                <td><?= isset($reward[$m['npm']]) ? $reward[$m['npm']] : 0; ?> </td>
                <td><?= isset($pembelian[$m['npm']]) ? $pembelian[$m['npm']] : 0; ?></td>
                <td><?= isset($punishment[$m['npm']]) ? $punishment[$m['npm']] : 0; ?></td>
                <td><?= isset($misi[$m['npm']]) ? $misi[$m['npm']] : 0; ?></td>
                <td>
                    <?php
                    $selectedBadge = null;
                    foreach ($badges as $badge) {
                        if ($m['point'] >= $badge['point']) {
                            $selectedBadge = $badge;
                        } else {
                            break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                        }
                    }

                    if ($selectedBadge !== null) {
                        echo $selectedBadge['nama'];
                    } else {
                        echo 'Tidak ada Level';
                    }
                    ?>
                </td>
                <td>
                    <center>
                        <?php
                        $selectedBadge = null;
                        foreach ($badges as $badge) {
                            if ($m['point'] >= $badge['point']) {
                                $selectedBadge = $badge;
                            } else {
                                break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                            }
                        }

                        if ($selectedBadge !== null) {
                            echo '<img src="data:image/png;base64,' . base64_encode($selectedBadge['badges']) . '" width="100">';
                        } else {
                            echo 'Tidak ada badge';
                        }
                        ?>
                    </center>
                </td>
                <td>
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $m['id']; ?>">Detail</button>
                </td>
                <?php if (in_groups('admin')) : ?>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $m['id']; ?>">Edit</button>
                    </td>
                    <td>
                        <button href="/Mahasiswa/delete/<?= $m['id']; ?>" class="btn btn-danger btn-hapus">Hapus</button>
                    </td>
                <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal box Detail -->
<?php foreach ($mahasiswa as $m) : ?>
    <?php foreach ($badges as $b) : ?>
        <?php if ($m['point'] >= $b['point']) : ?>
            <div class="modal fade" id="modalDetail<?php echo $m['id']; ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detail </h5>
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
                                                    <h5 class="card-title"><b>NPM :</b></h5>
                                                    <li class="list-group-item">
                                                        <h4><?= $m['npm']; ?></h4>
                                                    </li>
                                                    <h5 class="card-title"><b>Nama Mahasiswa:</b></h5>
                                                    <li class="list-group-item">
                                                        <h4><?= $m['nama']; ?></h4>
                                                    </li>
                                                    <h5 class="card-title"><b>Gaya Belajar :</b></h5>
                                                    <li class="list-group-item">
                                                        <h4><?= $m['gaya_belajar']; ?></h4>
                                                    </li>
                                                    <h5 class="card-title"><b>Point :</b></h5>
                                                    <li class="list-group-item">
                                                        <h4><?= $m['point']; ?></h4>
                                                    </li>
                                                    <h5 class="card-title"><b>Transaksi :</b></h5>
                                                    <table class="table table-bordered border-dark">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Reward</th>
                                                                <th scope="col">Pembelian</th>
                                                                <th scope="col">Punishment</th>
                                                                <th scope="col">Misi Tambahan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align: center;"><?= isset($reward[$m['npm']]) ? $reward[$m['npm']] : 0; ?> </td>
                                                                <td style="text-align: center;"><?= isset($punishment[$m['npm']]) ? $punishment[$m['npm']] : 0; ?></td>
                                                                <td style="text-align: center;"><?= isset($pembelian[$m['npm']]) ? $pembelian[$m['npm']] : 0; ?></td>
                                                                <td style="text-align: center;"><?= isset($misi[$m['npm']]) ? $misi[$m['npm']] : 0; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered border-dark">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Level </b></td>
                                                                <td>
                                                                    <?php
                                                                    $selectedBadge = null;
                                                                    foreach ($badges as $badge) {
                                                                        if ($m['point'] >= $badge['point']) {
                                                                            $selectedBadge = $badge;
                                                                        } else {
                                                                            break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                                                        }
                                                                    }

                                                                    if ($selectedBadge !== null) {
                                                                        echo $selectedBadge['nama'];
                                                                    } else {
                                                                        echo 'Tidak ada badge';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Badges </b></td>
                                                                <td>
                                                                    <?php
                                                                    $selectedBadge = null;
                                                                    foreach ($badges as $badge) {
                                                                        if ($m['point'] >= $badge['point']) {
                                                                            $selectedBadge = $badge;
                                                                        } else {
                                                                            break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                                                        }
                                                                    }

                                                                    if ($selectedBadge !== null) {
                                                                        echo '<img src="data:image/png;base64,' . base64_encode($selectedBadge['badges']) . '" width="100">';
                                                                    } else {
                                                                        echo 'Tidak ada badge';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- <h5 class="card-title"><b>Level :</b></h5>
                                                    <li class="list-group-item">
                                                        <h4>
                                                            <?php
                                                            $selectedBadge = null;
                                                            foreach ($badges as $badge) {
                                                                if ($m['point'] >= $badge['point']) {
                                                                    $selectedBadge = $badge;
                                                                } else {
                                                                    break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                                                }
                                                            }

                                                            if ($selectedBadge !== null) {
                                                                echo $selectedBadge['nama'];
                                                            } else {
                                                                echo 'Tidak ada badge';
                                                            }
                                                            ?>
                                                        </h4>
                                                    </li>
                                                    <h5 class="card-title"><b>Badges :</b></h5>
                                                    <li class="list-group-item">
                                                        <center>
                                                            <?php
                                                            $selectedBadge = null;
                                                            foreach ($badges as $badge) {
                                                                if ($m['point'] >= $badge['point']) {
                                                                    $selectedBadge = $badge;
                                                                } else {
                                                                    break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                                                }
                                                            }

                                                            if ($selectedBadge !== null) {
                                                                echo '<img src="data:image/png;base64,' . base64_encode($selectedBadge['badges']) . '" width="100">';
                                                            } else {
                                                                echo 'Tidak ada badge';
                                                            }
                                                            ?>
                                                        </center>
                                                    </li> -->
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
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<!--Data Modal Box Edit Data-->
<?php foreach ($mahasiswa as $m) : ?>
    <div class="modal fade" id="modalEdit<?php echo $m['id']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Mahasiswa </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="/Mahasiswa/update_Mhs/<?= $m['id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="id" class="col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $m['id'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="nama" class="col-form-label">Nama Mahasiswa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $m['nama'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="npm" class="col-form-label">NPM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="npm" name="npm" value="<?php echo $m['npm'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gaya_belajar" class="col-form-label">Gaya Belajar</label>
                            <div class="col-sm-10">
                                <select name="gaya_belajar" id="gaya_belajar" class="form-control" required>
                                    <option value="Visual" <?php if ($m['gaya_belajar'] == 'Visual') echo 'selected'; ?>>Visual</option>
                                    <option value="Auditori" <?php if ($m['gaya_belajar'] == 'Auditori') echo 'selected'; ?>>Auditori</option>
                                    <option value="Kinestetik" <?php if ($m['gaya_belajar'] == 'Kinestetik') echo 'selected'; ?>>Kinestetik</option>
                                </select>
                            </div>
                        </div>


                        <!-- <div class="form-group ">
                            <label for="gaya_belajar" class="col-form-label">Gaya Belajar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="gaya_belajar" name="gaya_belajar" value="<?php echo $m['gaya_belajar'] ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                            </div>
                        </div> -->
                        <div class="form-group ">
                            <label for="point" class="col-form-label">Point</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="point" name="point" value="<?php echo $m['point'] ?>" readonly>
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