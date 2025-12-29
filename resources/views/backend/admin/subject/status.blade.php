@if(hasPermission('subjects.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($subject->status == 1) ? 'checked' : '' }} data-id="{{ $subject->id }}" value="subject-status/{{$subject->id}}"
               id="customSwitch2-{{$subject->id}}">
        <label for="customSwitch2-{{ $subject->id }}"></label>
    </div>
@endif
