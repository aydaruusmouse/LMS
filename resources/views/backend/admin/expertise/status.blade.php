<div class="setting-check">
    <input type="checkbox" class="status-change"
           {{ ($expertise->status == 1) ? 'checked' : '' }} data-id="{{ $expertise->id }}" value="expertise-status/{{$expertise->id}}"
           id="customSwitch2-{{$expertise->id}}">
    <label for="customSwitch2-{{ $expertise->id }}"></label>
</div>
