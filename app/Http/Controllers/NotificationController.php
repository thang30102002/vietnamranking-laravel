<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications->find($id);
        $notification->markAsRead();
        return response()->json(['message' => 'Tất cả thông báo đã được đánh dấu là đã đọc.']);
    }
}
