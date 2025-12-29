@if(hasPermission('success-stories.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($success_story->status == 1) ? 'checked' : '' }} data-id="{{ $success_story->id }}"
               value="success-status/{{$success_story->id}}"
               id="customSwitch2-{{$success_story->id}}">
        <label for="customSwitch2-{{ $success_story->id }}"></label>
    </div>
@endif
