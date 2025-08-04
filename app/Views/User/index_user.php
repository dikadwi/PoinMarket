<?= $this->extend('User/Template/dashboard'); ?>

<?= $this->section('content_user'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<style>
    @media (max-width: 767.98px) {
        .info-box {
            text-align: center;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .info-box-icon {
            float: none !important;
            margin: 0 auto 10px !important;
            width: 50px !important;
            height: 50px !important;
            font-size: 1.5rem !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .info-box-content {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            margin-left: 0 !important;
            width: 100% !important;
        }

        .info-box-number {
            margin-top: 5px;
            font-size: 1rem;
        }
    }
</style>

<!-- <div class="content-wrapper" style="background-image: url(https://media.istockphoto.com/id/1149543417/id/vektor/konsep-gamifikasi-mengintegrasikan-permainan.jpg?s=612x612&w=0&k=20&c=124BYzvn0F760W-djUx8B-icV0yB9K5LCl21fdberzk=);"> -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Point Market</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/Role_User">User</a></li>
                        <li class="breadcrumb-item active"> <?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row justify-content-center">
                <div class="col-3 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-coins"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text d-none d-md-inline">Point Balance</span>
                            <span class="info-box-number">
                                <?= $point ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-3 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text d-none d-md-inline">Total User</span>
                            <span class="info-box-number" id="totalUsers">
                                <?= $totalMhs ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-3 col-sm-6 col-md-4">
                    <!-- <div class="col-12 col-sm-6 col-md-4"> -->
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text d-none d-md-inline">Riwayat</span>
                            <span class="info-box-number" id="totalRiwayat">
                                <?= $riwayat ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Menampilkan Profil -->
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-user-circle mr-2"></i> Profil Saya
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-0">
                                <div class="col-md-4 text-center">
                                    <div class="position-relative">
                                        <img src="/img/admin.jpg" class="img-thumbnail rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <div class="position-relative">
                                        <!-- <strong>Badge</strong><br> -->
                                        <?php
                                        $selectedBadge = null;
                                        foreach ($badges as $badge) {
                                            if ($point >= $badge['point']) {
                                                $selectedBadge = $badge;
                                            } else {
                                                break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                            }
                                        }

                                        if ($selectedBadge !== null) {
                                            echo '<img src="' . base_url('uploads/badges/' . $selectedBadge['badges']) . '" 
                                                     alt="Badge" 
                                                     class="img-fluid"
                                                     style="max-width: 70px; height: auto;">';
                                        } else {
                                            echo '<span class="badge badge-secondary">Tidak ada badge</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body pt-md-0">
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item border-0">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1 text-muted">Nama Lengkap</h6>
                                                    <small class="text-primary">
                                                        <i class="fas fa-id-card"></i>
                                                    </small>
                                                </div>
                                                <p class="mb-1 font-weight-bold"><?= $nama; ?></p>
                                            </div>
                                            <div class="list-group-item border-0">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1 text-muted">NPM</h6>
                                                    <small class="text-primary">
                                                        <i class="fas fa-fingerprint"></i>
                                                    </small>
                                                </div>
                                                <p class="mb-1 font-weight-bold"><?= $npm; ?></p>
                                            </div>
                                            <?php if (!empty($email)) : ?>
                                                <div class="list-group-item border-0">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1 text-muted">Email</h6>
                                                        <small class="text-primary">
                                                            <i class="fas fa-envelope"></i>
                                                        </small>
                                                    </div>
                                                    <p class="mb-1 font-weight-bold"><?= $email; ?></p>
                                                </div>
                                            <?php else: ?>
                                                <div class="list-group-item border-0">
                                                    <h6 class="mb-1 text-muted">Email</h6>
                                                    <div class="alert alert-warning mb-0">
                                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                                        Email belum ditambahkan
                                                        <button type="button" class="btn btn-sm btn-outline-primary ml-4" data-toggle="modal" data-target="#modalEmail">
                                                            Tambah
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="list-group-item border-0">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1 text-muted">Level</h6>
                                                    <small class="text-primary">
                                                        <i class="fas fa-medal"></i>
                                                    </small>
                                                </div>
                                                <p class="mb-1 font-weight-bold"> <?php
                                                                                    $selectedBadge = null;
                                                                                    foreach ($badges as $badge) {
                                                                                        if ($point >= $badge['point']) {
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
                                                                                    ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menampilkan Leaderboard -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title text-white mb-0">
                                <i class="ion ion-podium mr-2"></i> Leaderboard
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-0">
                                <table class="table table-bordered border-light h-100">
                                    <thead class="bg-info">
                                        <tr>
                                            <th>Rank</th>
                                            <th>Nama</th>
                                            <th>Poin</th>
                                            <th>Level</th>
                                            <th>Badges</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Mengurutkan mahasiswa berdasarkan poin tertinggi
                                        usort($mahasiswa, function ($a, $b) {
                                            return $b['point'] <=> $a['point']; // Urutkan secara descending
                                        });

                                        // Mengambil 5 mahasiswa dengan poin tertinggi
                                        $topMahasiswa = array_slice($mahasiswa, 0, 5);
                                        $i = 1;
                                        foreach ($topMahasiswa as $user) : ?>
                                            <tr>
                                                <td class="<?= ($i == 1) ? 'gold' : (($i == 2) ? 'silver' : (($i == 3) ? 'bronze' : '')) ?>">
                                                    <!-- Menampilkan ikon sesuai peringkat -->
                                                    <i class="fas <?= ($i == 1) ? 'fa-trophy' : (($i == 2) ? 'fa-trophy' : (($i == 3) ? 'fa-trophy' : (($i == 4) ? 'fa-medal' : (($i == 5) ? 'fa-medal' : '')))) ?>"
                                                        style="color: <?= ($i == 1) ? 'gold' : (($i == 2) ? 'silver' : (($i == 3) ? 'bronze' : (($i == 4) ? 'gold' : 'silver'))) ?>"></i>
                                                    <?php echo $i++; ?>
                                                </td>
                                                <td><?= $user['nama']; ?></td>
                                                <td><?= $user['point']; ?></td>
                                                <td>
                                                    <?php
                                                    $selectedBadge = null;
                                                    foreach ($badges as $badge) {
                                                        if ($user['point'] >= $badge['point']) {
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

                                                    <?php
                                                    $selectedBadge = null;
                                                    foreach ($badges as $badge) {
                                                        if ($user['point'] >= $badge['point']) {
                                                            $selectedBadge = $badge;
                                                        } else {
                                                            break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                                        }
                                                    }

                                                     if ($selectedBadge !== null) {
                                                            echo '<img src="' . base_url('uploads/badges/' . $selectedBadge['badges']) . '" 
                                                                     alt="Badge" 
                                                                     class="img-fluid"
                                                                     style="max-width: 70px; height: auto;">';
                                                        } else {
                                                            echo '<span class="badge badge-secondary">Tidak ada badge</span>';
                                                        }
                                                    ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menampilkan data Transaksi-->
        <div class="row justify-content-center">
            <div class="col-6 col-md-2">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h2>Rewards</h2>
                        <!-- Total Rewards -->
                        <p> <?= $totalReward ?> Items </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ribbon-b"></i>
                    </div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDetailReward" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    <!-- <a href="/Role_User/transaksi_reward" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>

            <div class="col-6 col-md-2">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h2>Pembelian</h2>
                        <!-- Total Challanges  -->
                        <p> <?= $totalPembelian ?> Items </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-cart"></i>
                    </div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDetailPembelian" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    <!-- <a href="/Role_User/transaksi_pembelian" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>

            <div class="col-6 col-md-2">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h2>Punishment</h2>
                        <!-- Total data Badges -->
                        <p> <?= $totalPunishment ?> Items </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-compose"></i>
                    </div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDetailPunishment" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    <!-- <a href="/Role_User/transaksi_punishment" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>

            <div class="col-6 col-md-2">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h2>Misi</h2>
                        <!-- Total Challanges  -->
                        <p> <?= $totalMisi ?> Items </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDetailMisi" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    <!-- <a href="/Role_User/transaksi_pembelian" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>

            <div class="col-6 col-md-2">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h2>Konsultasi</h2>
                        <!-- Total Challanges  -->
                        <p> <?= $totalKonsultasi ?> Items </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-medkit"></i>
                    </div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDetailKonsul" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    <!-- <a href="/Role_User/transaksi_pembelian" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>

        </div>


    </section>
    <!-- /.content -->
</div>

<!-- Modal box Tambah Email -->
<div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="addEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmailModalLabel">Tambahkan Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form or content for adding email here -->
                <!-- Example: -->
                <form action="/Role_User/save_email" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Email</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal box ganti Password -->
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Ganti Password -->
                <form action="/Role_User/change_password" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="old_password">Password Lama</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Box Detail Reward -->
<div class="modal fade" id="modalDetailReward">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Rewards</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <?php
                // Filter data berdasarkan kode_jenis
                $filteredData = array_filter($data_transaksi, function ($item) {
                    return $item['kode_jenis'] == '101'; // Sesuaikan dengan kode_jenis yang diinginkan
                });

                if (empty($filteredData)): ?>
                    <div class="col-12 text-center">
                        <p class="text-muted"><strong>Tidak ada data yang tersedia.</strong></p>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Transaksi</th>
                                <th>Reward Poin</th>
                                <th>Tanggal Transaksi</th>
                                <!-- <th>Validasi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($filteredData as $data): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['nama_transaksi']; ?></td>
                                    <td><?= $data['poin_diberikan']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
                                    <!-- <td>
                    <?php
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Box Detail Pembelian -->
<div class="modal fade" id="modalDetailPembelian">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <?php
                // Filter data berdasarkan kode_jenis
                $filteredData = array_filter($data_transaksi, function ($item) {
                    return $item['kode_jenis'] == '102'; // Sesuaikan dengan kode_jenis yang diinginkan
                });

                if (empty($filteredData)): ?>
                    <div class="col-12 text-center">
                        <p class="text-muted"><strong>Tidak ada data yang tersedia.</strong></p>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Transaksi</th>
                                <th>Poin Digunakan</th>
                                <th>Tanggal Transaksi</th>
                                <!-- <th>Validasi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($filteredData as $data): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['nama_transaksi']; ?></td>
                                    <td><?= $data['poin_digunakan']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
                                    <!-- <td>
                    <?php
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Box Detail Punishment -->
<div class="modal fade" id="modalDetailPunishment">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Punishment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <?php
                // Filter data berdasarkan kode_jenis
                $filteredData = array_filter($data_transaksi, function ($item) {
                    return $item['kode_jenis'] == '103'; // Sesuaikan dengan kode_jenis yang diinginkan
                });

                if (empty($filteredData)): ?>
                    <div class="col-12 text-center">
                        <p class="text-muted"><strong>Tidak ada data yang tersedia.</strong></p>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Transaksi</th>
                                <th>Poin Digunakan</th>
                                <th>Tanggal Transaksi</th>
                                <!-- <th>Validasi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($filteredData as $data): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['nama_transaksi']; ?></td>
                                    <td><?= $data['poin_digunakan']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
                                    <!-- <td>
                    <?php
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Box Detail Misi  -->
<div class="modal fade" id="modalDetailMisi">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Misi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <?php
                // Filter data berdasarkan kode_jenis
                $filteredData = array_filter($data_transaksi, function ($item) {
                    return $item['kode_jenis'] == '105'; // Sesuaikan dengan kode_jenis yang diinginkan
                });

                if (empty($filteredData)): ?>
                    <div class="col-12 text-center">
                        <p class="text-muted"><strong>Tidak ada data yang tersedia.</strong></p>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Transaksi</th>
                                <th>Reward Poin</th>
                                <th>Tanggal Transaksi</th>
                                <!-- <th>Validasi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($filteredData as $data): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['nama_transaksi']; ?></td>
                                    <td><?= $data['poin_diberikan']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
                                    <!-- <td>
                    <?php
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Box Detail Konsultasi -->
<div class="modal fade" id="modalDetailKonsul">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konsultasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <?php
                // Filter data berdasarkan kode_jenis
                $filteredData = array_filter($data_transaksi, function ($item) {
                    return $item['kode_jenis'] == '106'; // Sesuaikan dengan kode_jenis yang diinginkan
                });

                if (empty($filteredData)): ?>
                    <div class="col-12 text-center">
                        <p class="text-muted"><strong>Tidak ada data yang tersedia.</strong></p>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Transaksi</th>
                                <th>Poin Digunakan</th>
                                <th>Tanggal Transaksi</th>
                                <!-- <th>Validasi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($filteredData as $data): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['nama_transaksi']; ?></td>
                                    <td><?= $data['poin_digunakan']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
                                    <!-- <td>
                    <?php
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endsection(); ?>