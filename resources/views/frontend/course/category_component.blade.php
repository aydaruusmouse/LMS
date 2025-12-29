@foreach($filter_categories as $category)
    <li>
        <a href="#">{{ $category->lang_title }}
            @if($category->active_courses_count > 0)
                <span>({{ $category->active_courses_count }})</span>
            @endif
        </a>
        @if(count($category->subCategories) > 0)
            <ul class="sub-menu">
                @foreach($category->subCategories as $subCategory)
                    <li>
                        <label>
                            <input type="checkbox" value="">
                            <span>{{ $subCategory->lang_title }}</span>
                        </label>
                        @if($subCategory->active_courses_count > 0)
                            <span>({{ $subCategory->active_courses_count }})</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
@if($filter_categories->nextPageUrl())
    <li class="show-more" data-page="{{ $filter_categories->currentPage() }}" data-url="{{ route('load.category') }}">
        <a href="#">Show more</a>
        @include('components.frontend_loading_btn', ['class' => 'btn'])
    </li>
@endif
