<tbody>
@foreach($permissions as $permission)
    <tr>
        <td><span class="text-capitalize"> {{ $permission->name }} </span></td>
        <td>
            @foreach($permission->keywords as $key=>$keyword)
                <div class="custom-checkbox mb-2">
                    <label>
                        @if(!empty($role_permissions))
                            <input name="permissions[]" type="checkbox"
                                   value="{{ $keyword }}" {{ in_array($keyword, $role_permissions)? 'checked':''}}>
                        @else
                            <input name="permissions[]" type="checkbox" value="{{ $keyword }}">
                        @endif
                        <span class="text-capitalize">{{ $key }}</span>
                    </label>
                </div>
            @endforeach
        </td>
    </tr>
@endforeach
</tbody>
