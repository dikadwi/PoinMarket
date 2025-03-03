<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <link rel="shortcut icon" type="image/png" href="/fafavicon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="<?= base_url() ?>/sweetalert2/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .swal2-popup {
            /* font-size: 1.6rem !important; */
            /* height: 100px; */
            /* Menyesuaikan tinggi dengan konten */
            /* width: 10px; */
            /* Menentukan lebar popup */
            font-size: 20px;
            /* Mengatur ukuran font */
        }

        /* Mengatur SmallBox */
        .small-box .icon {
            font-size: 36px;
            transition: font-size 0.3s ease-in-out;
        }

        .small-box .icon:hover {
            font-size: 24px;
        }

        @media (max-width: 768px) {
            .small-box .icon {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .small-box .icon {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .small-box .icon {
                font-size: 14px;
            }
        }

        /* Mengatur Small box-b */
        .small-box.b {
            height: 500px;
            /* Atur tinggi box */
            overflow-y: auto;
            /* Tambahkan scrollbar jika isi box melebihi tinggi */
        }

        .small-box.b canvas {
            width: 100% !important;
            /* Atur lebar grafik */
            height: 400px !important;
            /* Atur tinggi grafik */
        }

        .small-box.b table {
            width: 100% !important;
            /* Atur lebar tabel */
            height: 400px !important;
            /* Atur tinggi tabel */
            overflow-y: auto;
            /* Tambahkan scrollbar jika isi tabel melebihi tinggi */
        }

        /* Mengatur Sticky header */
        .sticky-header {
            position: sticky;
            top: 0;
            background-color: #fff;
            padding: 10px;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Optional: Add a shadow for better readability when scrolled */
        .fixed-header {
            position: relative;
        }

        /* CSS untuk mengatur tinggi baris pada tabel dengan kelas 'table_mahasiswa' */
        .table tr {
            height: 50px;
            /* Atur tinggi baris sesuai kebutuhan */
        }

        .table td,
        .table th {
            padding: 4px;
            /* Atur padding untuk mengurangi ruang di dalam sel */
            text-align: center;
            vertical-align: middle;
        }

        .select option {
            font-style: normal;
        }

        @media (max-width: 768px) {
            .small-box {
                margin-bottom: 20px;
                /* Menambahkan jarak antar kotak */
            }

            h1 {
                font-size: 1.5rem;
                /* Mengurangi ukuran font untuk judul */
            }

            .table {
                font-size: 0.9rem;
                /* Mengurangi ukuran font tabel */
            }
        }



        @media (max-width: 768px) {
            .navbar-nav .nav-link .nav-icon {
                display: inline;
            }

            .main-header .navbar-nav .nav-item {
                flex: 1 1 auto;
                text-align: center;
            }

            .navbar-nav .nav-link span {
                display: none;
                /* Sembunyikan teks */
            }
        }

        @media (max-width: 768px) {
            .main-header .navbar-nav .nav-item {
                flex: 1 1 100%;
                margin-bottom: 5px;
            }

            .main-header .navbar-nav .nav-link {
                font-size: 20px;
                padding: 5px 10px;
            }
        }

        .navbar-toggler-icon {
            transform: scale(0.8) !important;
        }

        .navbar-toggler-icon {
            font-size: 0.8em;
            /* Mengurangi ukuran ikon menjadi 80% dari ukuran aslinya */
        }
    </style>

    </script>
</head>

<!-- sidebar-closed sidebar-collapse"> -->

<body class="hold-transition sidebar-mini sidebar-closed sidebar-collapse layout-fixed layout-navbar-fixed">

    <!-- <body class="layout-top-nav layout-navbar-fixed" style="height: auto;"> -->
    <div class="wrapper">

        <!-- Top Menu -->
        <?= $this->include('User/Template/topmenu'); ?>


        <!-- Sidemenu -->
        <?= $this->include('User/Template/sidemenu'); ?>
        <!-- /.Sidemenu -->


        <!-- Main Content -->
        <?= $this->renderSection('content_user'); ?>

        <!-- Footer -->
        <?= $this->include('User/Template/footer'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>


    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url() ?>/template/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/jquery/jquery_migrate.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url() ?>/template/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url() ?>/template/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= base_url() ?>/template/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url() ?>/template/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url() ?>/template/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url() ?>/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url() ?>/template/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url() ?>/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/template/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/template/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url() ?>/template/dist/js/pages/dashboard.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url() ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url() ?>/sweetalert2/package/dist/sweetalert2.all.js"></script>
    <script src="<?= base_url() ?>/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

        <!-- Render section scripts jika ada -->
        <?= $this->renderSection('scripts') ?>

        <!-- Script untuk API Request -->
    <script>
        // Fungsi untuk mengambil data wallet
        function getMyWallet() {
            const token = '<?= session()->get('token') ?>';
            
            $.ajax({
                url: '/api/wallet/me',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    if (response.error === false) {
                        // Update point dan data mahasiswa
                        $('#current-point').text(response.data.mahasiswa.point);
                        
                        // Update riwayat transaksi
                        let html = '';
                        response.data.riwayat_transaksi.forEach(function(transaksi) {
                            html += `
                                <tr>
                                    <td>${transaksi.tanggal}</td>
                                    <td>${transaksi.jenis_transaksi}</td>
                                    <td>${transaksi.jumlah_point}</td>
                                    <td>${transaksi.keterangan}</td>
                                </tr>
                            `;
                        });
                        $('#tabel-transaksi tbody').html(html);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Gagal mengambil data wallet'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal mengambil data wallet: ' + error
                    });
                }
            });
        }

        // Fungsi untuk memperbarui saldo point
        async function updateWalletInfo() {
            try {
                const walletData = await getMyWallet();
                if (walletData && walletData.mahasiswa) {
                    // Update informasi point di halaman
                    const pointElement = document.getElementById('current-point');
                    if (pointElement) {
                        pointElement.textContent = walletData.mahasiswa.point;
                    }
                }
            } catch (error) {
                console.error('Error updating wallet info:', error);
            }
        }

        // Panggil updateWalletInfo setiap kali halaman dimuat
        document.addEventListener('DOMContentLoaded', updateWalletInfo);

        // Fungsi untuk mengambil data transaksi
        function getTransaksi() {
            const token = '<?= session()->get('token') ?>';
            
            $.ajax({
                url: '/api/wallet/transaksi',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    if (response.error === false) {
                        // Tampilkan data transaksi
                        let html = '';
                        response.data.forEach(function(transaksi) {
                            html += `
                                <tr>
                                    <td>${transaksi.tanggal}</td>
                                    <td>${transaksi.jenis}</td>
                                    <td>${transaksi.jumlah_point}</td>
                                    <td>${transaksi.keterangan}</td>
                                </tr>
                            `;
                        });
                        $('#tabel-transaksi tbody').html(html);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Terjadi kesalahan saat mengambil data transaksi'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengambil data transaksi'
                    });
                }
            });
        }

        // Panggil fungsi saat halaman dimuat
        $(document).ready(function() {
            getMyWallet();
            getTransaksi();
        });
    </script>
    
    <script>
        <?php if (session()->getFlashdata('message')): ?>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '<?= session()->getFlashdata('message'); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>

        // Menampilkan Pesan 'sukses' (yang dikirim dari Controller)
        <?php if (session()->has("sukses")) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                html: '<?= session("sukses") ?>',
                showConfirmButton: false,
                timer: 1300
            })
        <?php endif; ?>

        // Menampilkan Pesan 'validasi' (yang dikirim dari Controller)
        <?php if (session()->has("validasi")) : ?>
            Swal.fire({
                icon: 'info',
                title: 'Menunggu Validasi',
                text: '<?= session("validasi") ?>',
                showConfirmButton: false,
                timer: 1300

            })
        <?php endif; ?>

        // Menampilkan Pesan 'gagal' (yang dikirim dari Controller)
        <?php if (session()->has("gagal")) : ?>
            Swal.fire({
                icon: 'warning',
                title: '<?= session("gagal") ?>',
                text: 'Silahkan Tambah Data Baru',
                showConfirmButton: true,

            })
        <?php endif; ?>

        // Menampilkan Pesan 'gagal1' (yang dikirim dari Controller)
        <?php if (session()->has("gagal1")) : ?>
            Swal.fire({
                icon: 'warning',
                title: '<?= session("gagal1") ?>',
                showConfirmButton: true,

            })
        <?php endif; ?>

        // Button Konfirmasi Hapus
        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: 'Hapus Data ?',
                text: "Apakah Anda Yakin Ingin Menghapus Data !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',

            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
        })

        // Button Konfirmasi Claim
        $(document).on('click', '.btn-claim', function(e) {
            e.preventDefault();
            const form = $(this).closest('.claim-form'); // Ambil form terdekat
            const idTransaksi = form.find('input[name="id_transaksi"]').val();
            const namaTransaksi = form.find('input[name="nama_transaksi"]').val();
            // const poinDigunakan = form.find('input[name="poin_digunakan"]').val();
            const poinDiberikan = form.find('input[name="poin_diberikan"]').val();

            Swal.fire({
                title: 'Claim Reward ?',
                html: `<p>Apakah Anda yakin ingin Claim <strong>${namaTransaksi}</strong> !</p>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Claim',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika pengguna mengonfirmasi
                }
            });
        })

        // // Button Konfirmasi Pembelian
        // $(document).on('click', '.btn-beli', function(e) {
        //     e.preventDefault();
        //     const form = $(this).closest('.buy-form'); // Ambil form terdekat
        //     const namaTransaksi = form.find('input[name="nama_transaksi"]').val();
        //     const poinDigunakan = form.find('input[name="poin_digunakan"]').val();
        //     const redeemCode = form.find('input[name="redeem_code"]').val();

        //     Swal.fire({
        //         title: 'Beli Item?',
        //         // text: "Apakah Anda Yakin Ingin Membeli " + namaTransaksi + "!",
        //         html: `<p>Apakah Anda yakin ingin membeli <strong>${namaTransaksi}</strong> !</p>
        //         <p>Harga : <strong>${poinDigunakan}</strong> Poin</p>`,
        //         // <p>Redeem Code : <strong>${redeemCode}</strong></p>`,
        //         icon: 'question',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Beli',
        //         cancelButtonText: 'Batal',
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             form.submit(); // Submit form jika pengguna mengonfirmasi
        //         }
        //     });
        // })

        // Button Konfirmasi Pembelian
        $(document).on('click', '.btn-beli', function(e) {
            e.preventDefault();
            const form = $(this).closest('.buy-form'); // Ambil form terdekat
            const namaTransaksi = form.find('input[name="nama_transaksi"]').val();
            const poinDigunakan = form.find('input[name="poin_digunakan"]').val();

            Swal.fire({
                title: 'Beli Item?',
                html: `<p>Apakah Anda yakin ingin membeli <strong>${namaTransaksi}</strong> !</p>
                <p>Harga : <strong>${poinDigunakan}</strong> Poin</p>
                <p><strong>Redeem Code : </strong><input type="text" id="redeem_code" placeholder="Masukkan kode redeem"></p>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Beli',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    const redeemCode = document.getElementById('redeem_code').value;
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('cek_redeem_code') ?>',
                        data: {
                            redeem_code: redeemCode
                        },
                        success: function(data) {
                            if (data == 'benar') {
                                // Lakukan submit form dengan redeem code
                                form.submit(); // Submit form jika pengguna mengonfirmasi
                            } else {
                                Swal.fire({
                                    title: 'Kode Redeem Salah',
                                    text: 'Kode redeem yang Anda masukkan salah. Silakan coba lagi.',
                                    icon: 'error',
                                });
                            }
                        }
                    });
                }
            });
        })

        // Button Konfirmasi Misi Tambahan
        $(document).on('click', '.btn-misi', function(e) {
            e.preventDefault();
            const form = $(this).closest('.misi-form'); // Ambil form terdekat
            const namaTransaksi = form.find('input[name="nama_transaksi"]').val();
            const poinDigunakan = form.find('input[name="poin_digunakan"]').val();
            const poinDiberikan = form.find('input[name="poin_diberikan"]').val();

            Swal.fire({
                title: 'Ambil Misi ?',
                // text: "Apakah Anda Yakin Ingin Mengerjakan Misi " + namaTransaksi + "!",
                html: `<p>Apakah Anda yakin ingin Mengerjakan Misi <strong>${namaTransaksi}</strong> !</p>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kerjakan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika pengguna mengonfirmasi
                }
            });
        })

        // Button Konfirmasi Konsultasi
        $(document).on('click', '.btn-konsul', function(e) {
            e.preventDefault();
            const form = $(this).closest('.konsul-form'); // Ambil form terdekat
            const namaTransaksi = form.find('input[name="nama_transaksi"]').val();
            const poinDigunakan = form.find('input[name="poin_digunakan"]').val();

            Swal.fire({
                title: 'Konsultasi ?',
                // text: "Apakah Anda Yakin Ingin Mengerjakan Misi " + namaTransaksi + "!",
                html: `<p>Apakah Anda yakin ingin <strong>${namaTransaksi}</strong> !</p>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kerjakan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika pengguna mengonfirmasi
                }
            });
        })
    </script>

</body>

</html>