# API Integration Guide PoinMarket

## 1. Autentikasi API

### 1.1 Mendapatkan API Token
```http
POST /api/auth/login
Content-Type: application/json

{
    "username": "your_username",
    "password": "your_password"
}

Response:
{
    "status": "success",
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "expires_in": 3600
}
```

### 1.2 Menggunakan Token
```http
GET /api/resource
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
```

## 2. Endpoint Poin

### 2.1 Cek Saldo Poin
```http
GET /api/points/balance/{user_id}
Authorization: Bearer {token}

Response:
{
    "status": "success",
    "data": {
        "user_id": 123,
        "balance": 1000,
        "last_updated": "2025-03-06T02:10:18Z"
    }
}
```

### 2.2 Transfer Poin
```http
POST /api/points/transfer
Authorization: Bearer {token}
Content-Type: application/json

{
    "from_user": 123,
    "to_user": 456,
    "amount": 100,
    "description": "Reward for assignment"
}

Response:
{
    "status": "success",
    "transaction_id": "TRX-123456",
    "new_balance": 900
}
```

## 3. Endpoint Marketplace

### 3.1 Daftar Produk
```http
GET /api/products
Authorization: Bearer {token}
Query Parameters:
- category_id (optional)
- page (default: 1)
- limit (default: 10)

Response:
{
    "status": "success",
    "data": {
        "products": [
            {
                "id": 1,
                "name": "Product A",
                "price": 500,
                "stock": 10
            }
        ],
        "pagination": {
            "current_page": 1,
            "total_pages": 5,
            "total_items": 50
        }
    }
}
```

### 3.2 Buat Transaksi
```http
POST /api/transactions
Authorization: Bearer {token}
Content-Type: application/json

{
    "user_id": 123,
    "items": [
        {
            "product_id": 1,
            "quantity": 2
        }
    ]
}

Response:
{
    "status": "success",
    "transaction": {
        "id": "TRX-789012",
        "total_amount": 1000,
        "status": "pending"
    }
}
```

## 4. Endpoint Notifikasi

### 4.1 Daftar Notifikasi
```http
GET /api/notifications
Authorization: Bearer {token}
Query Parameters:
- unread_only (boolean, default: false)
- page (default: 1)

Response:
{
    "status": "success",
    "data": {
        "notifications": [
            {
                "id": 1,
                "title": "New Transaction",
                "message": "Your transaction TRX-123456 is completed",
                "read": false,
                "created_at": "2025-03-06T02:00:00Z"
            }
        ]
    }
}
```

### 4.2 Tandai Notifikasi Dibaca
```http
POST /api/notifications/mark-read/{notification_id}
Authorization: Bearer {token}

Response:
{
    "status": "success"
}
```

## 5. Webhook Integration

### 5.1 Setup Webhook
```http
POST /api/webhooks/register
Authorization: Bearer {token}
Content-Type: application/json

{
    "url": "https://your-domain.com/webhook",
    "events": ["transaction.completed", "points.updated"],
    "secret": "your_webhook_secret"
}

Response:
{
    "status": "success",
    "webhook_id": "WHK-123456"
}
```

### 5.2 Format Webhook Event
```json
{
    "event": "transaction.completed",
    "timestamp": "2025-03-06T02:10:18Z",
    "data": {
        "transaction_id": "TRX-123456",
        "status": "completed",
        "amount": 1000
    },
    "signature": "sha256_hash_signature"
}
```

## 6. Error Handling

### 6.1 Format Error
```json
{
    "status": "error",
    "code": "ERROR_CODE",
    "message": "Human readable error message",
    "details": {
        "field": "Specific error details"
    }
}
```

### 6.2 Kode Error
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 422: Validation Error
- 429: Too Many Requests
- 500: Internal Server Error

## 7. Rate Limiting

### 7.1 Headers
```http
X-RateLimit-Limit: 100
X-RateLimit-Remaining: 98
X-RateLimit-Reset: 1583465418
```

### 7.2 Limits
- Authentication: 10 requests/minute
- General API: 100 requests/minute
- Webhook: 1000 requests/day

## 8. Contoh Integrasi

### 8.1 PHP Client
```php
class PoinMarketClient {
    private $apiKey;
    private $baseUrl;
    
    public function __construct($apiKey, $baseUrl = 'https://api.poinmarket.com') {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }
    
    public function getBalance($userId) {
        $response = $this->request('GET', "/points/balance/{$userId}");
        return json_decode($response, true);
    }
    
    private function request($method, $endpoint, $data = []) {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json'
        ]);
        
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
}
```

### 8.2 JavaScript Client
```javascript
class PoinMarketAPI {
    constructor(apiKey, baseUrl = 'https://api.poinmarket.com') {
        this.apiKey = apiKey;
        this.baseUrl = baseUrl;
    }
    
    async getBalance(userId) {
        const response = await fetch(`${this.baseUrl}/points/balance/${userId}`, {
            headers: {
                'Authorization': `Bearer ${this.apiKey}`,
                'Content-Type': 'application/json'
            }
        });
        
        return response.json();
    }
    
    async createTransaction(data) {
        const response = await fetch(`${this.baseUrl}/transactions`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${this.apiKey}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        return response.json();
    }
}
```
