<div class="setting-check">
    <input type="checkbox" class="status-change"
           {{ ($tag->status == 1) ? 'checked' : '' }} data-id="{{ $tag->id }}" value="tag-status/{{$tag->id}}"
           id="customSwitch2-{{$tag->id}}">
    <label for="customSwitch2-{{ $tag->id }}"></label>
</div>
