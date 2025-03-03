<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .error-container {
            text-align: center;
        }
        .error-container h1 {
            font-size: 5rem;
            color: #dc3545;
        }
        .error-container p {
            font-size: 1.5rem;
        }
        .error-container img {
            max-width: 50%; /* Setel lebar maksimum gambar menjadi 50% */
            height: auto;   /* Memastikan tinggi gambar proporsional */
        }
    </style>
</head>
<body>
    <div class="error-container">
        <!-- <h1>404</h1> -->
        <img src="<?= base_url('img/404.png'); ?>" alt="404 Not Found" /> <!-- Gambar 404 -->
        <p>Halaman tidak ditemukan.</p>
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
        <a href="<?= base_url(); ?>" class="btn btn-primary">Beranda</a>
    </div>
</body>
</html>