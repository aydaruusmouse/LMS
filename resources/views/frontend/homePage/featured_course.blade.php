<section class="featured-course-section p-b-50 d-none d-sm-block">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading text-center m-b-40">
                    <h3>{{__($section->contents['title']) }}</h3>
                    <p>{{__($section->contents['sub_title']) }}</p>
                </div>
            </div>
        </div>
        @php(
    $featured_courses = 'featured_courses_'.$key
)
@if (isset($$featured_courses))
    <div class="row course-items-v3">
            @foreach($$featured_courses as $course)
                @include('frontend.course.component',['col' => 'col-lg-4'])
            @endforeach
    </div>
@else
    @include('frontend.not_found',$data=['title'=> 'course'])
@endif

    </div>
</section>
