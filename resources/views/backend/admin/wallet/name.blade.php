@if($user = $wallet->user)
    <a href="{{ route('students.show', $user->id) }}">
        <div
            class="user-info-panel d-flex gap-12 align-items-center">
            <div class="user-img user-status active">
                <img
                    src="{{ getFileLink('40x40',  $user->images) }}"
                    alt="{{ $user->name }}">
            </div>
            <div class="user-info">
                <h4>{{ $user->name }}</h4>
                <span>{{ $user->email }}</span>
            </div>
        </div>
    </a>
@endif
