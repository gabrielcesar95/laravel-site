<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function list()
    {
        $notifications = auth()->user()->unreadNotifications;

        return $notifications;
    }

    public function read(Request $request, $id)
    {
        $notification = auth()->user()->unreadNotifications->where('id', $id)->first();

        return [
            'success' => $notification->delete()
        ];
    }
}
