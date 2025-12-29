<ul class="enroll_courses">
    @foreach($checkout->enrolls as $key=> $enroll)
        <li>{{ $key+1 }}. <a href="javascript:void(0)">{{$enroll->enrollable->title}}</a></li>
    @endforeach
</ul>
@if(count($checkout->enrolls) > 3)
    <div class="text-end">
        <button type="button" class="btn btn-sm sg-btn-primary view_all">{{ __('view_all') }}</button>
        <button type="button" class="btn btn-sm sg-btn-primary hide d-none">{{ __('hide') }}</button>
    </div>
@endif
