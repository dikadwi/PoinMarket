# Dokumentasi Network Diagram PoinMarket

## Arsitektur Jaringan

### 1. Zona Publik
- **Perangkat Pengguna**
  - Browser web
  - Aplikasi mobile
  - Akses melalui HTTPS
- **DNS Server**
  - Manajemen domain PoinMarket
  - Resolusi nama domain
- **CDN (Content Delivery Network)**
  - Penyimpanan aset statis
  - Optimasi kecepatan loading

### 2. DMZ (Demilitarized Zone)
- **Load Balancer (Nginx)**
  - Distribusi beban server
  - Manajemen traffic
- **Web Application Firewall**
  - Perlindungan aplikasi web
  - Filter request berbahaya
- **Reverse Proxy**
  - Cache konten
  - Keamanan tambahan

### 3. Zona Aplikasi
- **Web Server (Apache/XAMPP)**
  - Hosting aplikasi web
  - Manajemen HTTP request
- **Aplikasi PoinMarket**
  - Framework CodeIgniter 4
  - Logic bisnis utama
- **Cache Server (Redis)**
  - Penyimpanan cache
  - Peningkatan performa
- **Session Storage**
  - Manajemen sesi pengguna
  - Data temporary

### 4. Zona Database
- **Database Master**
  - MySQL/MariaDB
  - Penyimpanan data utama
- **Database Slave**
  - Replikasi database
  - High availability
- **Backup Storage**
  - Backup berkala
  - Disaster recovery

### 5. Zona Keamanan
- **Firewall**
  - Kontrol akses jaringan
  - Perlindungan infrastruktur
- **Intrusion Detection System**
  - Monitoring aktivitas mencurigakan
  - Alert keamanan
- **Log Server**
  - Pencatatan aktivitas sistem
  - Audit trail
- **Monitoring System**
  - Pemantauan performa
  - Alert sistem

## Protokol Komunikasi

### 1. HTTPS (443)
- Enkripsi end-to-end
- SSL/TLS certificates
- Keamanan data pengguna

### 2. HTTP (80)
- Komunikasi internal
- Reverse proxy ke aplikasi
- Redirect ke HTTPS

### 3. MySQL (3306)
- Koneksi database
- Replikasi master-slave
- Backup dan restore

### 4. Redis (6379)
- Cache data
- Manajemen sesi
- Komunikasi real-time

## Keamanan Jaringan

### 1. Firewall Rules
- Pembatasan port
- Whitelist IP
- Rate limiting

### 2. Monitoring
- Real-time alerts
- Performance metrics
- Security logs

### 3. Backup Strategy
- Daily incremental backup
- Weekly full backup
- Off-site storage

## Optimasi Performa

### 1. Load Balancing
- Round-robin distribution
- Health checks
- Failover support

### 2. Caching
- Browser cache
- Application cache
- Database query cache

### 3. CDN
- Static asset delivery
- Geographic distribution
- Cache optimization

## Disaster Recovery

### 1. High Availability
- Database replication
- Server redundancy
- Automatic failover

### 2. Backup
- Database dumps
- File system backup
- Configuration backup

### 3. Recovery Plan
- Recovery point objective (RPO)
- Recovery time objective (RTO)
- Testing procedure

## Maintenance

### 1. Regular Updates
- Security patches
- System updates
- Dependency updates

### 2. Monitoring
- Server health
- Application metrics
- Security alerts

### 3. Documentation
- Network topology
- Configuration settings
- Emergency procedures
