<div class="card">
    <div class="card-header">
        <h3 class="card-title">Obrolan</h3>
    </div>
    <div class="card-body">
        <div id="chat-box" style="height: 300px; overflow-y: scroll;">
            <!-- Pesan ditampilkan di sini -->
            <?php foreach ($messages as $message): ?>
                <div class="<?= $message['sender_id'] == $currentUser ? 'text-right' : 'text-left'; ?>">
                    <p><?= esc($message['message']); ?></p>
                    <small><?= $message['created_at']; ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card-footer">
        <form id="send-message" method="post" action="/messages">
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Ketik pesan...">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </span>
            </div>
        </form>
    </div>
</div>