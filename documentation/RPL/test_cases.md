# Test Cases PoinMarket

## 1. Unit Testing

### 1.1 Autentikasi
| ID | Test Case | Input | Expected Output | Kondisi |
|----|-----------|-------|-----------------|---------|
| AUTH-01 | Login Valid | username: "dosen1", password: "valid123" | Login berhasil, redirect ke dashboard | Pre: User terdaftar |
| AUTH-02 | Login Invalid | username: "dosen1", password: "wrong" | Pesan error "Invalid credentials" | Pre: User terdaftar |
| AUTH-03 | Logout | Click logout button | Redirect ke halaman login | Pre: User logged in |

### 1.2 Manajemen Poin
| ID | Test Case | Input | Expected Output | Kondisi |
|----|-----------|-------|-----------------|---------|
| POINT-01 | Pemberian Poin | mahasiswa: "mhs1", poin: 100 | Poin bertambah, notifikasi terkirim | Pre: Dosen login |
| POINT-02 | Cek Saldo | View saldo | Tampil saldo aktual | Pre: User login |
| POINT-03 | Riwayat Poin | View riwayat | List transaksi poin | Pre: Ada transaksi |

### 1.3 Marketplace
| ID | Test Case | Input | Expected Output | Kondisi |
|----|-----------|-------|-----------------|---------|
| MARKET-01 | Beli Produk | produk_id: 1, qty: 2 | Transaksi berhasil | Pre: Stok tersedia |
| MARKET-02 | Stok Habis | produk_id: 1, qty: 999 | Pesan "Stok tidak cukup" | Pre: Stok < qty |
| MARKET-03 | Poin Kurang | produk mahal | Pesan "Poin tidak cukup" | Pre: Poin < harga |

## 2. Integration Testing

### 2.1 Alur Transaksi
| ID | Test Case | Steps | Expected Output | Kondisi |
|----|-----------|-------|-----------------|---------|
| FLOW-01 | Transaksi Sukses | 1. Pilih produk<br>2. Checkout<br>3. Konfirmasi | Transaksi berhasil, stok berkurang | Pre: Stok & poin cukup |
| FLOW-02 | Pembatalan | 1. Pilih produk<br>2. Batal | Kembali ke katalog | Pre: Belum checkout |
| FLOW-03 | Update Stok | 1. Beli produk<br>2. Cek stok | Stok berkurang sesuai qty | Pre: Transaksi sukses |

### 2.2 Notifikasi
| ID | Test Case | Steps | Expected Output | Kondisi |
|----|-----------|-------|-----------------|---------|
| NOTIF-01 | Notif Transaksi | Selesai transaksi | Notif diterima pembeli & admin | Pre: Transaksi sukses |
| NOTIF-02 | Notif Poin | Pemberian poin | Notif diterima mahasiswa | Pre: Poin diberikan |
| NOTIF-03 | Read Status | Baca notifikasi | Status berubah "read" | Pre: Ada notif unread |

## 3. System Testing

### 3.1 Performance
| ID | Test Case | Kondisi | Expected Output | Kriteria Sukses |
|----|-----------|---------|-----------------|------------------|
| PERF-01 | Load Time | 100 user concurrent | Response < 2s | 95% requests sukses |
| PERF-02 | Database | 1000 transaksi | Query < 1s | No timeout/error |
| PERF-03 | Notifikasi | 500 notif/menit | Delivery < 5s | 99% terkirim |

### 3.2 Security
| ID | Test Case | Method | Expected Output | Kriteria Sukses |
|----|-----------|--------|-----------------|------------------|
| SEC-01 | SQL Injection | Input karakter khusus | Query aman | No vulnerability |
| SEC-02 | XSS Attack | Input script | Script tidak eksekusi | Content filtered |
| SEC-03 | CSRF | Request tanpa token | Request ditolak | Validasi token |

### 3.3 Compatibility
| ID | Test Case | Environment | Expected Output | Kriteria Sukses |
|----|-----------|-------------|-----------------|------------------|
| COMP-01 | Browser | Chrome, Firefox, Safari | Tampilan konsisten | No visual bugs |
| COMP-02 | Responsive | Mobile, Tablet, Desktop | Layout adaptif | No overflow |
| COMP-03 | OS | Windows, Linux, MacOS | Fungsi normal | No OS-specific bugs |

## 4. User Acceptance Testing

### 4.1 Superadmin
| ID | Fitur | Kriteria | Status |
|----|-------|----------|---------|
| UAT-01 | Manajemen User | Bisa CRUD semua tipe user | - |
| UAT-02 | Konfigurasi | Bisa update sistem setting | - |
| UAT-03 | Monitoring | Bisa lihat log & statistik | - |

### 4.2 Admin
| ID | Fitur | Kriteria | Status |
|----|-------|----------|---------|
| UAT-04 | Produk | Bisa manage katalog | - |
| UAT-05 | Transaksi | Bisa proses & monitor | - |
| UAT-06 | Laporan | Bisa generate & export | - |

### 4.3 Dosen
| ID | Fitur | Kriteria | Status |
|----|-------|----------|---------|
| UAT-07 | Poin | Bisa beri & monitor poin | - |
| UAT-08 | Evaluasi | Bisa input nilai/feedback | - |
| UAT-09 | Badge | Bisa assign badge | - |

### 4.4 Mahasiswa
| ID | Fitur | Kriteria | Status |
|----|-------|----------|---------|
| UAT-10 | Marketplace | Bisa browse & beli | - |
| UAT-11 | Wallet | Bisa cek & use poin | - |
| UAT-12 | Profile | Bisa update info | - |
