<?php
namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Notification;

class NotificationComposer
{
    public function compose(View $view)
    {
        $notifications = Notification::where('is_read', false)->get();
        $view->with('notifications', $notifications);
    }
}