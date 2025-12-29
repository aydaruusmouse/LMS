@if(hasPermission('testimonials.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($testimonial->status == 1) ? 'checked' : '' }} data-id="{{ $testimonial->id }}"
               value="testimonial-status/{{$testimonial->id}}"
               id="customSwitch2-{{$testimonial->id}}">
        <label for="customSwitch2-{{ $testimonial->id }}"></label>
    </div>
@endif
