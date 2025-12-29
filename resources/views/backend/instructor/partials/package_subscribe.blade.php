<ul class="dropdown-menu popup-card">
    <li><span>{{__('notifications')}}</span></li>
    @foreach($subscribes as $subscribe)
    <li>
        <a class="dropdown-item" href="#">
            <div class="notification-content">
                <div class="notification-img">
                    <img src="{{ getFileLink('40x40',$subscribe->user->images) }}" alt="">
                </div>

                <div class="notification-text">
                    <h6>{{ $subscribe->user->first_nam }}</h6>
                    <p>{{__('Your customer subscribed for the'). $subscribe->subscribe->name  }}</p>
                </div>

                <span class="notification-time">{{ date('H A', strtotime($subscribe->created_at))  }}</span>
            </div>
        </a>
    </li>
    @endforeach
    <li><a class="dropdown-item text-center" href="{{ route('packages.subscribe-list') }}">Read All</a></li>
</ul>
