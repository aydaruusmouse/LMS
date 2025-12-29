<div class="text-start">
    @foreach ($checkout->enrolls as $enroll)
        @php
            $instructors = App\Models\User::whereIn('id', $enroll->enrollable->instructor_ids ?? [])->get();
        @endphp

        @foreach ($instructors as $instructor)
            <p>{{ $instructor->first_name }} {{ $instructor->last_name }}</p>
        @endforeach
    @endforeach
</div>
