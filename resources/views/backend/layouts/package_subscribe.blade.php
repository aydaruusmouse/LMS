<ul class="dropdown-menu popup-card">
    <li><span>{{__('notifications')}}</span></li>
    @foreach($notifications as $notification)
    <li>
        <a class="dropdown-item" href="#">
            <div class="notification-content">
                <div class="notification-img inst-avtar">
                    <img src="{{ getFileLink('40x40',@$notification->user->images) }}" alt="">
                </div>

                <div class="notification-text">
                    <h6>{{ @$notification->user->first_name }}</h6>
                    <p>{{__('A Course has been purchased') .  @$notification->user->name  }}</p>
                </div>

                <span class="notification-time">{{ date('H A', strtotime($notification->created_at))  }}</span>
            </div>
        </a>
    </li>
    @endforeach
    <li><a class="dropdown-item text-center" href="">Read All</a></li>
</ul>
