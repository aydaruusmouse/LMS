<a href="{{ route('instructors.show', $user->id) }}">
    <div class="user-info-panel d-flex gap-12 align-items-center">
        <div class="user-img user-status {{ $user->email_verified_at ? 'active' : '' }}">
            <img src="{{ getFileLink('40x40',  $user->images) }}" alt="{{ $user->first_name }}">
        </div>
        <div class="user-info">
            <h4>
                {{ $user->name }}
                @if($user->is_user_banned)
                    <small class="badge badge-danger">{{ __('banned') }}</small>
                @endif
            </h4>
            <span>{{ $user->email }}</span>
        </div>
    </div>
</a>
