<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('is_read', false)->get();
        return view('pages.notification.index', compact('notifications'));
    }
}