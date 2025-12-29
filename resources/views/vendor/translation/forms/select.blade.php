<div class="select-group">
    <select name="{{ $name }}" @if(isset($submit) && $submit) @endif class="without_search">
        @if(isset($optional) && $optional)<option value> ----- </option>@endif
        @foreach($items as $key => $value)
            @if(is_numeric($key))
                <option value="{{ $value }}" @if(isset($selected) && $selected === $value) selected="selected" @endif>{{ ucwords($value) }}</option>
            @else
                <option value="{{ $key }}" @if(isset($selected) && $selected === $key) selected="selected" @endif>{{ ucwords($value) }}</option>
            @endif
        @endforeach
    </select>
</div>
