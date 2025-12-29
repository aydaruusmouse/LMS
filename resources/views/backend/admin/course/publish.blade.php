@if(hasPermission('course.publish'))
    <div class="setting-check">
        <input type="checkbox" class="pubished_status"
               {{ $course->is_published == 1 ? 'checked' : '' }} data-id="{{ $course->id }}"
               value="course-publish/{{ $course->id }}" id="customSwitch2-{{ $course->id }}">
        <label for="customSwitch2-{{ $course->id }}"></label>
    </div>
@endif
