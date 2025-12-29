<div class="text-start">
    @foreach($instructors as $key=> $instructor)
        <p>{{ ++$key }}. {{ $instructor->name }}</p>
    @endforeach
</div>
