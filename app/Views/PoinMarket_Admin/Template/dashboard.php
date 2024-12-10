<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

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
    <style>
        .swal2-popup {
            font-size: 1.6rem !important;
        }

        #legend {
            display: flex;
            /* Gunakan flexbox untuk mengatur elemen secara horizontal */
            flex-wrap: wrap;
            /* Pindah ke baris baru jika konten tidak cukup */
            gap: 10px;
            /* Jarak antar item dalam legend */
            justify-content: center;
            /* Pusatkan konten secara horizontal */
            align-items: center;
            /* Pusatkan konten secara vertikal */
            border: 1px solid #ccc;
            /* Tambahkan border jika diperlukan */
            padding: 10px;
            /* Atur padding jika diperlukan */
        }

        .legend-item {
            display: flex;
            /* Gunakan flexbox untuk mengatur elemen secara horizontal */
            align-items: center;
            /* Pusatkan konten secara vertikal */
        }

        .legend-color {
            width: 20px;
            /* Atur lebar warna */
            height: 10px;
            /* Atur tinggi warna */
            margin-right: 5px;
            /* Jarak antara warna dan teks */
        }
    </style>
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
        <?= $this->include('PoinMarket_Admin/Template/topmenu'); ?>
        <!-- /.navbar -->

        <!-- Sidemenu -->
        <?= $this->include('PoinMarket_Admin/Template/sidemenu'); ?>
        <!-- /.Sidemenu -->

        <!-- <div class="content-wrapper"> -->
        <!-- Main Content -->
        <?= $this->renderSection('content'); ?>
        <!-- /.Main Content -->
        <!-- </div> -->

        <!-- Footer -->
        <?= $this->include('PoinMarket_Admin/Template/footer'); ?>
        <!-- /.Footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

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
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>


    <script>
        <?php if (session()->has("sukses")) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session("sukses") ?>',
                showConfirmButton: false,
                timer: 1300
            })
        <?php endif; ?>

        <?php if (session()->has("validasi")) : ?>
            Swal.fire({
                icon: 'info',
                title: 'Menunggu Validasi',
                text: '<?= session("validasi") ?>',
                showConfirmButton: false,
                timer: 1300

            })
        <?php endif; ?>

        <?php if (session()->has("gagal")) : ?>
            Swal.fire({
                icon: 'warning',
                title: '<?= session("gagal") ?>',
                text: 'Silahkan Tambah Data Baru',
                showConfirmButton: true,

            })
        <?php endif; ?>


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

        // $(document).on('click', '.btn-beli', function(e) {
        //     e.preventDefault();
        //     const href = $(this).attr('href');

        //     Swal.fire({
        //         title: 'Beli ?',
        //         text: "Apakah Anda Yakin Ingin Membeli Item !",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Beli',
        //         cancelButtonText: 'Batal',

        //     }).then((result) => {
        //         if (result.value) {
        //             document.location.href = href;
        //         }
        //     })
        // })

        // let scanner = new Instascan.Scanner({
        // video: document.getElementById('preview')
        //});
        //Instascan.Camera.getCameras().then(function(cameras) {
        // if (cameras.length > 0) {
        // scanner.start(cameras[0]);
        // } else {
        // alert('No Camera');
        //}
        //}).catch(function(e) {
        // console.error(e);
        //});

        scanner.addListener('scan', function(c) {
            document.getElementById('text').value = c;
            // document.forms[0].submit();
        });
    </script>

</body>

</html>