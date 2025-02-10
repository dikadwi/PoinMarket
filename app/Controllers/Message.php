<?php

namespace App\Controllers;

use App\Models\MessageModel;
use CodeIgniter\RESTful\ResourceController;

class MessageController extends ResourceController
{
    protected $modelName = 'App\Models\MessageModel';
    protected $format    = 'json';

    public function index()
    {
        $userId = $this->request->getVar('user_id');
        $otherUserId = $this->request->getVar('other_user_id');

        $messages = $this->model->getMessages($userId, $otherUserId);
        return $this->respond($messages);
    }

    public function create()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Message sent successfully']);
        }

        return $this->fail('Failed to send message');
    }

    public function markRead($id)
    {
        if ($this->model->markAsRead($id)) {
            return $this->respond(['message' => 'Message marked as read']);
        }

        return $this->fail('Failed to update message status');
    }
}
