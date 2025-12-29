<div class="setting-check">
    <input type="checkbox" class="instrutor-status-change"
           {{ ($class->status == 1) ? 'checked' : '' }} data-id="{{$class->id}}" value="live-class-status/{{$class->id}}"
           id="customSwitch2-{{$class->id}}">
    <label for="customSwitch2-{{ $class->id }}"></label>
</div>
