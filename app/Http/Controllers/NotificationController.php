<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $allNotifications = Auth::user()->notifications;

        return view('notifications.index', compact('allNotifications'));
    }

    public function markRead($notificationId)
    {
        Auth::user()->unreadNotifications->find($notificationId)->markAsRead();

        return redirect()->back();
    }
}
