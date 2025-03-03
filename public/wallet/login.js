$(document).ready(function() {
    // Menangani pengiriman form login
    $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Mencegah form dari pengiriman default

        // Mengambil nilai input dari form
        const npmOrUsername = $('#npm').val(); // Menggunakan npm sebagai username
        const password = $('#password').val();

        // Log data yang akan dikirim
        console.log("Mengirim permintaan login...");
        console.log("NPM/Username:", npmOrUsername);
        console.log("Password:", password);

        // Mengirim permintaan AJAX untuk login
        $.ajax({
            url: 'https://pointmarket.tigaselaras.com/api/Login/process', // Endpoint untuk memproses login
            method: 'POST',
            contentType: 'application/x-www-form-urlencoded', // Mengatur tipe konten
            data: {
                npm_or_username: npmOrUsername, // Mengirimkan npm atau username
                password: password // Mengirimkan password
            },
            success: function(response) {
                   // Periksa apakah respons adalah JSON dan memiliki token
                    if (response.token) {
                        console.log("Login berhasil:", response);
                        localStorage.setItem('token', response.token);
                        localStorage.setItem('npm', npmOrUsername);
                        console.log("Token yang disimpan:", localStorage.getItem('token'));
                        window.location.href = 'dashboard.html';
                    } else {
                        console.error("Token tidak ditemukan dalam respons.");
                        alert('Login gagal! Periksa NPM dan password.');
                    }
            },
            error: function(xhr, status, error) {
                console.error("Error saat login:", error); // Log error
                alert('Login gagal! Periksa NPM dan password.'); // Tampilkan pesan kesalahan
            }
        });
    });
});