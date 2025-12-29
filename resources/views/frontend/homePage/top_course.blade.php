<section class="top-courses-section p-t-80 p-b-50 p-t-sm-40 p-b-sm-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="common-heading text-center m-b-40 m-b-sm-25">
                    <h3>{{__($section->contents['title']) }}</h3>
                    <p>{{__($section->contents['sub_title']) }}</p>
                </div>
            </div>
        </div>
        <!-- Start Top Course Tabs -->
        <div class="main-tabs">
            <ul class="nav nav-pills max-content" id="education-level-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-courses-tab" data-bs-toggle="tab"
                            data-bs-target="#all-courses" type="button" role="tab" aria-controls="all-courses"
                            aria-selected="true">{{__('all_courses')}}
                    </button>
                </li>
                @foreach($top_course_categories as  $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="{{ $category->slug }}-{{ $category->id }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $category->slug }}-{{ $category->id }}" type="button" role="tab"
                                aria-controls="{{ $category->slug }}-{{ $category->id }}"
                                aria-selected="false">{{ $category->title }}</button>
                    </li>
                @endforeach
            </ul>
            <div class="education-level-tab-content tab-content" id="education-level-tabContent">
                <div class="tab-pane fade show active" id="all-courses" role="tabpanel"
                     aria-labelledby="all-courses-tab">
                    <div class="row course-items-v3">
                        @foreach($top_course_categories as  $category)
                            @if(count($category->activeCourses )>0)
                            @foreach($category->activeCourses as $key => $course)
                                @include('frontend.course.component',['col' => 'col-lg-4'])
                            @endforeach
                            @else
                                @include('frontend.not_found',$data=['title'=> 'course'])
                            @endif
                        @endforeach
                    </div>
                </div>
                @foreach($top_course_categories as  $category)
                    <div class="tab-pane fade" id="{{ $category->slug }}-{{ $category->id }}" role="tabpanel"
                         aria-labelledby="all-courses-tab">
                        <div class="row course-items-v3">
                            @if(count($category->activeCourses )>0)
                            @foreach($category->activeCourses as $key => $course)
                                @include('frontend.course.component',['col' => 'col-lg-4'])
                            @endforeach
                            @else
                                @include('frontend.not_found',$data=['title'=> 'course'])
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- End Top Course Tabs -->
    </div>
</section>


