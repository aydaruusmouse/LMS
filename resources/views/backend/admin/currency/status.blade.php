<div class="setting-check">
    <input type="checkbox" class="status-change"
           {{ ($currency->status == 1) ? 'checked' : '' }} data-id="{{$currency->id}}" value="currencies-status/{{$currency->id}}"
           id="customSwitch2-{{$currency->id}}">
    <label for="customSwitch2-{{ $currency->id }}"></label>
</div>
