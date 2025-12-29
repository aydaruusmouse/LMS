@if(hasPermission('states.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($state->status == 1) ? 'checked' : '' }} data-id="{{$state->id}}"
               value="states-status/{{$state->id}}"
               id="customSwitch2-{{$state->id}}">
        <label for="customSwitch2-{{ $state->id }}"></label>
    </div>
@endif
