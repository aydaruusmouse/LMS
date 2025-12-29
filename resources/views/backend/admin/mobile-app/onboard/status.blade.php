<div class="setting-check">
    <input type="checkbox" class="status-change"
           {{ ($onboard->status == 1) ? 'checked' : '' }} data-id="{{ $onboard->id }}" value="onboards-status/{{$onboard->id}}"
           id="customSwitch2-{{$onboard->id}}">
    <label for="customSwitch2-{{ $onboard->id }}"></label>
</div>
