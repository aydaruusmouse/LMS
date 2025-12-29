@if(hasPermission('currencies.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($country->status == 1) ? 'checked' : '' }} data-id="{{$country->id}}"
               value="countries-status/{{$country->id}}"
               id="customSwitch2-{{$country->id}}">
        <label for="customSwitch2-{{ $country->id }}"></label>
    </div>
@endif
