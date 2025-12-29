@if(hasPermission('languages.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change" data-id="{{ $language->id }}"
               {{ ($language->status == 1) ? 'checked' : '' }} value="language-status/{{$language->id}}"
               id="customSwitch2-{{$language->id}}">
        <label for="customSwitch2-{{ $language->id }}"></label>
    </div>
@endif
