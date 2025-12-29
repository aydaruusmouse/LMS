@if(hasPermission('organizations.settings'))
    <div class="setting-check">
        <input type="checkbox" class="status-change" data-id="{{ $organization->id }}"
               {{ ($organization->status == 1) ? 'checked' : '' }} value="organizations-status/{{$organization->id}}"
               id="customSwitch2-{{$organization->id}}">
        <label for="customSwitch2-{{ $organization->id }}"></label>
    </div>
@endif
