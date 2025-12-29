<div class="setting-check">
    <input type="checkbox" class="status-change"
           {{ ($notification->status == 1) ? 'checked' : '' }} data-id="{{ $notification->id }}" value="notification-status/{{$notification->id}}"
           id="customSwitch2-{{$notification->id}}">
    <label for="customSwitch2-{{ $notification->id }}"></label>
</div>
