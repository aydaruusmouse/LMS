<div class="setting-check">
    <input type="checkbox" class="status-change"
           {{ ($level->status == 1) ? 'checked' : '' }} data-id="{{ $level->id }}" value="level-status/{{$level->id}}"
           id="customSwitch2-{{$level->id}}">
    <label for="customSwitch2-{{ $level->id }}"></label>
</div>
