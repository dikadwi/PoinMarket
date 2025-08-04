function formatTimeAgo(date) {
    const now = new Date();
    const diffInSeconds = Math.floor((now - new Date(date)) / 1000);
    
    if (diffInSeconds < 60) return `${diffInSeconds} detik yang lalu`;
    
    const diffInMinutes = Math.floor(diffInSeconds / 60);
    if (diffInMinutes < 60) return `${diffInMinutes} menit yang lalu`;
    
    const diffInHours = Math.floor(diffInMinutes / 60);
    if (diffInHours < 24) return `${diffInHours} jam yang lalu`;
    
    const diffInDays = Math.floor(diffInHours / 24);
    if (diffInDays < 7) return `${diffInDays} hari yang lalu`;
    
    return new Date(date).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function getNotificationIcon(type) {
    const icons = {
        'info': 'fas fa-info-circle text-info',
        'success': 'fas fa-check-circle text-success',
        'warning': 'fas fa-exclamation-circle text-warning',
        'error': 'fas fa-times-circle text-danger',
        'default': 'fas fa-bell text-primary'
    };
    return icons[type] || icons['default'];
}

function updateNotificationUI(notifications) {
    const notifCount = notifications.length;
    const notifBadge = $('#unreadNotificationCount');
    const notifList = $('.notification-items');
    
    // Update badge count
    notifBadge.text(notifCount);
    
    // Clear existing notifications
    notifList.empty();
    
    if (notifCount > 0) {
        // Add notifications
        notifications.forEach(notif => {
            const icon = getNotificationIcon(notif.type);
            notifList.append(`
                <div class="dropdown-item notification-item" data-id="${notif.id}">
                    <div class="d-flex align-items-center">
                        <i class="${icon} mr-2"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">${notif.title}</h6>
                            <p class="mb-0 small">${notif.message}</p>
                            <small class="text-muted">${formatTimeAgo(notif.created_at)}</small>
                        </div>
                        <button class="btn btn-sm btn-light mark-as-read" data-id="${notif.id}">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
            `);
        });
    } else {
        notifList.append(`
            <div class="dropdown-item text-center py-3">
                <i class="fas fa-bell-slash text-muted"></i>
                <p class="mb-0 small">Tidak ada notifikasi baru</p>
            </div>
        `);
    }
}

function getUnreadNotifications() {
    $.ajax({
        url: '/notifications/unread',
        method: 'GET',
        success: function(response) {
            if (response.success) {
                updateNotificationUI(response.data);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching notifications:', error);
        }
    });
}

$(document).ready(function() {
    // Initial load
    getUnreadNotifications();
    
    // Refresh every 30 seconds
    setInterval(getUnreadNotifications, 30000);
    
    // Handle mark as read
    $(document).on('click', '.mark-as-read', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const id = $(this).data('id');
        const button = $(this);
        
        $.ajax({
            url: `/notifications/mark-as-read/${id}`,
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    // Remove the notification item
                    button.closest('.notification-item').slideUp(300, function() {
                        $(this).remove();
                        // Refresh notifications
                        getUnreadNotifications();
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error marking notification as read:', error);
            }
        });
    });
    
    // Handle mark all as read
    $('.mark-all-read').click(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '/notifications/mark-all-read',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    // Refresh notifications
                    getUnreadNotifications();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error marking all notifications as read:', error);
            }
        });
    });
    
    // Handle notification item click
    $(document).on('click', '.notification-item', function() {
        const id = $(this).data('id');
        // Mark as read when clicked
        $(this).find('.mark-as-read').click();
    });
});