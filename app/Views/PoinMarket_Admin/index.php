<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<!-- <div class="content-wrapper" style="background-image: url(https://media.istockphoto.com/id/1149543417/id/vektor/konsep-gamifikasi-mengintegrasikan-permainan.jpg?s=612x612&w=0&k=20&c=124BYzvn0F760W-djUx8B-icV0yB9K5LCl21fdberzk=);"> -->
<div class="content-wrapper">
    <div class="content-header">

        <center>
            <h1><b> POINT MARKET </b></h1>
        </center>

    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6 ">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h2>Rewards</h2>
                            <!-- Total Rewards -->
                            <p> <?= $totalReward ?> Items </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ribbon-a"></i>
                        </div>
                        <a href="/Transaksi/reward" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6 ">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h2>Pembelian</h2>
                            <!-- Total Challanges  -->
                            <p> <?= $totalPembelian ?> Items </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="/Transaksi/pembelian" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6 ">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h2>Punishment</h2>
                            <!-- Total data Badges -->
                            <p> <?= $totalPunishment ?> Items </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="/Transaksi/punishment" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6 ">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h2>Misi Tambahan</h2>
                            <!-- Total data Badges -->
                            <p> <?= $totalMisi ?> Items </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="/Transaksi/misi_tambah" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


            </div>
            <!-- /.row -->
            <!-- /.row (main row) -->
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="small-box border border-dark">
                        <!-- Canvas untuk grafik donut -->
                        <canvas id="donutChart" width="400" height="400"></canvas>
                    </div>
                    <div class="small-box border border-dark">
                        <!-- Keterangan grafik -->
                        <div id="legend"></div>
                    </div>
                    <div class="small-box border border-dark">
                        <center>
                            <h2> <i class="ion ion-ribbon-b"><b> Badges</b></i></h2>
                        </center>
                        <table class="table table-bordered border-light">
                            <thead class="bg-info">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Badges</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Point</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($badges as $b) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td>
                                            <?php if ($b['badges']) : ?>
                                                <center> <img src="data:image/png;base64,<?= base64_encode($b['badges']); ?>" alt="Badge Image" width="85"></center>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $b['nama']; ?></td>
                                        <td><?= $b['point']; ?></td>
                                        <td>
                                            <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $b['id_badges']; ?>">Detail</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box border border-dark">
                        <center>
                            <h2> <i class="ion ion-person"><b> User</b></i></h2>
                        </center>
                        <table class="table table-bordered border-light">
                            <thead class="bg-info">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Point</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Badges</th>
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
                                                    echo '<img src="data:image/png;base64,' . base64_encode($selectedBadge['badges']) . '" width="85">';
                                                } else {
                                                    echo 'Tidak ada badge';
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



    </section>
    <!-- /.content -->
</div>

<!-- Modal box Detail -->
<?php foreach ($badges as $b) : ?>
    <div class="modal fade" id="modalDetail<?php echo $b['id_badges']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Badges <?= $b['nama']; ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-13">
                        <center>
                            <?php if ($b['badges']) : ?>
                                <!-- Tambahkan Border lingkaran untuk gambar badges -->
                                <img src="data:image/png;base64,<?= base64_encode($b['badges']); ?>" alt="Badge Image" width="105">
                            <?php endif; ?>
                        </center>
                        <div class="card mb-3">
                            <table class="table table-bordered border-dark">
                                <tbody>
                                    <tr>
                                        <td><b>Nama </b></td>
                                        <td>
                                            <h4><?= $b['nama']; ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Poin </b></td>
                                        <td>
                                            <h4><?= $b['point']; ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Detail </b></td>
                                        <td>
                                            <h4><?= $b['detail']; ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Keterangan </b></td>
                                        <td>
                                            <h4><?= $b['keterangan']; ?></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php endforeach; ?>

<script>
    // Data yang diambil dari PHP
    var labels = <?php echo json_encode(array_column($transactions, 'jenis_transaksi')); ?>;
    var data = <?php echo json_encode(array_column($transactions, 'total')); ?>;
    var backgroundColor = ["#21bcdb", "#db2121", "#f0d11f", "#1ea84a"]; // Warna sesuai kategori

    // Data untuk grafik donut
    var chartData = {
        labels: labels,
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

    // Fungsi untuk menambahkan keterangan pada halaman
    function addLegend() {
        var legend = document.getElementById('legend');
        var content = '';

        labels.forEach(function(label, index) {
            content += '<div class="legend-item"><span style="display:inline-block;width:20px;background-color:' +
                backgroundColor[index] +
                '">&nbsp;</span> ' +
                label +
                ' =' +
                data[index] +
                ' - ' +
                getTransaksiJenis(parseInt(label)) +
                '</div>';
        });

        legend.innerHTML = content;
    }

    // Panggil fungsi untuk menambahkan keterangan
    addLegend();

    // Fungsi untuk mendapatkan jenis transaksi
    function getTransaksiJenis(label) {
        switch (label) {
            case 101:
                return 'Reward';
            case 102:
                return 'Pembelian';
            case 103:
                return 'Punishment';
            default:
                return null;
        }
    }
</script>

<?= $this->endsection(); ?>