$(document).ready(function() {
    // Memeriksa apakah pengguna sudah login
    const token = localStorage.getItem('token');
    if (!token) {
        alert('Silakan login terlebih dahulu.');
        window.location.href = 'login.html'; // Redirect ke halaman login jika tidak ada token
        return;
    }

    // Log token untuk verifikasi
    console.log("Token yang digunakan:", token);

    // Mengambil data wallet setelah halaman dimuat
    $.ajax({
        url: 'https://pointmarket.tigaselaras.com/api/wallet/my',
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}` // Menggunakan token dari localStorage
        },
        success: function(response) {
            console.log("Data wallet berhasil diambil:", response); // Log data yang diterima
        
            if (response.status === 200 && response.data) {
                const mahasiswa = response.data.mahasiswa;
                const riwayatTransaksi = response.data.riwayat_transaksi;
        
                // Tampilkan data mahasiswa dalam kartu
                $('#studentData').html(`
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Data Mahasiswa</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>NPM:</strong> ${mahasiswa.npm}</p>
                            <p><strong>Nama:</strong> ${mahasiswa.nama}</p>
                            <p><strong>Email:</strong> ${mahasiswa.email}</p>
                            <p><strong>Gaya Belajar:</strong> ${mahasiswa.gaya_belajar}</p>
                            <p><strong>Total Transaksi:</strong> ${mahasiswa.total_transaksi}</p>
                            <p><strong>Point:</strong> ${mahasiswa.point}</p>
                        </div>
                    </div>
                `);
        
                // Tampilkan riwayat transaksi dalam tabel
                let transaksiHtml = `
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Transaksi (5 Transaksi Terakhir)</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                `;
                riwayatTransaksi.forEach(function(transaksi) {
                    transaksiHtml += `
                        <tr>
                            <td>${transaksi.keterangan}</td>
                            <td>${transaksi.tanggal}</td>
                            <td>${transaksi.jumlah_point}</td>
                        </tr>
                    `;
                });
                transaksiHtml += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
        
                $('#transactionHistory').html(transaksiHtml); // Pastikan ada elemen dengan ID transactionHistory di HTML
            } else {
                console.error("Data tidak valid atau tidak ditemukan");
                alert('Gagal mengambil data mahasiswa.');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error saat mengambil data wallet:", error);
        }
    });
    // Event listener untuk tombol logout
    $('#logoutButton').on('click', function() {
        // Hapus token dari localStorage
        localStorage.removeItem('token');
        localStorage.removeItem('npm'); // Hapus npm juga jika diperlukan

        // Redirect ke halaman login
        window.location.href = 'login.html';
    });
});