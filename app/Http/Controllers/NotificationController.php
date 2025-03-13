<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        //local için mantıklı değil cron job
        //ama canlıya alındığında her gün çalışan bir cron oluşturup bunu otomatik yapan sistem kurulabilir
        //Bu sayede örneğin gece 00:01 de çalışır ve bildirimler gönderilir

        $allNotifications = Auth::user()->notifications;

        return view('notifications.index', compact('allNotifications'));
    }

    public function markRead($notificationId)
    {
        Auth::user()->unreadNotifications->find($notificationId)->markAsRead();

        return redirect()->back();
    }
}
