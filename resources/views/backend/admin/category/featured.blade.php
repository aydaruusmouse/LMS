<div class="setting-check">
    <input type="checkbox" class="status-change"
           {{ ($category->is_featured == 1) ? 'checked' : '' }} data-id="{{ $category->id }}" value="category-feature/{{$category->id}}"
           id="customSwitch3-{{$category->id}}">
    <label for="customSwitch3-{{ $category->id }}"></label>
</div>
