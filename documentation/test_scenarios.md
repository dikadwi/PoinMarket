# Dokumen Skenario Pengujian PoinMarket

## 1. Pengujian Autentikasi dan Manajemen User
### 1.1 Registrasi User
- TC-REG-001: Registrasi dengan data valid
- TC-REG-002: Registrasi dengan email yang sudah terdaftar
- TC-REG-003: Validasi format email
- TC-REG-004: Validasi kekuatan password
- TC-REG-005: Verifikasi email

### 1.2 Login
- TC-LOG-001: Login dengan kredensial valid
- TC-LOG-002: Login dengan email tidak terdaftar
- TC-LOG-003: Login dengan password salah
- TC-LOG-004: Fungsi "Lupa Password"
- TC-LOG-005: Session handling

### 1.3 Manajemen Role
- TC-ROLE-001: Pemberian role ke user baru
- TC-ROLE-002: Perubahan role user
- TC-ROLE-003: Pembatasan akses berdasarkan role
- TC-ROLE-004: Validasi permission

## 2. Pengujian Marketplace
### 2.1 Manajemen Produk
- TC-PROD-001: Penambahan produk baru
- TC-PROD-002: Edit informasi produk
- TC-PROD-003: Hapus produk
- TC-PROD-004: Upload gambar produk
- TC-PROD-005: Validasi stok produk

### 2.2 Keranjang Belanja
- TC-CART-001: Menambah item ke keranjang
- TC-CART-002: Mengubah kuantitas item
- TC-CART-003: Menghapus item dari keranjang
- TC-CART-004: Perhitungan total belanja
- TC-CART-005: Validasi stok saat checkout

### 2.3 Transaksi
- TC-TRANS-001: Proses checkout
- TC-TRANS-002: Pembayaran dengan poin
- TC-TRANS-003: Pembayaran kombinasi (poin + uang)
- TC-TRANS-004: Pembatalan transaksi
- TC-TRANS-005: Generate invoice

## 3. Pengujian Sistem Poin
### 3.1 Perolehan Poin
- TC-POINT-001: Perolehan poin dari transaksi
- TC-POINT-002: Perolehan poin dari aktivitas pembelajaran
- TC-POINT-003: Bonus poin
- TC-POINT-004: Perhitungan akumulasi poin
- TC-POINT-005: History perolehan poin

### 3.2 Penggunaan Poin
- TC-REDEEM-001: Penukaran poin dengan produk
- TC-REDEEM-002: Penggunaan poin sebagai diskon
- TC-REDEEM-003: Validasi saldo poin
- TC-REDEEM-004: History penggunaan poin
- TC-REDEEM-005: Pembatalan penukaran poin

## 4. Pengujian Fitur Learning
### 4.1 Manajemen Konten
- TC-LEARN-001: Upload materi pembelajaran
- TC-LEARN-002: Edit materi
- TC-LEARN-003: Hapus materi
- TC-LEARN-004: Kategorisasi materi
- TC-LEARN-005: Pencarian materi

### 4.2 Interaksi Pembelajaran
- TC-INT-001: Akses materi pembelajaran
- TC-INT-002: Tracking progress pembelajaran
- TC-INT-003: Quiz/assessment
- TC-INT-004: Pemberian feedback
- TC-INT-005: Generate sertifikat

## 5. Pengujian Integrasi dan API
### 5.1 Integrasi Supabase
- TC-SUP-001: Sinkronisasi data user
- TC-SUP-002: Sinkronisasi transaksi
- TC-SUP-003: Real-time updates
- TC-SUP-004: Error handling
- TC-SUP-005: Backup dan restore

### 5.2 API Endpoints
- TC-API-001: Authentication endpoints
- TC-API-002: Product endpoints
- TC-API-003: Transaction endpoints
- TC-API-004: Learning endpoints
- TC-API-005: Rate limiting

## 6. Pengujian UI/UX
### 6.1 Responsive Design
- TC-UI-001: Desktop view
- TC-UI-002: Tablet view
- TC-UI-003: Mobile view
- TC-UI-004: Print layout
- TC-UI-005: Cross-browser compatibility

### 6.2 Notifikasi
- TC-NOTIF-001: Sweet Alert notifications
- TC-NOTIF-002: Email notifications
- TC-NOTIF-003: In-app notifications
- TC-NOTIF-004: Push notifications
- TC-NOTIF-005: Notification preferences

## 7. Pengujian Keamanan
### 7.1 Autentikasi & Otorisasi
- TC-SEC-001: Session management
- TC-SEC-002: Password encryption
- TC-SEC-003: Role-based access control
- TC-SEC-004: API authentication
- TC-SEC-005: Cross-site scripting prevention

### 7.2 Data Security
- TC-DSEC-001: Data encryption
- TC-DSEC-002: Secure file upload
- TC-DSEC-003: SQL injection prevention
- TC-DSEC-004: Data backup
- TC-DSEC-005: Privacy policy compliance

## 8. Pengujian Performa
### 8.1 Load Testing
- TC-LOAD-001: Concurrent user access
- TC-LOAD-002: Database query performance
- TC-LOAD-003: File upload/download
- TC-LOAD-004: API response time
- TC-LOAD-005: Cache effectiveness

### 8.2 Stress Testing
- TC-STRESS-001: Maximum user capacity
- TC-STRESS-002: Recovery testing
- TC-STRESS-003: Memory leaks
- TC-STRESS-004: Connection limits
- TC-STRESS-005: Error handling under stress

## Format Test Case
```markdown
### Test Case ID: [ID]
**Deskripsi**: [Deskripsi singkat test case]

**Pre-conditions**:
1. [Kondisi yang harus dipenuhi sebelum test]
2. ...

**Test Steps**:
1. [Langkah pengujian]
2. ...

**Expected Result**:
- [Hasil yang diharapkan]

**Actual Result**:
- [Hasil aktual saat pengujian]

**Status**: [Pass/Fail]

**Notes**: [Catatan tambahan jika ada]
```

## Prioritas Pengujian
1. **Critical (P0)**
   - Autentikasi
   - Transaksi
   - Keamanan data

2. **High (P1)**
   - Sistem poin
   - Integrasi API
   - Performa sistem

3. **Medium (P2)**
   - UI/UX
   - Fitur learning
   - Notifikasi

4. **Low (P3)**
   - Fitur tambahan
   - Optimasi
   - Dokumentasi
