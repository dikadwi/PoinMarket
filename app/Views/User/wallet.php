<?= $this->extend('User/Template/dashboard'); ?>

<?= $this->section('content_user'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Wallet</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/Role_User">User</a></li>
                        <li class="breadcrumb-item active">Wallet</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-coins"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Point Balance</span>
                            <span class="info-box-number">
                                <?= $point ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-trophy"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Peringkat</span>
                            <span class="info-box-number" id="userRank">
                                Loading...
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User</span>
                            <span class="info-box-number" id="totalUsers">
                                <?= $totalMhs ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leaderboard Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-trophy mr-1"></i>
                        Leaderboard
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="leaderboardTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">Rank</th>
                                    <th width="15%">NPM</th>
                                    <th width="40%">Nama</th>
                                    <th width="20%">Point</th>
                                    <th width="20%">Gaya Belajar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded here -->
                                <?php $i = 1; ?>
                                 <?php foreach ($users as $user) : ?>
                                 <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $user['npm']; ?></td>
                                    <td><?= $user['nama']; ?></td>
                                    <td><?= $user['point']; ?></td>
                                    <td><?= $user['gaya_belajar']; ?></td>
                                 </tr>
                                 <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Transaction History Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Riwayat Transaksi
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="transactionTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="20%">Tanggal</th>
                                    <th width="40%">Transaksi</th>
                                    <th width="20%">Point</th>
                                    <th width="20%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Script untuk mengambil dan menampilkan data -->
<script>
$(document).ready(function() {
    const npm = '<?= $npm ?>'; // Ambil NPM dari data yang dikirim controller

    // Fungsi untuk memuat data wallet
    function loadWalletData() {
        $.ajax({
            url: `/api/wallet/${npm}`,
            method: 'GET',
            success: function(response) {
                if (response.status === 200) {
                    const data = response.data;
                    $('#userRank').text(`Peringkat ${data.mahasiswa.leaderboard_position}`);
                    $('#totalUsers').text(data.mahasiswa.total_participants + ' Mahasiswa');
                }
            },
            error: function(xhr, error, thrown) {
                console.error('Error:', error);
                Swal.fire('Error', 'Gagal memuat data wallet', 'error');
            }
        });
    }

    // Load wallet data pertama kali
    loadWalletData();

    // Inisialisasi DataTables untuk Leaderboard
    const leaderboardTable = $('#leaderboardTable').DataTable({
        processing: true,
        responsive: true,
        order: [[3, 'desc']], // Urutkan berdasarkan point (kolom ke-4)
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        ajax: {
            url: '/api/wallet/leaderboard',
            dataSrc: 'data',
            error: function(xhr, error, thrown) {
                console.error('Error:', error);
                Swal.fire('Error', 'Gagal memuat data leaderboard', 'error');
            }
        },
        columns: [
            { data: 'rank' },
            { data: 'npm' },
            { data: 'nama' },
            { 
                data: 'point',
                render: function(data) {
                    return `<strong>${data}</strong>`;
                }
            },
            { data: 'gaya_belajar' }
        ],
        createdRow: function(row, data) {
            // Highlight baris user yang sedang login
            if (data.npm === npm) {
                $(row).addClass('bg-light font-weight-bold');
            }
        }
    });

    // Inisialisasi DataTables untuk Riwayat Transaksi
    const transactionTable = $('#transactionTable').DataTable({
        processing: true,
        responsive: true,
        order: [[0, 'desc']], // Urutkan berdasarkan tanggal terbaru
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        ajax: {
            url: `/api/wallet/history/${npm}`,
            dataSrc: 'data',
            error: function(xhr, error, thrown) {
                console.error('Error:', error);
                Swal.fire('Error', 'Gagal memuat riwayat transaksi', 'error');
            }
        },
        columns: [
            { 
                data: 'tanggal_transaksi',
                render: function(data) {
                    return new Date(data).toLocaleDateString('id-ID', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                }
            },
            { data: 'nama_transaksi' },
            { 
                data: null,
                render: function(data) {
                    // Tampilkan poin_digunakan atau poin_diberikan
                    const point = data.poin_digunakan || data.poin_diberikan;
                    const isNegative = data.poin_digunakan ? true : false;
                    return `<span class="text-${isNegative ? 'danger' : 'success'}">${isNegative ? '-' : '+'}${point}</span>`;
                }
            },
            { 
                data: 'status',
                render: function(data) {
                    const badgeClass = data === 'Yes' ? 'success' : 'danger';
                    return `<span class="badge badge-${badgeClass}">${data}</span>`;
                }
            }
        ]
    });

    // Refresh data setiap 30 detik
    setInterval(function() {
        leaderboardTable.ajax.reload(null, false);
        transactionTable.ajax.reload(null, false);
    }, 30000);
});
</script>

<?= $this->endSection(); ?>
