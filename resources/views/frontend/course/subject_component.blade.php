<div class="widget widget-checklist">
    <ul class="widget-list-group subject_section_wrap">
        @foreach($subjects as $subject)
        <li>
            <label>
                <input type="checkbox" class="subject_checkbox" name="subject_checkbox" value="{{$subject->id}}">
                <span>{{$subject->title}}</span>
            </label>
        </li>
        @endforeach
        @if($subjects->nextPageUrl())
            <li class="subject-more" data-page="{{ $subjects->currentPage() }}"  data-url="{{ route('load.subject') }}">
                <a href="javascript:void(0)">{{__('show_more')}}</a>
                @include('components.frontend_loading_btn', ['class' => 'btn'])
            </li>
        @endif
    </ul>
</div>
