<?php

function createNotification($userId, $title, $message, $type, $referenceId = null)
{
    $notificationModel = new \App\Models\NotificationModel();
    
    return $notificationModel->insert([
        'user_id' => $userId,
        'title' => $title,
        'message' => $message,
        'type' => $type,
        'reference_id' => $referenceId,
        'is_read' => 0
    ]);
}

function createTransactionNotification($transaction, $userType)
{
    $title = '';
    $message = '';
    $type = '';
    
    switch ($userType) {
        case 'mahasiswa':
            $title = 'Transaksi Baru';
            $message = "Transaksi poin sebesar {$transaction['points']} telah berhasil";
            $type = 'success';
            break;
        case 'dosen':
            $title = 'Transaksi';
            $message = "Ada transaksi baru yang memerlukan validasi";
            $type = 'transaksi';
            break;
        case 'admin':
        case 'superadmin':
            $title = 'Validasi Transaksi';
            $message = "Transaksi baru telah dibuat oleh {$transaction['user_name']}";
            $type = 'validasi';
            break;
    }
    
    return createNotification(
        $transaction['user_id'],
        $title,
        $message,
        $type,
        $transaction['id']
    );
}