
@if(isset($type) && $type == 'a')
    <a class="{{ $class }} loading_button d-none" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="visually-hidden">Loading...</span>
    </a>
@else
    <button class="{{ $class }} loading_button d-none" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="visually-hidden">Loading...</span>
    </button>
@endif

