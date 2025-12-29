@if(hasPermission('cities.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($city->status == 1) ? 'checked' : '' }} data-id="{{ $city->id }}"
               value="cities-status/{{ $city->id }}"
               id="customSwitch2-{{ $city->id }}">
        <label for="customSwitch2-{{ $city->id }}"></label>
    </div>
@endif
