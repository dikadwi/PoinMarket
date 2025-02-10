<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Point Market
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" type="image/png" href="/fafavicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" /> -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .custom-card {
            border-radius: 20px;
            /* Sudut yang lebih halus */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* Bayangan */
            transition: transform 0.3s;
            /* Transisi untuk efek hover */
            overflow: hidden;
            /* Menghindari konten keluar dari sudut */
        }

        .custom-card:hover {
            transform: scale(1.05);
            /* Efek zoom saat hover */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            /* Bayangan lebih kuat saat hover */
        }

        .card-header {
            background: linear-gradient(135deg, rgb(105, 66, 201), rgb(173, 62, 151));
            /* Gradien warna */
            padding: 20px;
            border-top-left-radius: 20px;
            /* Sudut atas kiri */
            border-top-right-radius: 20px;
            /* Sudut atas kanan */
            color: white;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
            background-color: white;
            /* Warna latar belakang putih */
        }

        .card-footer {
            padding: 10px;
            background-color: #f8f8f8;
            /* Warna latar belakang footer */
            border-top: 1px solid #e0e0e0;
            /* Garis pemisah */
            text-align: center;
            /* Rata tengah */
            transition: background-color 0.3s;
            /* Transisi untuk efek hover */
        }

        .custom-card:hover .card-footer {
            background-color: #e0e0e0;
            /* Warna latar belakang footer saat hover */
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            /* Menyebar elemen ke kiri dan kanan */
            margin: 20px 0;
            /* Margin atas dan bawah */
        }

        .flex-item {
            background-color: white;
            /* Warna latar belakang putih */
            border-radius: 20px;
            /* Sudut yang lebih halus */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* Bayangan */
            padding: 20px;
            /* Padding di dalam card */
            width: 48%;
            /* Lebar card */
            transition: transform 0.3s;
            /* Transisi untuk efek hover */
        }

        .flex-item:hover {
            transform: scale(1.05);
            /* Efek zoom saat hover */
        }

        .flex-item h2 {
            color: rgb(175, 58, 238);
            /* Warna judul */
            font-size: 2rem;
            /* Ukuran font judul */
            margin-bottom: 10px;
            /* Margin bawah judul */
        }

        .flex-item p {
            color: #555;
            /* Warna teks */
        }

        /* Media Queries untuk Responsivitas */
        @media (max-width: 768px) {
            .text-4xl {
                font-size: 2.5rem;
                /* Mengurangi ukuran font untuk mobile */
            }

            .custom-card {
                width: 100%;
                /* Membuat card lebar penuh pada mobile */
                margin-bottom: 1rem;
                /* Menambahkan jarak antar card */
            }

            .flex-container {
                flex-direction: column;
                /* Mengatur flex container menjadi kolom pada mobile */
            }

            .flex-item {
                width: 100%;
                /* Membuat flex item lebar penuh pada mobile */
            }
        }

        /* Fixed Header Style */
        header {
            position: fixed;
            /* Keep header fixed at the top */
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            /* Ensure it stays above other content */
        }

        /* Media Queries for Mobile Responsiveness */
        @media (max-width: 768px) {
            #menu-toggle:checked+label+#mobile-menu {
                display: block;
                /* Show mobile menu when checkbox is checked */
            }

            #mobile-menu {
                display: none;
                /* Hide mobile menu by default */
                background-color: rgba(255, 255, 255, 0.9);
                z-index: 10;
                padding: 10px 0;
                /* Add padding for mobile menu */
            }
        }

        /* Add some padding to the body to prevent content from being hidden behind the fixed header */
        body {
            padding-top: 100px;
            /* Adjust based on header height */
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .custom-card .fas {
            animation-play-state: paused;
            /* Matikan animasi secara default */
        }

        .custom-card:hover .fas {
            animation-play-state: running;
            /* Aktifkan animasi saat card dihover */
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

    <!-- Header/TopMenu -->
    <?= $this->include('LandingPage/Template/header'); ?>

    <main class="flex-grow">
        <!-- Main Content -->
        <?= $this->renderSection('content'); ?>
    </main>

    <footer class="bg-gray-800 text-white text-center p-4">
        <!-- Footer -->
        <?= $this->include('LandingPage/Template/footer'); ?>
        <!-- /.Footer -->
    </footer>

</body>

</html>