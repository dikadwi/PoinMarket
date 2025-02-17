<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use Config\Supabase;

class SupabaseAPI
{
    private $client;
    private $baseUrl;
    private $apiKey;

    public function __construct()
    {
        // Mengambil konfigurasi dari file config/Supabase.php untuk koneksi ke server
        $config = new Supabase();

        // Inisialisasi base URL dan API Key dari konfigurasi
        $this->baseUrl = $config->url . "/rest/v1/";
        $this->apiKey = $config->apiKey;

        // Membuat instance Guzzle client
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'apikey' => $this->apiKey,
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * Mendapatkan data dari tabel Supabase
     * 
     * @param string $table Nama tabel di Supabase
     * @return array
     */
    public function getData($table)
    {
        $response = $this->client->request('GET', $table);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Menyisipkan data ke tabel Supabase
     * 
     * @param string $table Nama tabel di Supabase
     * @param array $data Data yang akan disisipkan
     * @return array
     */
    public function insertData($table, $data)
    {
        $response = $this->client->request('POST', $table, [
            'json' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Mengupdate data di tabel Supabase
     * 
     * @param string $table Nama tabel di Supabase
     * @param int $id ID data yang akan diupdate
     * @param array $data Data yang akan diupdate
     * @return array
     */
    public function updateData($table, $id, $data)
    {
        $url = "{$table}?id=eq.{$id}";
        $response = $this->client->request('PATCH', $url, [
            'json' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Menghapus data dari tabel Supabase
     * 
     * @param string $table Nama tabel di Supabase
     * @param int $id ID data yang akan dihapus
     * @return bool
     */

    public function deleteData($table, $id)
    {
        // Membuat URL endpoint untuk menghapus data berdasarkan ID
        $url = "{$table}?id=eq.{$id}";

        try {
            // Mengirim request DELETE ke Supabase
            $response = $this->client->request('DELETE', $url);

            // Cek jika status code 200 atau 204, berarti berhasil dihapus
            if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
                return true; // Data berhasil dihapus
            }
        } catch (\Exception $e) {
            // Menangani kesalahan jika request gagal
            log_message('error', 'Error deleting data from Supabase: ' . $e->getMessage());
        }

        return false; // Jika gagal menghapus data
    }
}
