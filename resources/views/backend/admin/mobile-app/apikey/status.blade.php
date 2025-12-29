<div class="setting-check">
    <input type="checkbox" class="status-change"
           {{ ($apiKey->status == 1) ? 'checked' : '' }} value="onboards-status/{{$apiKey->id}}"
           id="customSwitch2-{{$apiKey->id}}">
    <label for="customSwitch2-{{ $apiKey->id }}"></label>
</div>
