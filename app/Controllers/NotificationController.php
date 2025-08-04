<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotificationModel;

class NotificationController extends ResourceController
{
    use ResponseTrait;

    protected $notificationModel;
    protected $PageModel;
    protected $JenisTransaksiModel;
    protected $userModel;
      
    public function __construct()
    {
        $this->notificationModel = new \App\Models\NotificationModel();
        $this->PageModel = new \App\Models\PageModel();
        $this->JenisTransaksiModel = new \App\Models\JenisTransaksiModel();
        $this->userModel = new \Myth\Auth\Models\UserModel();
    }

    public function index()
    {
        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        if (!$userId = session('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Get user data
        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'username' => $user->username,
            'title' => 'Notifikasi',
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];

        try {
            $notifications = $this->notificationModel
                ->where('user_id', $userId)
                ->orderBy('created_at', 'DESC')
                ->findAll();

            $data['notifications'] = $notifications;

            return view('notifications/index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function detail($id)
    {
        $notificationModel = new NotificationModel();
        $notification = $notificationModel->find($id);
        
        if (!$userId = session('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Get user data
        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan');
        }

        if (!$notification) {
            return redirect()->to('/notifications')->with('error', 'Notifikasi tidak ditemukan');
        }
        

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
     
        $data = [
            'username' => $user->username,
            'title' => 'Detail Notifikasi',
            'notification' => $notification,
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('notifications/detail', $data);
    }

    public function getUnread()
    {
        if (!$userId = session('logged_in')) {
            return $this->fail('Unauthorized', 401);
        }

        try {
            $notifications = $this->notificationModel->getUnreadNotifications($userId);

            return $this->respond(['success' => true, 'data' => $notifications]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function markAsRead($id = null)
    {
        if (!$userId = session('logged_in')) {
            return $this->fail('Unauthorized', 401);
        }

        try {
            if (!$id) {
                return $this->fail('ID notifikasi tidak valid', 400);
            }

            $notification = $this->notificationModel->find($id);
            
            if (!$notification) {
                return $this->fail('Notifikasi tidak ditemukan', 404);
            }

            if ($notification['user_id'] != $userId) {
                return $this->fail('Unauthorized', 401);
            }

            $success = $this->notificationModel->markAsRead($id, $userId);

            if ($success) {
                return $this->respond(['success' => true]);
            } else {
                return $this->fail('Gagal menandai notifikasi sebagai sudah dibaca');
            }
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function markAllRead()
    {
        if (!$userId = session('logged_in')) {
            return $this->fail('Unauthorized', 401);
        }

        try {
            $success = $this->notificationModel->markAllAsRead($userId);

            if ($success) {
                return $this->respond(['success' => true]);
            } else {
                return $this->fail('Gagal menandai semua notifikasi sebagai sudah dibaca');
            }
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function delete($id = null)
    {
        if (!$userId = session('logged_in')) {
            return $this->fail('Unauthorized', 401);
        }

        try {
            if (!$id) {
                return $this->fail('ID notifikasi tidak valid', 400);
            }

            $notification = $this->notificationModel->find($id);
            
            if (!$notification) {
                return $this->fail('Notifikasi tidak ditemukan', 404);
            }

            if ($notification['user_id'] != $userId) {
                return $this->fail('Unauthorized', 401);
            }

            $deleted = $this->notificationModel->delete($id);

            if ($deleted) {
                return $this->respond(['success' => true]);
            } else {
                return $this->fail('Gagal menghapus notifikasi');
            }
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function deleteAll()
    {
        if (!$userId = session('logged_in')) {
            return $this->fail('Unauthorized', 401);
        }

        try {
            $deleted = $this->notificationModel->where('user_id', $userId)->delete();

            if ($deleted) {
                return $this->respond(['success' => true]);
            } else {
                return $this->fail('Gagal menghapus semua notifikasi');
            }
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}