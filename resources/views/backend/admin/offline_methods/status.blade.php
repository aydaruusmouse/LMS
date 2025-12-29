@if(hasPermission('offline-methods.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($offline_method->status == 1) ? 'checked' : '' }} data-id="{{ $offline_method->id }}"
               value="offline-method-status/{{$offline_method->id}}"
               id="customSwitch2-{{$offline_method->id}}">
        <label for="customSwitch2-{{ $offline_method->id }}"></label>
    </div>
@endif
