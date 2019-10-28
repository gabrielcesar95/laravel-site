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
}
