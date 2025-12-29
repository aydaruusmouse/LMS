@if(hasPermission('languages.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change" {{ ($language->text_direction == 'rtl') ? 'checked' : '' }}
        data-id="{{ $language->id }}" value="language-direction-change/{{$language->id}}"
               id="customSwitch1-{{$language->id}}">
        <label for="customSwitch1-{{ $language->id }}"></label>
    </div>
@endif
