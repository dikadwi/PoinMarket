# Dokumentasi Component Diagram PoinMarket

## 1. Presentation Layer
- **Web UI**: Interface utama berbasis HTML5, CSS3, dan JavaScript
- **Admin UI**: Interface admin menggunakan template AdminLTE

## 2. Application Layer
- **Authentication**: Sistem autentikasi menggunakan Myth/Auth
- **User Management**: Pengelolaan user, role, dan permissions
- **Point System**: Manajemen poin dan transaksi
- **Marketplace**: Sistem jual-beli produk
- **Consultation**: Sistem konsultasi dan booking

## 3. Service Layer
- **Notification Service**: Pengelolaan notifikasi (email, in-app)
- **Security Service**: Keamanan sistem dan validasi
- **Logging Service**: Pencatatan aktivitas dan error

## 4. Data Layer
- **MySQL Database**: Penyimpanan data utama
- **Redis Cache**: Caching dan session management
- **File Storage**: Penyimpanan file dan media

## 5. External Services
- **Email Service**: Layanan pengiriman email
- **Payment Gateway**: Layanan pembayaran

## 6. Hubungan Antar Komponen

### 6.1. Main Flow (Biru)
- UI → Authentication → User Management → Business Modules
- Menunjukkan alur utama aplikasi

### 6.2. Service Integration (Hijau)
- Business Modules → Services
- Integrasi dengan layanan pendukung

### 6.3. Data Access (Ungu)
- Modules → Database/Cache/Storage
- Akses ke penyimpanan data

### 6.4. External Integration (Merah)
- Services → External Services
- Integrasi dengan layanan eksternal

## 7. Keunggulan Arsitektur
1. **Modular**: Komponen terpisah dan independen
2. **Scalable**: Mudah dikembangkan
3. **Maintainable**: Mudah dikelola
4. **Secure**: Keamanan berlapis
