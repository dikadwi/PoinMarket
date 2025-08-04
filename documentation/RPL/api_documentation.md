# API Documentation PoinMarket

## Authentication Endpoints

### Login
```
POST /auth/login
Content-Type: application/json

Request:
{
    "username": string,
    "password": string
}

Response:
{
    "status": "success",
    "token": string,
    "user": {
        "id": integer,
        "username": string,
        "role": string
    }
}
```

## Point Management

### Get Point Balance
```
GET /points/balance
Authorization: Bearer {token}

Response:
{
    "status": "success",
    "data": {
        "balance": integer,
        "last_transaction": string
    }
}
```

### Transfer Points
```
POST /points/transfer
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
    "recipient_id": integer,
    "amount": integer,
    "description": string
}

Response:
{
    "status": "success",
    "transaction_id": string
}
```

## Marketplace

### List Products
```
GET /products
Authorization: Bearer {token}

Response:
{
    "status": "success",
    "data": [
        {
            "id": integer,
            "name": string,
            "price": integer,
            "stock": integer,
            "description": string
        }
    ]
}
```

### Create Transaction
```
POST /transactions
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
    "product_id": integer,
    "quantity": integer
}

Response:
{
    "status": "success",
    "transaction": {
        "id": string,
        "total": integer,
        "status": string
    }
}
```

## Notifications

### Get Notifications
```
GET /notifications
Authorization: Bearer {token}

Response:
{
    "status": "success",
    "data": [
        {
            "id": integer,
            "message": string,
            "type": string,
            "read": boolean,
            "created_at": string
        }
    ]
}
```

### Mark Notification as Read
```
POST /notifications/mark-read/{id}
Authorization: Bearer {token}

Response:
{
    "status": "success"
}
```

## Error Responses

### Standard Error Format
```
{
    "status": "error",
    "message": string,
    "code": integer
}
```

### Common Error Codes
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 500: Internal Server Error
