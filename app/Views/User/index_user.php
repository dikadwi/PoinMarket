<?= $this->extend('User/template/dashboard'); ?>

<?= $this->section('content_user'); ?>
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
        <!-- Menampilkan Profil -->
        <div class="col-lg-6 col-md-12 mb-3">
          <!-- small box -->
          <div class="small-box border border-dark">
            <center>
              <h2> <i class="ion ion-person"><b> Profil</b></i></h2>
            </center>
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-4">
                  <img src="/img/admin.jpg" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <h5 class="card-title"><b>Nama : </b><?= $username; ?></h5>
                      </li>
                      <li class="list-group-item">
                        <h5 class="card-title"><b>NPM : </b><?= $npm; ?></h5>
                      </li>
                      <?php if (!empty($email)) : ?>
                        <li class="list-group-item">
                          <h5 class="card-title"><b>Email : </b><?= $email; ?></h5>
                        </li>
                      <?php else : ?>
                        <li class="list-group-item">
                          <h5 class="card-title"><b>Email : </b>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#modalEmail" class="small-box-footer">Tambahkan Email</a>
                          </h5>
                        </li>
                      <?php endif; ?>
                      <li class="list-group-item">
                        <h5 class="card-title"><b>Point : </b><?= $point; ?></h5>
                      </li>
                      <li class="list-group-item">
                        <h5 class="card-title"><b>Level : </b>
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
                            echo $selectedBadge['nama'];
                          } else {
                            echo 'Tidak ada badge';
                          }
                          ?></h5>
                      </li>
                      <li class="list-group-item">
                        <h5 class="card-title"><b>Badges : </b></h5>
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
                          echo '<img src="data:image/png;base64,' . base64_encode($selectedBadge['badges']) . '" width="85">';
                        } else {
                          echo 'Tidak ada badge';
                        }
                        ?>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Menampilkan Leaderboard -->
        <div class="col-lg-6 col-md-12 mb-3 d-flex">
          <div class="small-box border border-dark flex-fill">
            <center>
              <h2><i class="ion ion-trophy"><b> Leaderboard</b></i></h2>
            </center>
            <div class="card mb-3">
              <div class="card-body">
                <table class="table table-bordered border-dark">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Poin</th>
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
                        <td><?php echo $i++; ?></td>
                        <td><?= $user['nama']; ?></td>
                        <td><?= $user['point']; ?></td>
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
    <!-- Menampilkan data -->
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-3 ">
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
          <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDetailReward" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          <!-- <a href="/Role_User/transaksi_reward" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3 ">
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
          <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDetailPembelian" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          <!-- <a href="/Role_User/transaksi_pembelian" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3 ">
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
          <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDetailPunishment" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          <!-- <a href="/Role_User/transaksi_punishment" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3 ">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h2>Misi Tambahan</h2>
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



<!-- Modal Box Detail Reward -->
<div class="modal fade" id="modalDetailReward">
  <div class=" modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Rewards</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered border-dark">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Transaksi</th>
              <th>Poin Digunakan</th>
              <th>Tanggal Transaksi</th>
              <th>Validasi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data_transaksi as $data) : ?>
              <?php if ($data['jenis_transaksi'] == '101') : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $data['nama_transaksi']; ?></td>
                  <td><?= $data['poin_digunakan']; ?></td>
                  <td><?= $data['tanggal_transaksi']; ?></td>
                  <td>
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
                  </td>
                </tr>
              <?php endif ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Box Detail Pembelian -->
<div class="modal fade" id="modalDetailPembelian">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered border-dark">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Transaksi</th>
              <th>Poin Digunakan</th>
              <th>Tanggal Transaksi</th>
              <th>Validasi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data_transaksi as $data) : ?>
              <?php if ($data['jenis_transaksi'] == '102') : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $data['nama_transaksi']; ?></td>
                  <td><?= $data['poin_digunakan']; ?></td>
                  <td><?= $data['tanggal_transaksi']; ?></td>
                  <td>
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
                  </td>
                </tr>
              <?php endif ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Box Detail Punishment -->
<div class="modal fade" id="modalDetailPunishment">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Punishment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered border-dark">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Transaksi</th>
              <th>Poin Digunakan</th>
              <th>Tanggal Transaksi</th>
              <th>Validasi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data_transaksi as $data) : ?>
              <?php if ($data['jenis_transaksi'] == '103') : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $data['nama_transaksi']; ?></td>
                  <td><?= $data['poin_digunakan']; ?></td>
                  <td><?= $data['tanggal_transaksi']; ?></td>
                  <td>
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
                  </td>
                </tr>
              <?php endif ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Box Detail Punishment -->
<div class="modal fade" id="modalDetailMisi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Misi Tambahan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered border-dark">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Transaksi</th>
              <th>Poin Digunakan</th>
              <th>Tanggal Transaksi</th>
              <th>Validasi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data_transaksi as $data) : ?>
              <?php if ($data['jenis_transaksi'] == '105') : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $data['nama_transaksi']; ?></td>
                  <td><?= $data['poin_digunakan']; ?></td>
                  <td><?= $data['tanggal_transaksi']; ?></td>
                  <td>
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
                  </td>
                </tr>
              <?php endif ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

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
</script>

<?= $this->endsection(); ?>