<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ $count }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $count }} Notifications</span>
        <div class="dropdown-divider"></div>
        @if($count == 0)
            <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> No new notifications
                <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
        @endif
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notification)
            <a href="{{ route('notifications.show', $notification->id) }}" class="dropdown-item">
                <a href="{{ $notification->data['url']}}?notification_id={{ $notification->id }}" class="dropdown-item">
                 }}" class="dropdown-item">

                <i class="{{ $notification->data['icon'] }}"></i> {{ $notification->data['body'] }}
                 {{-- {{ $notification->data['message'] }} --}}
                <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
            </a>
            <div class="dropdown-divider"></div>
        @endforeach
        {{-- <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
    </div>
</li>
