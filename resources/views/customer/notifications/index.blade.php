<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notifications - PAWSER</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100%;
            background: #f8fafc;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            padding: 0 20px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-title {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .navbar-start {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-back-btn {
            background: white;
            border: none;
            color: #14b8a6;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .navbar-back-btn:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateX(-4px);
        }

        .content-container {
            margin-top: 90px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            flex: 1;
        }

        .notifications-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #e5e7eb;
        }

        .notifications-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .mark-all-read-btn {
            background: #14b8a6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .mark-all-read-btn:hover {
            background: #0d9488;
            transform: scale(1.02);
        }

        .notifications-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .notification-card {
            background: white;
            border-left: 4px solid #14b8a6;
            border-radius: 8px;
            padding: 16px;
            display: flex;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .notification-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateX(4px);
        }

        .notification-card.unread {
            background: #f0fdf4;
            border-left-color: #10b981;
        }

        .notification-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .notification-icon.approved {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .notification-icon.rejected {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .notification-icon.default {
            background: rgba(20, 184, 166, 0.1);
            color: #14b8a6;
        }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title {
            font-weight: 700;
            font-size: 15px;
            color: #1f2937;
            margin: 0 0 6px 0;
        }

        .notification-message {
            font-size: 13px;
            color: #6b7280;
            margin: 0 0 8px 0;
            line-height: 1.5;
        }

        .notification-time {
            font-size: 12px;
            color: #9ca3af;
        }

        .notification-badge {
            background: #10b981;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            margin-left: auto;
            flex-shrink: 0;
            align-self: center;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state-icon {
            font-size: 48px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .empty-state-text {
            color: #6b7280;
            font-size: 16px;
            margin: 0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: #f3f4f6;
            color: #14b8a6;
        }

        .pagination .active span {
            background: #14b8a6;
            color: white;
            border-color: #14b8a6;
        }

        @media (max-width: 768px) {
            .content-container {
                padding: 16px;
            }

            .notifications-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .mark-all-read-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="navbar-fixed">
    <div class="navbar-start">
        <button class="navbar-back-btn" onclick="window.history.back()">
            <i class="bi bi-chevron-left"></i> Back
        </button>
    </div>
    <h1 class="navbar-title">Notifications</h1>
    <div></div>
</div>

<div class="content-container">
    <div class="notifications-header">
        <h2>All Notifications</h2>
        @if(auth()->user()->unreadNotifications()->count() > 0)
            <button class="mark-all-read-btn" onclick="markAllAsRead()">
                Mark all as read
            </button>
        @endif
    </div>

    @if($notifications->count() > 0)
        <div class="notifications-list">
            @foreach($notifications as $notification)
                <div class="notification-card {{ $notification->isUnread() ? 'unread' : '' }}" onclick="openNotification({{ $notification->id }})">
                    <div class="notification-icon {{ $notification->type === 'request_approved' ? 'approved' : ($notification->type === 'request_rejected' ? 'rejected' : 'default') }}">
                        @if($notification->type === 'request_approved')
                            <i class="bi bi-check-circle-fill"></i>
                        @elseif($notification->type === 'request_rejected')
                            <i class="bi bi-x-circle-fill"></i>
                        @else
                            <i class="bi bi-info-circle-fill"></i>
                        @endif
                    </div>
                    <div class="notification-content">
                        <p class="notification-title">{{ $notification->title }}</p>
                        <p class="notification-message">{{ $notification->message }}</p>
                        <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    @if($notification->isUnread())
                        <span class="notification-badge">New</span>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
            <div class="pagination">
                @if($notifications->onFirstPage())
                    <span>← Previous</span>
                @else
                    <a href="{{ $notifications->previousPageUrl() }}">← Previous</a>
                @endif

                @foreach($notifications->getUrlRange(1, $notifications->lastPage()) as $page => $url)
                    @if($page == $notifications->currentPage())
                        <span class="active"><span>{{ $page }}</span></span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if($notifications->hasMorePages())
                    <a href="{{ $notifications->nextPageUrl() }}">Next →</a>
                @else
                    <span>Next →</span>
                @endif
            </div>
        @endif
    @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <p class="empty-state-text">No notifications yet. We'll let you know when there's something important!</p>
        </div>
    @endif
</div>

<script>
    function markAllAsRead() {
        fetch('{{ route("customer.notifications.mark-all-read") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        }).then(() => {
            location.reload();
        }).catch(err => console.error('Error marking all as read:', err));
    }

    function openNotification(id) {
        fetch(`{{ url('customer/notifications') }}/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        }).then(res => res.json()).then(data => {
            if (data.redirect) {
                window.location.href = data.redirect;
            } else {
                location.reload();
            }
        }).catch(err => console.error('Error opening notification:', err));
    }
</script>

</body>
</html>
