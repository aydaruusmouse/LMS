
@foreach($categories as $category)
<li>
    <a class="has-dropdown" href="#">{{ $category->getTranslation('title') }} <span>({{ $category->activeCourses->count() }})</span></a>
    <ul>
        @foreach($category->subCategories as $sub_category)
        <li>
            <label>
                <input type="checkbox" value="{{ $sub_category->id }}" name="category_filter[]">
                <span>{{ $sub_category->getTranslation('title') }}</span>
            </label>
            <span>({{ $sub_category->activeCourses->count() }})</span>
        </li>
        @endforeach
    </ul>
</li>
@endforeach

