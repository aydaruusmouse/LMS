@extends('frontend.layouts.master')
@section('title', $course->title)
@section('content')
    <section class="course-details-area p-b-50">
        <div class="course-details-header-wrapper p-t-60 p-b-95 p-t-md-40 p-b-md-50">
            <div class="container container-1278">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="course-details-header color-white">
                            <h2 class="title">{{ $course->title }}</h2>
                            <p class="desc">{{ $course->short_description }}</p>
                            <ul class="course-details-info">
                                <li class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>{{ round($course->total_rating,2) }}</span>
                                    ({{ count($reviews) }} {{__('rating')}})
                                </li>
                                <li><i class="fal fa-user-friends"></i>{{ $course->enrolls_count }}</li>
                                <li><i class="fal fa-sync"></i> {{__('last_updated')}}
                                    {{ \Carbon\Carbon::parse($course->updated_at)->format('M d, Y') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="course-details-overview-wrapper">
            <div class="container container-1278">
                <div class="row">
                    <div class="col-lg-8 p-b-md-40 order-2 order-lg-1">
                        <div class="course-details-overview p-t-50 p-t-lg-5">
                            <div class="course-details-overview-content">
                                @if($course->description)
                                    <h4>{{__('about_this_course')}}</h4>
                                    <div
                                        class="border-soft-white px-4 py-4 rounded-3">{!! $course->description !!}</div>
                                @endif
                                @if(setting('hide_instructor_from_course_details') !='1')
                                    @if(count($instructors) > 0)
                                        <h4 class="p-t-lg-15">{{__('course_instructor')}}</h4>
                                        <div class="row gx-3 gx-lg-4 team-member-items-v3">
                                            @foreach($instructors as $user)
                                                <div class="col-sm-6">
                                                    <div class="team-member-item">
                                                        <a href="{{ route('instructor.details', $user->instructor->slug) }}"
                                                           class="member-img">
                                                            <img src="{{ getFileLink('80x80',$user->images) }}"
                                                                 alt="Team member">
                                                        </a>
                                                        <div class="member-content">
                                                            <h5 class="title">
                                                                <a href="{{ route('instructor.details', $user->instructor->slug) }}">{{ $user->name }}</a>
                                                                <span>{{ $user->tagline }}</span>
                                                            </h5>
                                                            <p>{{ $user->instructor->designation }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                                @if(setting('hide_curriculum_from_course_details') !='1')
                                    <div class="curriculum-tab m-t-30 m-t-lg-15 m-b-55 m-b-lg-35">
                                        @if($hasEnrolled)
                                            <h3 class="title">{{__('course_syllabus')}}</h3>
                                            <div class="col-md-9">
                                                <div class="line-progress">
                                                    <p class="d-flex align-items-center justify-content-end mb-2"><span>{{$hasEnrolled->complete_count}}% {{__('done')}}</span>
                                                    </p>
                                                    <div data-progress="{{$hasEnrolled->complete_count}}"></div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="accordion accordion-flush" id="curriculumAccordion">
                                            @if(count($sections) > 0)
                                                @foreach($sections as $key=> $section)
                                                    <div class="accordion-item">
                                                        <div class="accordion-header"
                                                             id="course-curriculum-heading{{$key}}">
                                                            <div class="accordion-button" role="button"
                                                                 data-bs-toggle="collapse"
                                                                 data-bs-target="#course-curriculum-collapse{{$key}}"
                                                                 {{ $key == 0 && (count($lessons->where('section_id',$section->id)) > 0 || count($section->quizzes) > 0) ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                                                                 aria-controls="course-curriculum-collapse{{$key}}">
                                                                {{ $section->title }}
                                                            </div>
                                                        </div>
                                                        <div id="course-curriculum-collapse{{$key}}"
                                                             class="accordion-collapse collapse {{ $key == 0 && (count($lessons->where('section_id',$section->id)) > 0 || count($section->quizzes) > 0) ? 'show' : '' }}"
                                                             aria-labelledby="course-curriculum-heading{{$key}}"
                                                             data-bs-parent="#curriculumAccordion">
                                                            <div class="accordion-body">
                                                                @if(count($lessons) > 0)
                                                                    <div class="course-playlist">
                                                                        <ul>
                                                                            @foreach($lessons->where('section_id',$section->id) as $k => $lesson)
                                                                                <li>
                                                                                    <a href="#"
                                                                                       class="{{ $lesson->is_free == 1 ? 'player-src' : '' }}"
                                                                                       @if($lesson->is_free == 1)
                                                                                           data-poster="{{ $lesson->image ? getFileLink('402x238', $lesson->image) : ($course->image ? getFileLink('402x248', $course->image) : '') }}"
                                                                                       data-type="{{ $lesson->lesson_type }}"
                                                                                       data-source="{{ $lesson->source }}"
                                                                                       data-video="{{ getVideoId($lesson->source, $lesson->source_data) }}"
                                                                                        @endif
                                                                                    >
                                                                                        <div class="title">
                                                                                            <div
                                                                                                class="checkbox-default">
                                                                                                @if($lesson->is_free == 1)
                                                                                                    <svg width="20px"
                                                                                                         height="20px"
                                                                                                         viewBox="0 0 24 24"
                                                                                                         fill="none"
                                                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                                                        <g id="SVGRepo_bgCarrier"
                                                                                                           stroke-width="0"/>
                                                                                                        <g id="SVGRepo_tracerCarrier"
                                                                                                           stroke-linecap="round"
                                                                                                           stroke-linejoin="round"/>
                                                                                                        <g id="SVGRepo_iconCarrier">
                                                                                                            <path
                                                                                                                d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                                                                                                                stroke="var(--color-secondary-4)"
                                                                                                                stroke-width="1.5"/>
                                                                                                            <circle
                                                                                                                cx="12"
                                                                                                                cy="16"
                                                                                                                r="2"
                                                                                                                stroke="var(--color-secondary-4)"
                                                                                                                stroke-width="1.5"/>
                                                                                                            <path
                                                                                                                d="M6 10V8C6 4.68629 8.68629 2 12 2C14.7958 2 17.1449 3.91216 17.811 6.5"
                                                                                                                stroke="var(--color-secondary-4)"
                                                                                                                stroke-width="1.5"
                                                                                                                stroke-linecap="round"/>
                                                                                                        </g>
                                                                                                    </svg>
                                                                                                @else
                                                                                                    <svg width="20px"
                                                                                                         height="20px"
                                                                                                         viewBox="0 0 24 24"
                                                                                                         fill="none"
                                                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                                                        <path
                                                                                                            d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                                                                                                            stroke="var(--color-secondary-4)"
                                                                                                            stroke-width="1.5"/>
                                                                                                        <circle cx="12"
                                                                                                                cy="16"
                                                                                                                r="2"
                                                                                                                stroke="var(--color-secondary-4)"
                                                                                                                stroke-width="1.5"/>
                                                                                                        <path
                                                                                                            d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10"
                                                                                                            stroke="var(--color-secondary-4)"
                                                                                                            stroke-width="1.5"
                                                                                                            stroke-linecap="round"/>
                                                                                                    </svg>
                                                                                                @endif
                                                                                            </div>
                                                                                            @if($lesson->lesson_type == 'video')
                                                                                                <svg width="12"
                                                                                                     height="12"
                                                                                                     viewBox="0 0 9 10"
                                                                                                     fill="none"
                                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                                    <path
                                                                                                        d="M7.44337 5.50769L2.06976 8.89219C1.67021 9.14384 1.15 8.85669 1.15 8.3845L1.15 1.6155C1.15 1.14331 1.67021 0.856158 2.06976 1.10781L7.44337 4.49231C7.81702 4.72765 7.81702 5.27235 7.44337 5.50769Z"
                                                                                                        stroke="var(--color-secondary-4)"
                                                                                                        stroke-width="0.8"/>
                                                                                                </svg>
                                                                                            @elseif($lesson->lesson_type == 'audio')
                                                                                                <svg width="10"
                                                                                                     height="14"
                                                                                                     viewBox="0 0 10 14"
                                                                                                     fill="none"
                                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                                    <path
                                                                                                        d="M5.00065 9.66827C6.62565 9.66827 7.91732 8.37349 7.91732 6.74457V3.40319C7.91732 1.77427 6.62565 0.479492 5.00065 0.479492C3.37565 0.479492 2.08398 1.77427 2.08398 3.40319V6.74457C2.08398 8.37349 3.37565 9.66827 5.00065 9.66827ZM2.91732 3.40319C2.91732 2.23371 3.83398 1.31484 5.00065 1.31484C6.16732 1.31484 7.08398 2.23371 7.08398 3.40319V6.74457C7.08398 7.91405 6.16732 8.83293 5.00065 8.83293C3.83398 8.83293 2.91732 7.91405 2.91732 6.74457V3.40319Z"
                                                                                                        fill="#FDCC0D"/>
                                                                                                    <path
                                                                                                        d="M10 6.74414H9.16667C9.16667 9.04133 7.29167 10.9209 5 10.9209C2.70833 10.9209 0.833333 9.04133 0.833333 6.74414H0C0 9.37547 2 11.5056 4.58333 11.7144V13.0092H3.33333C3.08333 13.0092 2.91667 13.1763 2.91667 13.4269C2.91667 13.6775 3.08333 13.8446 3.33333 13.8446H6.66667C6.91667 13.8446 7.08333 13.6775 7.08333 13.4269C7.08333 13.1763 6.91667 13.0092 6.66667 13.0092H5.41667V11.7144C8 11.5056 10 9.37547 10 6.74414Z"
                                                                                                        fill="#FDCC0D"/>
                                                                                                </svg>
                                                                                            @else
                                                                                                <svg width="11"
                                                                                                     height="13"
                                                                                                     viewBox="0 0 11 13"
                                                                                                     fill="none"
                                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                                    <path
                                                                                                        fill-rule="evenodd"
                                                                                                        clip-rule="evenodd"
                                                                                                        d="M7.81718 0.579102C9.72106 0.579102 11 1.88602 11 3.83091V9.41308C11 11.375 9.76042 12.6509 7.842 12.6631L3.18343 12.6649C1.27955 12.6649 0 11.358 0 9.41308V3.83091C0 1.86841 1.23958 0.593063 3.158 0.58153L7.81657 0.579102H7.81718ZM7.81718 1.48963L3.16102 1.49206C1.75128 1.50056 0.90834 2.37467 0.90834 3.83091V9.41308C0.90834 10.879 1.75915 11.7544 3.18282 11.7544L7.83898 11.7525C9.24872 11.744 10.0917 10.8687 10.0917 9.41308V3.83091C10.0917 2.36496 9.24145 1.48963 7.81718 1.48963ZM7.70036 8.75792C7.95107 8.75792 8.15453 8.96188 8.15453 9.21318C8.15453 9.46449 7.95107 9.66845 7.70036 9.66845H3.32822C3.07752 9.66845 2.87405 9.46449 2.87405 9.21318C2.87405 8.96188 3.07752 8.75792 3.32822 8.75792H7.70036ZM7.70036 6.21663C7.95107 6.21663 8.15453 6.42058 8.15453 6.67189C8.15453 6.9232 7.95107 7.12716 7.70036 7.12716H3.32822C3.07752 7.12716 2.87405 6.9232 2.87405 6.67189C2.87405 6.42058 3.07752 6.21663 3.32822 6.21663H7.70036ZM4.99636 3.68122C5.24706 3.68122 5.45053 3.88518 5.45053 4.13649C5.45053 4.38779 5.24706 4.59175 4.99636 4.59175H3.32804C3.07734 4.59175 2.87387 4.38779 2.87387 4.13649C2.87387 3.88518 3.07734 3.68122 3.32804 3.68122H4.99636Z"
                                                                                                        fill="var(--color-secondary-4)"/>
                                                                                                </svg>
                                                                                            @endif
                                                                                            <h6>{{ $lesson->title }}
                                                                                                @if($lesson->is_free == 1)
                                                                                                    <span class="badge">{{ __('free') }}</span>
                                                                                                @endif
                                                                                            </h6>
                                                                                        </div>
                                                                                        <span
                                                                                            class="course-length">{{ $lesson->duration }}</span>
                                                                                    </a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if(setting('hide_faq_from_course_details') !='1')
                                    @if(count($faqs) > 0)
                                        <div class="faq-tab m-b-55 m-b-lg-35">
                                            <h3 class="title">{{__('frequently_asked_questions')}}</h3>
                                            <div class="accordion accordion-flush" id="faqAccordion">
                                                @foreach($faqs as $key=> $faq)
                                                    <div class="accordion-item">
                                                        <div class="accordion-header"
                                                             id="course-faq-headingOne{{$key}}">
                                                            <div
                                                                class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}"
                                                                role="button" data-bs-toggle="collapse"
                                                                data-bs-target="#course-faq-collapse{{$key}}"
                                                                aria-expanded="true"
                                                                aria-controls="course-faq-collapse{{$key}}">
                                                                {{ $faq->question }}
                                                            </div>
                                                        </div>
                                                        <div id="course-faq-collapse{{$key}}"
                                                             class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                                             aria-labelledby="course-faq-heading{{$key}}"
                                                             data-bs-parent="#faqAccordion">
                                                            <div class="accordion-body">
                                                                {!! $faq->answer !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            @if(setting('hide_review_from_course_details') !='1' && $course->total_rating > 0)
                                <div class="rating-summary-wrapper m-b-55 m-b-md-25">
                                    <h4 class="border-bottom-soft-white p-b-10 m-b-25 fw-semibold fz-18">{{__('reviews')}}</h4>
                                    <div class="rating-summary">
                                        <div class="rating-summary-content">
                                            <div class="total-rating">
                                                <h4>{{ round($course->total_rating,2) }}</h4>
                                                <p>{{__('out_of_5')}}</p>
                                            </div>
                                            <div class="rating-details">
                                                <div class="star-count-progress">
                                                    <div class="rating-star">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="line-progress">
                                                        <div data-progress="{{ $ratings['five_star'] }}"
                                                             class="animate-progress"
                                                             style="--animate-progress:{{ $ratings['five_star'] }}%;"></div>
                                                        <p>{{ $ratings['five_star'] }}%</p>
                                                    </div>
                                                </div>
                                                <div class="star-count-progress">
                                                    <div class="rating-star">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </div>
                                                    <div class="line-progress">
                                                        <div data-progress="{{ $ratings['four_star'] }}"
                                                             class="animate-progress"
                                                             style="--animate-progress:{{ $ratings['four_star'] }}%;"></div>
                                                        <p>{{ $ratings['four_star'] }}%</p>
                                                    </div>
                                                </div>
                                                <div class="star-count-progress">
                                                    <div class="rating-star">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </div>
                                                    <div class="line-progress">
                                                        <div data-progress="{{ $ratings['three_star'] }}"
                                                             class="animate-progress"
                                                             style="--animate-progress:{{ $ratings['three_star'] }}%;"></div>
                                                        <p>{{ $ratings['three_star'] }}%</p>
                                                    </div>
                                                </div>
                                                <div class="star-count-progress">
                                                    <div class="rating-star">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </div>
                                                    <div class="line-progress">
                                                        <div data-progress="{{ $ratings['two_star'] }}"
                                                             class="animate-progress"
                                                             style="--animate-progress:{{ $ratings['two_star'] }}%;"></div>
                                                        <p>{{ $ratings['two_star'] }}%</p>
                                                    </div>
                                                </div>
                                                <div class="star-count-progress">
                                                    <div class="rating-star">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </div>
                                                    <div class="line-progress">
                                                        <div data-progress="{{ $ratings['one_star'] }}"
                                                             class="animate-progress"
                                                             style="--animate-progress:{{ $ratings['one_star'] }}%;"></div>
                                                        <p>{{ $ratings['one_star'] }}%</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if(setting('disable_write_review') !='1' && $can_review)
                                            <div class="write-review">
                                                <a href="#comment-respond"></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if(setting('disable_write_review') !='1')
                                <div class="comments-template comments-template-v2">
                                    @if($can_review)
                                        <div class="comments-respond" id="comment-respond">
                                            <h4 class="template-title template-title mt-0 mb-3 mb-lg-4">
                                                <span>{{__('Write_a_review')}}</span>
                                            </h4>
                                            <div class="rating-review rating_comment m-b-40 m-b-md-25 all-rating"></div>
                                            <span class="live-rating"></span>
                                            <form action="{{ route('store.comment') }}" method="post">
                                                @csrf
                                                <div class="input-field m-b-20">
                                                    <textarea name="comment"></textarea>
                                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                                    <input type="hidden" name="slug" value="{{ $course->slug }}">
                                                    <input type="hidden" name="type" value="course">
                                                    <input type="hidden" name="rating" class="give_rating">
                                                </div>
                                                <div class="input-field">
                                                    <button type="submit"
                                                            class="template-btn">{{__('post_review')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                    @if(count($reviews) > 0)
                                        <ul class="comments-list">
                                            @foreach($reviews as $review)
                                                @include('frontend.review_component')
                                            @endforeach
                                        </ul>
                                        @if($reviews->nextPageUrl())
                                            <div class="less-more m-t-30 m-t-sm-10">
                                                <button class="less-more-btn" data-page="{{ $reviews->currentPage() }}"
                                                        data-url="{{ route('load.reviews') }}">{{__('see_more')}}
                                                </button>
                                                @include('components.frontend_loading_btn', ['class' => 'btn'])
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 order-1 order-lg-2">
                        <div class="course-details-sidebar sidebar-offset m-t-md-30">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="course-details-info">
                                        <div class="course-video">
                                            @include('frontend.components.video',['source' => $course->video_source, 'video' => $course->video, 'class' => 'course-intro-video', 'image' => $course->image, 'size' => '402x248'])
                                        </div>
                                        <div class="single-course-info">
                                            @if ($course->is_discount == 1)
                                                <p class="course-countdown m-b-15">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z"
                                                            stroke="#FF4747" stroke-linecap="round"
                                                            stroke-linejoin="round"/>
                                                        <path d="M8 3.80078V8.00078L10.8 9.40078" stroke="#FF4747"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>

                                                    <span class="p-l-5">{{ getRemainingDaysHours($course->discount_end_at)['days'] }} days
                                                        {{ getRemainingDaysHours($course->discount_end_at)['hours'] }} {{ __('hours_left') }}!</span>

                                                </p>
                                            @endif
                                            <div class="d-flex gap-3 justify-content-between">
                                                @if (!auth()->check() || auth()->user()->user_type == 'student')
                                                    @if($course->is_free == 1 || $course->price == 0)
                                                        <span class="price">{{ __('free') }}</span>
                                                    @elseif($course->is_discountable == 1)
                                                        <span class="price">
                                                            {{ get_price($course->discount_amount, userCurrency()) }}
                                                            <small>{{ get_price($course->price, userCurrency()) }}</small>
                                                        </span>
                                                    @elseif ($course->is_renewable)
                                                        <span class="price">
                                                        {{ get_price($course->renew_price, userCurrency()) }}
                                                    </span>
                                                    @else
                                                        <span class="price">
                                                            {{ get_price($course->price, userCurrency()) }}
                                                        </span>
                                                    @endif
                                                @else
                                                    @if($course->is_free == 1 || $course->price == 0)
                                                        <span class="price">{{ __('free') }}</span>
                                                    @elseif($course->is_discountable == 1)
                                                        <span class="price">
                                                            {{ get_price($course->discount_amount, userCurrency()) }}
                                                            <small>{{ get_price($course->price, userCurrency()) }}</small>
                                                        </span>
                                                    @else
                                                        <span class="price">
                                                            {{ get_price($course->price, userCurrency()) }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="course-feature-list">
                                                <ul>
                                                    @if($category)
                                                        <li>
                                                            <h6>{{__('category')}}</h6>
                                                            <span>{{ $category->lang_title }}</span>
                                                        </li>
                                                    @endif
                                                    @if(count($lessons) > 0)
                                                        <li>
                                                            <h6>{{__('lectures')}}</h6>
                                                            <span>{{ count($lessons) }}</span>
                                                        </li>
                                                    @endif
                                                    @if($course->duration)
                                                        <li>
                                                            <h6>{{__('duration')}}</h6>
                                                            <span>{{ $course->duration }}</span>
                                                        </li>
                                                    @endif
                                                    @if($language)
                                                        <li>
                                                            <h6>{{__('language')}}</h6>
                                                            <span>{{ $language->name }}</span>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <h6>{{__('quiz_&_exam')}}</h6>
                                                        @if($quiz)
                                                            <span>{{__('available')}}</span>
                                                        @else
                                                            <span>{{__('not_available')}}</span>
                                                        @endif
                                                    </li>
                                                    @if($level)
                                                        <li>
                                                            <h6>{{__('level')}}</h6>
                                                            <span>{{ $level->lang_title }}</span>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            @if(!auth()->check() || auth()->user()->user_type =='student')
                                                <div
                                                    class="enroll-and-share d-flex d-lg-block gap-3 align-items-center">
                                                    <div
                                                        class="course-enroll cart_area d-flex align-items-center gap-4">
                                                        @if($is_enrolled)
                                                            <a href="{{ route('my-course', $course->slug) }}"
                                                               class="template-btn {{ auth() ?
                                                            'w-100' : 'w-75' }}">{{__('go_to_course') }}
                                                                <i class="fal fa-long-arrow-right"></i></a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                               class="template-btn added_to_cart {{ auth() ?
                                                           'w-100' : 'w-75' }} {{ $is_added_to_cart ? '' : 'd-none' }}">{{__('added_to_cart')}}</a>
                                                            <a href="javascript:void(0)"
                                                               class="template-btn add_to_cart {{ auth() ?
                                                            'w-100' : 'w-75' }} {{ $is_added_to_cart ? 'd-none' : '' }}"
                                                               data-id="{{ $course->id }}" data-type="course"
                                                               data-quantity="1"
                                                               data-route="{{ route('add.cart') }}">{{__('enroll_now')}}
                                                            </a>
                                                        @endif
                                                        @include('components.frontend_loading_btn', ['class' => auth() ? 'template-btn w-100' : 'template-btn w-75'])
                                                        @auth
                                                            <a href="javascript:void(0)"
                                                               class="template-btn bordered-btn-secondary add_remove_wishlist"
                                                               data-id="{{ $course->id }}"
                                                               data-type="course"
                                                               data-route="{{ route('add.remove.wishlist') }}"
                                                               data-area="wishlist">
                                                         <span class="wishlist-icon">
                                                             @if($course->wishlists->where('user_id',auth()->id())->count())
                                                                 <i class="fa-heart fas"></i>
                                                             @else
                                                                 <i class="fal fa-heart "></i>
                                                             @endif

                                                         </span></a>
                                                        @endauth
                                                    </div>
                                                    @if(setting('disable_share_option_from_course_details') !='1')
                                                        <div
                                                            class="course-social justify-content-center justify-content-md-between align-items-center">
                                                            <a href="javascript:void(0)"
                                                               class="share-course">{{__('share')}} <i
                                                                    class="fa fa-share"></i></a>
                                                            <ul class="social-profile d-none d-md-flex">
                                                                <li><a href="javascript:void(0)"><i
                                                                            class="far fa-clone copy_text"
                                                                            data-text="{{ url()->current() }}"></i></a>
                                                                </li>
                                                                <li><a href="{{ $facebook_link }}" target="_blank"><i
                                                                            class="fab fa-facebook-f"></i></a></li>
                                                                <li><a href="{{ $twitter_link }}" target="_blank"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                                <li><a href="{{ $linkedin_link }}" target="_blank"><i
                                                                            class="fab fa-linkedin-in"></i></a></li>
                                                                <li><a href="{{ $whatsapp_link }}" target="_blank"><i
                                                                            class="fab fa-whatsapp"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if(setting('hide_organization_from_course_details') !='1')
                                    @if($organization)
                                        <div class="col-md-4 col-sm-6 col-lg-12">
                                            <div class="course-instructor d-none d-lg-block">
                                                <div class="instructor-thumb p-t-15">
                                                    <img src="{{ getFileLink('127x102',$organization->logo) }}"
                                                         alt="Logo">
                                                </div>
                                                <div class="course-instructor-info">
                                                    <h3>{{ $organization->org_name }}</h3>
                                                    <p>{{ $organization->tagline ?: 'Evolution of Application Experience' }}</p>
                                                    <a href="{{ route('organization.details',$organization->slug) }}"
                                                       class="template-btn">{{__('details')}} <i
                                                            class="fal fa-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" class="text_copied" value="{{ __('text_copied') }}">
    <input type="hidden" class="text_copied_fail" value="{{ __('text_copied_fail') }}">
    <!--====== End Course Details Area ======-->
    @if(setting('disable_related_course_from_course_details') !='1' && count($related_courses) > 0)
        <!--====== Start Related Course ======-->
        <section class="related-courses-section color-bg-off-white p-t-70 p-b-50 p-t-sm-50 p-b-sm-20">
            <div class="container container-1278">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="common-heading text-center m-b-40">
                            <h3>{{__('related_course')}}</h3>
                            <p>{{__('Lorem Ipsum is not the simply random text')}}</p>
                        </div>
                    </div>
                </div>
                <div class="course-items-wrap">
                    <div class="row course-items-v3 course-slider"
                         dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                        @foreach($related_courses as $key => $course)
                            @include('frontend.course.component',['col' => 'col-lg-4'])
                        @endforeach
                    </div>
                    @if(!$related_courses->nextPageUrl())
                        <div class="text-center">
                            <a class="template-btn"
                               href="{{ route('courses',['category_ids' => $course->category_id]) }}">{{__('see_more')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
@endsection
@push('css')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/star-rating-svg.css') }}">
@endpush
@push('js')
    <script src="{{ static_asset('frontend/js/jquery.star-rating-svg.js') }}"></script>
    <script>
        $(document).ready(function () {
            initiateRating();
            let player = new Plyr('.yt_player');
            $(".rating_comment").starRating({
                totalStars: 5,
                starShape: 'rounded',
                activeColor: 'salmon',
                starSize: 20,
                emptyColor: 'lightgray',
                hoverColor: '#fdcc0d',
                initialRating: 1,
                strokeWidth: 0,
                useGradient: false,
                disableAfterRate: false,
                minRating: 1,
                useFullStars: true,
                onHover: function (currentIndex, currentRating, $el) {
                    $('.live-rating').text(currentIndex);
                },
                onLeave: function (currentIndex, currentRating, $el) {
                    $('.live-rating').text(currentRating);
                },
                callback: function (currentRating, $el) {
                    $('.give_rating').val(currentRating);
                }
            });
            $(document).on('click', '.less-more-btn', function () {
                let that = this;
                let page = parseInt($(this).data('page')) + 1;
                let url = $(this).data('url');
                let selector = $(this).closest('.less-more');
                $(that).addClass('d-none');
                $(selector).find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                        id: '{{ $id }}',
                        type: 'course'
                    },
                    success: function (data) {
                        if (data.success) {
                            $('.comments-list').append(data.html);
                        } else {
                            toastr.error(data.error);
                        }
                        $(that).data('page', page);
                        initiateRating();
                        if (data.next_page_url) {
                            selector.find('.loading_button').addClass('d-none');
                            $(that).removeClass('d-none');
                        } else {
                            selector.find('.loading_button').addClass('d-none');
                            $(that).addClass('d-none');
                        }
                    }
                });
            });
            $(document).on("click", ".copy_text", function () {
                let text = $(this).data("text");
                let success_txt = $(".text_copied").val();
                let error_txt = $(".text_copied_fail").val();
                navigator.clipboard
                    .writeText(text)
                    .then(() => {
                        toastr["success"](success_txt);
                    })
                    .catch((err) => {
                        toastr["error"](error_txt + ": ", err);
                    });
            });
            $(document).on('click', '.player-src', function () {
                let provider = $(this).data("source");
                let video = $(this).data("video");
                let type = $(this).data("type");
                let poster = $(this).data("poster");

                if (provider == 'upload' || provider == 'mp4') {
                    player.source = {
                        type: type,
                        title: 'Example title',
                        sources: [
                            {
                                src: video,
                                type: 'video/mp4',
                                size: 720,
                            }
                        ],
                        poster: poster,
                    };
                } else {
                    player.source = {
                        type: type,
                        poster: poster,
                        sources: [
                            {
                                src: video,
                                provider: provider,

                            },
                        ],
                    };
                }
                player.on('ready', (event) => {
                    player.play();
                });

            });
        });

        function initiateRating() {
            $(".review_list").starRating({
                starShape: 'rounded',
                starSize: 20,
                readOnly: true,
                activeColor: '#fdcc0d',
                useGradient: false
            });
        }
    </script>

@endpush
