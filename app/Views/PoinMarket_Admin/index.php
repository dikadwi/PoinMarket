<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
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
                    <center>
                        <h1 class="m-0 text-dark">Point Market</h1>
                    </center>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
            <div class="row">
                <div class="col-3 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text d-none d-md-inline">Users</span>
                            <span class="info-box-number">
                                <?= $totalMhs; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text d-none d-md-inline">Pesanan</span>
                            <span class="info-box-number" id="userRank">
                                <?= $totalPemesanan; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text d-none d-md-inline">User Online</span>
                            <span class="info-box-number" id="totalUsers">
                                ...
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-clipboard-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text d-none d-md-inline">Validasi</span>
                            <span class="info-box-number" id="totalRiwayat">
                                <?= $totalValidasi ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Row untuk Card Jumlah Tiap Jenis Transaksi -->
            <div class="row justify-content-center">
                <div class="col-6 col-md-2">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h2>Rewards</h2>
                            <!-- Total Rewards -->
                            <h5> <?= $totalReward ?> Items </h5>
                        </div>
                        <div class="icon d-block">
                            <i class="ion ion-ribbon-a"></i>
                        </div>
                        <a href="/Transaksi/reward" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <!-- <h2>Belanja</h2> -->
                            <h2>Pembelian</h2>
                            <!-- Total Challanges  -->
                            <h5> <?= $totalPembelian ?> Items </h5>
                        </div>
                        <div class="icon d-block">
                            <i class="ion ion-android-cart"></i>
                        </div>
                        <a href="/Transaksi/pembelian" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h2>Punishment</h2>
                            <!-- Total data Badges -->
                            <h5> <?= $totalPunishment ?> Items </h5>
                        </div>
                        <div class="icon d-block">
                            <i class="ion ion-flag"></i>
                        </div>
                        <a href="/Transaksi/punishment" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h2>Misi</h2>
                            <!-- Total data Badges -->
                            <h5> <?= $totalMisi ?> Items </h5>
                        </div>
                        <div class="icon d-block">
                            <i class="ion ion-ionic"></i>
                        </div>
                        <a href="/Transaksi/misi_tambah" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <!-- small box -->
                    <div class="small-box bg-gradient-purple">
                        <div class="inner">
                            <h2>Konsultasi</h2>
                            <!-- Total data Badges -->
                            <h5> <?= $totalKonsultasi ?> Items </h5>
                        </div>
                        <div class="icon d-block">
                            <i class="ion ion-chatboxes"></i>
                        </div>
                        <a href="/Transaksi/konsultasi" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Row untuk Donut,Leaderboard-->
            <div class="row">
                <!-- Donut -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title text-white mb-0">
                                <i class="ion ion-pie-graph mr-2"></i> Grafik 
                            </h3>
                        </div>
                        <!-- Canvas untuk grafik donut -->
                        <div class="card-body">
                            <div class="row g-0">
                                <canvas id="donutChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                        <!-- <div id="legend"></div> -->
                    </div>
                    <!-- <div class="small-box border border-dark">
                        < Keterangan grafik ->
                        <div id="legend"></div>
                    </div> -->
                </div>
                <!-- Menampilkan Leaderboard -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <!-- <div class="col-12 col-md-6"> -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title text-white mb-0">
                                <i class="ion ion-podium mr-2"></i> Leaderboard
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-gradient-primary">
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
                                                <tr class="<?= ($i == 1) ? 'bg-gradient-gold' : (($i == 2) ? 'bg-gradient-silver' : (($i == 3) ? 'bg-gradient-bronze' : '')) ?>">
                                                    <td>
                                                        <!-- Menampilkan ikon sesuai peringkat -->
                                                        <i class="fas <?= ($i == 1) ? 'fa-trophy' : (($i == 2) ? 'fa-trophy' : (($i == 3) ? 'fa-trophy' : (($i == 4) ? 'fa-medal' : (($i == 5) ? 'fa-medal' : '')))) ?>" style="color: <?= ($i == 1) ? 'gold' : (($i == 2) ? 'silver' : (($i == 3) ? 'bronze' : (($i == 4) ? 'gold' : 'silver'))) ?>"></i>
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

            <!-- Row untuk Data Badges, Data Jenis Transaksi -->
            <div class="row">
                <!-- Data Badges -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card-header bg-gradient-info">
                        <h3 class="card-title text-white mb-0">
                            <i class="ion ion-ribbon-b mr-2"></i>Badges
                        </h3>
                    </div>
                    <div class="small-box b flex-fill">
                        <div class="card mb-0 flex-fill">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-light">
                                        <thead class="bg-info">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Badges</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Point</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($badges as $b) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td>
                                                        <?php if ($b['badges']) : ?>
                                                            <center> <img src="<?= base_url('uploads/badges/' . $b['badges']); ?>" alt="Badge Image" width="80"></center>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $b['nama']; ?></td>
                                                    <td><?= $b['point']; ?></td>
                                                    <td><?= $b['keterangan']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Data Jenis Transaksi -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <!-- <div class="col-12 col-md-6"> -->
                    <div class="card-header bg-gradient-info">
                        <h3 class="card-title text-white mb-0">
                            <i class="ion ion-pricetags mr-2"></i> Item
                        </h3>
                    </div>
                    <div class="small-box b flex-fill">
                        <div class="card mb-0 flex-fill">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-light">
                                        <thead class="bg-info">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Detail</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Poin Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($transaksi as $trx) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $trx['nama_transaksi']; ?></td>
                                                    <td><?= $trx['detail']; ?></td>
                                                    <td><?= $trx['keterangan']; ?></td>
                                                    <!-- <td><?= $trx['poin_digunakan']; ?></td> -->
                                                    <td><?= !empty($trx['poin_digunakan']) ? 
                                                            number_format($trx['poin_digunakan'], 0, ',', '.') : 
                                                            number_format($trx['poin_diberikan'], 0, ',', '.'); ?></td>
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

            <!-- Row data Mahasiswa-->
            <div class="row">
                <!-- Data Mahasiswa -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card-header bg-gradient-info">
                        <h3 class="card-title text-white mb-0">
                            <i class="ion ion-person-stalker mr-2"></i> Mahasiswa
                        </h3>
                    </div>
                    <div class="small-box b flex-fill">
                        <div class="card mb-0 flex-fill">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-light h-100">
                                        <thead class="bg-info">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Npm</th>
                                                <th>Poin</th>
                                                <th>Level</th>
                                                <th>Badges</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($mahasiswa as $mhs) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $mhs['nama']; ?></td>
                                                    <td><?= $mhs['npm']; ?></td>
                                                    <td><?= $mhs['point']; ?></td>
                                                    <td>
                                                        <?php
                                                        $selectedBadge = null;
                                                        foreach ($badges as $badge) {
                                                            if ($mhs['point'] >= $badge['point']) {
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
                                                    <td>
                                                        <center>
                                                            <?php
                                                            $selectedBadge = null;
                                                            foreach ($badges as $badge) {
                                                                if ($mhs['point'] >= $badge['point']) {
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
                                                        </center>
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
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
    // Data yang diambil dari PHP
    var labels = <?php echo json_encode(array_column($transactions, 'kode_jenis')); ?>;
    var data = <?php echo json_encode(array_column($transactions, 'total')); ?>;
    var backgroundColor = ["#21bcdb", "#db2121", "#f0d11f", "#1ea84a", '#794DAD']; // Warna sesuai kategori

    // Data untuk grafik donut
    var chartData = {
        labels: labels.map(label => getTransaksiJenis(parseInt(label))),
        datasets: [{
            data: data,
            backgroundColor: backgroundColor
        }]
    };

    // Atur options untuk grafik donut
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false // Agar legend ditampilkan secara terpisah
        }
    };

    // Mengambil elemen canvas untuk menggambar grafik donut
    var ctx = document.getElementById("donutChart").getContext("2d");

    // Membuat grafik donut
    var donutChart = new Chart(ctx, {
        type: 'doughnut',
        data: chartData,
        options: options
    });

    // // Fungsi untuk menambahkan keterangan pada halaman
    // function addLegend() {
    //     var legend = document.getElementById('legend');
    //     var content = '';

    //     labels.forEach(function(label, index) {
    //         content += '<div class="legend-item"><span style="display:inline-block;width:20px;background-color:' +
    //             backgroundColor[index] +
    //             '">&nbsp;</span> ' +
    //             label +
    //             ' =' +
    //             // data[index] +
    //             // ' - ' +
    //             getTransaksiJenis(parseInt(label)) +
    //             '</div>';
    //     });

    //     legend.innerHTML = content;
    // }

    // // Panggil fungsi untuk menambahkan keterangan
    // addLegend();

    // Fungsi untuk mendapatkan jenis transaksi
    function getTransaksiJenis(label) {
        switch (label) {
            case 101:
                return 'Reward';
            case 102:
                return 'Pembelian';
            case 103:
                return 'Punishment';
            case 105:
                return 'Misi Tambahan';
            case 106:
                return 'konsultasi';
            default:
                return null;
        }
    }
</script>

<?= $this->endsection(); ?>