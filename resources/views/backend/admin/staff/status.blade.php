@if(hasPermission('staffs.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($staff->status == 1) ? 'checked' : '' }} data-id="{{$staff->id}}" value="staffs-status/{{$staff->id}}"
               id="customSwitch2-{{$staff->id}}">
        <label for="customSwitch2-{{ $staff->id }}"></label>
    </div>
@endif
