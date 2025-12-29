@if(hasPermission('category.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($category->status == 1) ? 'checked' : '' }} data-id="{{ $category->id }}"
               value="category-status/{{$category->id}}"
               id="customSwitch2-{{$category->id}}">
        <label for="customSwitch2-{{ $category->id }}"></label>
    </div>
@endif
