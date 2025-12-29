@if(hasPermission('students.edit'))
    <div class="setting-check">
        <input type="checkbox" class="instructor-status-change"   {{ ($user->status == 1) ? 'checked' : '' }} data-id="{{$user->id}}" value="user-status/{{$user->id}}" id="customSwitch2-{{$user->id}}" >
        <label for="customSwitch2-{{ $user->id }}"></label>
    </div>
@endif
