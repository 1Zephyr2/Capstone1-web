<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notifications - FURCARE</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        :root {
            --navy-900: #1e293b;
            --navy-800: #334155;
            --teal-500: #14b8a6;
            --teal-600: #0d9488;
            --teal-100: #ccfbf1;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-500: #64748b;
            --slate-700: #334155;
            --slate-900: #0f172a;
            --success-500: #10b981;
            --danger-500: #ef4444;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100%;
            background:
                radial-gradient(1100px 420px at 10% -10%, rgba(20, 184, 166, 0.11), transparent 60%),
                radial-gradient(900px 340px at 100% 0%, rgba(30, 41, 59, 0.09), transparent 55%),
                var(--slate-50);
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--slate-900);
        }

        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--navy-900);
            color: var(--white);
            padding: 0 24px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            border-bottom: 3px solid rgba(20, 184, 166, 0.5);
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.18);
        }

        .navbar-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--white);
            margin: 0;
            letter-spacing: -0.2px;
        }

        .navbar-spacer {
            width: 92px;
        }

        .page-back-btn {
            background: var(--white);
            border: 1px solid #d1d5db;
            color: #111827;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.22s ease;
            font-size: 14px;
            line-height: 1;
            margin-bottom: 16px;
            text-decoration: none;
        }

        .page-back-btn:hover {
            background: #f0fdfa;
            border-color: var(--teal-500);
            color: var(--teal-500);
            transform: translateY(-1px);
        }

        .content-container {
            margin-top: 90px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            padding: 24px;
            flex: 1;
            width: 100%;
        }

        .notifications-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            padding: 16px 18px;
            border: 1px solid var(--slate-200);
            border-left: 5px solid var(--teal-500);
            border-radius: 12px;
            background: linear-gradient(135deg, var(--white) 0%, #f9fffe 100%);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.06);
        }

        .notifications-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--slate-900);
            margin: 0;
        }

        .mark-all-read-btn {
            background: linear-gradient(135deg, var(--teal-500) 0%, var(--teal-600) 100%);
            color: var(--white);
            border: none;
            padding: 9px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.22s ease;
            box-shadow: 0 8px 18px rgba(13, 148, 136, 0.24);
        }

        .mark-all-read-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 20px rgba(13, 148, 136, 0.3);
        }

        .notifications-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .notification-card {
            background: var(--white);
            border: 1px solid var(--slate-200);
            border-left: 5px solid var(--teal-500);
            border-radius: 12px;
            padding: 16px 18px;
            display: flex;
            gap: 12px;
            cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        }

        .notification-card:hover {
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12);
            transform: translateY(-2px);
            border-color: rgba(20, 184, 166, 0.36);
        }

        .notification-card.unread {
            background: linear-gradient(135deg, #f0fdfa 0%, #ecfdf5 100%);
            border-left-color: var(--success-500);
        }

        .notification-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .notification-icon.approved {
            background: rgba(16, 185, 129, 0.16);
            color: var(--success-500);
        }

        .notification-icon.rejected {
            background: rgba(239, 68, 68, 0.14);
            color: var(--danger-500);
        }

        .notification-icon.default {
            background: rgba(20, 184, 166, 0.16);
            color: var(--teal-600);
        }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title {
            font-weight: 700;
            font-size: 15px;
            color: var(--slate-900);
            margin: 0 0 6px 0;
        }

        .notification-message {
            font-size: 13px;
            color: var(--slate-500);
            margin: 0 0 8px 0;
            line-height: 1.5;
        }

        .notification-time {
            font-size: 12px;
            color: #94a3b8;
        }

        .notification-badge {
            background: var(--success-500);
            color: var(--white);
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            margin-left: auto;
            flex-shrink: 0;
            align-self: center;
            box-shadow: 0 6px 12px rgba(16, 185, 129, 0.28);
        }

        .empty-state {
            text-align: center;
            padding: 70px 20px;
            border: 1px dashed #cbd5e1;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--white) 0%, #f8fffd 100%);
        }

        .empty-state-icon {
            font-size: 48px;
            color: #94a3b8;
            margin-bottom: 16px;
        }

        .empty-state-text {
            color: var(--slate-500);
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
            border-radius: 8px;
            border: 1px solid var(--slate-200);
            color: var(--slate-700);
            text-decoration: none;
            transition: all 0.2s ease;
            background: var(--white);
            font-size: 13px;
        }

        .pagination a:hover {
            background: var(--teal-100);
            color: var(--teal-600);
            border-color: rgba(20, 184, 166, 0.45);
        }

        .pagination .active span {
            background: var(--teal-500);
            color: var(--white);
            border-color: var(--teal-500);
            box-shadow: 0 8px 15px rgba(20, 184, 166, 0.24);
        }

        @media (max-width: 768px) {
            .navbar-fixed {
                height: 64px;
                padding: 0 14px;
            }

            .navbar-title {
                font-size: 18px;
            }

            .page-back-btn {
                padding: 8px 12px;
                font-size: 13px;
                margin-bottom: 12px;
            }

            .content-container {
                padding: 16px;
                margin-top: 80px;
            }

            .notifications-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                padding: 14px;
            }

            .mark-all-read-btn {
                width: 100%;
            }

            .notification-card {
                padding: 14px;
                gap: 10px;
            }

            .notification-icon {
                width: 42px;
                height: 42px;
                font-size: 19px;
            }
        }
    </style>
</head>
<body>

<div class="navbar-fixed">
    <div class="navbar-spacer"></div>
    <h1 class="navbar-title">Notifications</h1>
    <div class="navbar-spacer"></div>
</div>

<div class="content-container">
    <button class="page-back-btn" onclick="goBack()">
        <i class="bi bi-chevron-left"></i> Back
    </button>

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
    function goBack() {
        if (document.referrer && document.referrer !== window.location.href) {
            window.history.back();
            return;
        }
        window.location.href = '{{ route("customer.dashboard") }}';
    }

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
