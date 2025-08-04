# Panduan Keamanan PoinMarket

## 1. Autentikasi dan Otorisasi

### 1.1 Sistem Login
- Menggunakan Myth/Auth library
- Password hashing dengan bcrypt
- Rate limiting untuk mencegah brute force
- Session timeout setelah 30 menit idle

### 1.2 Role-Based Access Control (RBAC)
```php
// Contoh implementasi filter RBAC
public function filter($role = null) {
    if (!$this->session->get('logged_in')) {
        return redirect()->to('/login');
    }
    
    if ($role && !in_array($this->session->get('role'), (array)$role)) {
        return redirect()->to('/unauthorized');
    }
}
```

### 1.3 Session Management
- Session storage di database
- Regenerasi ID session setiap login
- Secure flag untuk cookies
- HTTP-only cookies

## 2. Keamanan Data

### 2.1 Database Security
- Prepared statements untuk semua query
- Input validation dan sanitization
- Enkripsi data sensitif
- Regular backup dan monitoring

### 2.2 File Security
```php
// Contoh validasi file upload
public function validateFile($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file->getMimeType(), $allowedTypes)) {
        return false;
    }
    
    if ($file->getSize() > $maxSize) {
        return false;
    }
    
    return true;
}
```

### 2.3 API Security
- Token-based authentication
- Rate limiting
- Request validation
- SSL/TLS encryption

## 3. Pencegahan Serangan

### 3.1 XSS Prevention
```php
// Helper function untuk output escaping
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Contoh penggunaan di view
<div class="user-content"><?= e($userContent) ?></div>
```

### 3.2 CSRF Protection
```php
// Form dengan CSRF token
<form method="POST" action="/submit">
    <?= csrf_field() ?>
    <!-- form fields -->
</form>

// Validasi di controller
if (!$this->validate(['csrf_test_name' => 'required'])) {
    return redirect()->back()->with('error', 'Invalid token');
}
```

### 3.3 SQL Injection Prevention
```php
// Gunakan Query Builder
$builder = $db->table('users');
$builder->where('username', $username)
        ->get();

// Atau prepared statements
$sql = "SELECT * FROM users WHERE username = ?";
$query = $db->query($sql, [$username]);
```

## 4. Monitoring dan Logging

### 4.1 Security Logging
```php
// Log security events
public function logSecurityEvent($event, $user_id, $details) {
    $data = [
        'event_type' => $event,
        'user_id' => $user_id,
        'details' => json_encode($details),
        'ip_address' => $this->request->getIPAddress(),
        'user_agent' => $this->request->getUserAgent(),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->table('security_logs')->insert($data);
}
```

### 4.2 Alert System
- Email notifikasi untuk aktivitas mencurigakan
- Dashboard monitoring real-time
- Regular security audit logs

## 5. Backup dan Recovery

### 5.1 Data Backup
- Daily incremental backup
- Weekly full backup
- Encrypted backup storage
- Off-site backup copies

### 5.2 Disaster Recovery
- Documented recovery procedures
- Regular recovery testing
- Multiple recovery points
- Automated failover systems

## 6. Security Best Practices

### 6.1 Password Policy
- Minimum 8 karakter
- Kombinasi huruf, angka, dan simbol
- Tidak boleh sama dengan 5 password terakhir
- Reset password setiap 90 hari

### 6.2 Server Security
- Regular security updates
- Firewall configuration
- DDoS protection
- Server hardening

### 6.3 Code Security
```php
// Contoh validasi input
public function validateInput($input) {
    $rules = [
        'username' => 'required|alpha_numeric|min_length[5]|max_length[50]',
        'email' => 'required|valid_email',
        'phone' => 'required|numeric|min_length[10]|max_length[15]'
    ];
    
    if (!$this->validate($rules)) {
        return false;
    }
    
    return true;
}
```

## 7. Security Checklist

### 7.1 Daily Checks
- [ ] Monitor login attempts
- [ ] Check error logs
- [ ] Verify backup status
- [ ] Review security alerts

### 7.2 Weekly Checks
- [ ] Review user activities
- [ ] Check system updates
- [ ] Analyze traffic patterns
- [ ] Test backup recovery

### 7.3 Monthly Checks
- [ ] Security audit review
- [ ] Update security policies
- [ ] Performance analysis
- [ ] Penetration testing
