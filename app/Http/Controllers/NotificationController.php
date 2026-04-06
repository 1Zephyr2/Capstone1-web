<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get user's notifications for full page view
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('customer.notifications.index', compact('notifications'));
    }

    /**
     * Get notifications via API (for AJAX)
     */
    public function getNotifications(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'data' => $notification->data,
                    'is_unread' => $notification->isUnread(),
                    'created_at' => $notification->created_at->toIso8601String(),
                    'time_ago' => $notification->created_at->diffForHumans(),
                ];
            });

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Mark a single notification as read
     */
    public function markAsRead(Notification $notification)
    {
        // Check authorization
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->markAsRead();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $redirect = null;
        if ($notification->appointment_request_id) {
            // Staff can open request details; customers should be sent to a customer-safe page.
            $redirect = $user->hasStaffAccess()
                ? route('appointment-requests.show', $notification->appointment_request_id)
                : route('customer.appointments.index');
        }

        return response()->json([
            'success' => true,
            'redirect' => $redirect,
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->unreadNotifications()->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read',
        ]);
    }
}
