<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{
    public $notifications, $count;
    /**
     * Create a new component instance.
     */
    public function __construct($count = 5)
    {
        $user = auth()->user();
        $this->notifications = $user->notifications()->latest()->take($count)->get();
        $this->count = $user->unreadNotifications->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications-menu');
    }
}
