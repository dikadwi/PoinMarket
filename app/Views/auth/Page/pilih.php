<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <!-- Link ke CDN Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("/img/1712123722306.jpeg");
            background-size: flex;
            background-position: center;
            height: 100vh;
            /* Memastikan background memenuhi seluruh tinggi halaman */
            margin: 0;
            /* Menghilangkan margin default pada body */
        }

        /* Menambahkan efek opasitas pada kolom */
        .column {
            background-color: rgba(255, 255, 255, 0.5);
            /* Menambahkan latar belakang dengan opasitas */
            padding: 20px;
            border-radius: 8px;
        }

        /* Memberikan jarak antar kolom */
        .column-left {
            margin-right: 15px;
            /* Memberikan margin di sebelah kanan kolom kiri */
        }

        .column-right {
            margin-left: 15px;
            /* Memberikan margin di sebelah kiri kolom kanan */
        }
    </style>
</head>

<body>

    <div class="container-lg">
        <h1 class="text-center">Page</h1>

        <!-- Row untuk 2 kolom utama, dengan kolom berada di tengah horizontal -->
        <div class="row justify-content-center">
            <!-- Kolom Kiri untuk Login -->
            <div class="col-md-4 column column-left">
                <h4>Login</h4>
                <div class="col-12 mb-3">
                    <a href="/tespage" class="btn btn-primary w-100 btn-sm">Login 1</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/tespage1" class="btn btn-warning w-100 btn-sm">Login 2</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/tespage2" class="btn btn-success w-100 btn-sm">Login 3</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/tespage3" class="btn btn-danger w-100 btn-sm">Login 4</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/tespage4" class="btn btn-primary w-100 btn-sm">Login 5</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/tespage5" class="btn btn-warning w-100 btn-sm">Login 6</a>
                </div>
            </div>

            <!-- Kolom Kanan untuk Landing Page -->
            <div class="col-md-4 column column-right">
                <h4>Landing Page</h4>
                <div class="col-12 mb-3">
                    <a href="/Landing" class="btn btn-primary w-100 btn-sm">Landing Page 1</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/Landing1" class="btn btn-warning w-100 btn-sm">Landing Page 2</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/Landing2" class="btn btn-success w-100 btn-sm">Landing Page 3</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/Landing3" class="btn btn-danger w-100 btn-sm">Landing Page 4</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/Landing4" class="btn btn-primary w-100 btn-sm">Landing Page 5</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="/Landing5" class="btn btn-warning w-100 btn-sm">Landing Page 6</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke CDN Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>