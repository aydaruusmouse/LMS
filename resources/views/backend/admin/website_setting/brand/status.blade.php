@if(hasPermission('brands.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($brand->status == 1) ? 'checked' : '' }} data-id="{{ $brand->id }}"
               value="brand-status/{{$brand->id}}"
               id="customSwitch2-{{$brand->id}}">
        <label for="customSwitch2-{{ $brand->id }}"></label>
    </div>
@endif
