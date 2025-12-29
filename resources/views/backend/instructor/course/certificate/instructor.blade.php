@php
    $instructors= App\Models\User::whereIn('id', $course->instructor_ids)->get();
@endphp
<div class="text-start">
    @foreach($instructors as $instructor)
        <p>{{ $instructor->first_name }} {{ $instructor->last_name }}</p>
    @endforeach

</div>
