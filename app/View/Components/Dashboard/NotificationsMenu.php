<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $notifications, public $count)
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
