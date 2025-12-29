<a href="{{ route('students.show', $user->id) }}">
    <div class="user-info-panel d-flex gap-12 align-items-center">
        <div class="user-img user-status active">
            <img src="{{ getFileLink('40x40',  $user->images) }}" alt="{{ $user->first_name }}">
        </div>
        <div class="user-info">
            <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
            <span>{{ $user->email }}</span>
        </div>
    </div>
</a>
