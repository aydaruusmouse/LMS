<button class="{{ $class }} loading_button d-none" type="button" disabled {{ isset($id) ? "id=$id" : '' }}>
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    {{ __('loading') }}...
</button>
