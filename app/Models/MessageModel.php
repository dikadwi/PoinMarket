<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sender_id', 'receiver_id', 'message', 'is_read', 'created_at'];

    public function getMessages($userId, $otherUserId)
    {
        return $this->where('(sender_id = ' . $userId . ' AND receiver_id = ' . $otherUserId . ')')
            ->orWhere('(sender_id = ' . $otherUserId . ' AND receiver_id = ' . $userId . ')')
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    public function markAsRead($messageId)
    {
        return $this->update($messageId, ['is_read' => 1]);
    }
}
