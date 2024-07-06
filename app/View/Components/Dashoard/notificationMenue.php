<?php

namespace App\View\Components\Dashoard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class notificationMenue extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct(public $notifications, public $count)
    {
        $this->notifications = Auth::user()->unreadNotifications;
        $this->count = Auth::user()->unreadNotifications->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashoard.notification-menue');
    }
}
