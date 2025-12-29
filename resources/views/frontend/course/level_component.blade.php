@foreach($levels as $level)
    <li>
        <label>
            <input type="checkbox" value="">
            <span>{{ $level->lang_title }}</span>
        </label>
    </li>
@endforeach
@if($levels->nextPageUrl())
    <li class="show-more" data-page="{{ $levels->currentPage() }}"  data-url="{{ route('load.levels') }}">
        <a href="#">Show more</a>
        @include('components.frontend_loading_btn', ['class' => 'btn'])
    </li>
@endif
