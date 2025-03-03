<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTHandler
{
    private $key;
    private $algorithm;
    private $expire;

    public function __construct()
    {
        $this->key = getenv('JWT_SECRET_KEY') ?: 'your-secret-key-here';
        $this->algorithm = 'HS256';
        $this->expire = 3600; // 1 jam
    }

    public function generateToken($data)
    {
        $issuedAt = time();
        $expire = $issuedAt + $this->expire;

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => $data
        ];

        return JWT::encode($payload, $this->key, $this->algorithm);
    }

    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->key, $this->algorithm));
            return $decoded->data;
        } catch (Exception $e) {
            return false;
        }
    }
}
