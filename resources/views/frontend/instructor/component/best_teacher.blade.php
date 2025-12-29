<div class="col-lg-6 col-6" data-aos="fade-up" data-aos-delay="{{ 200 * $key}}">
    <div class="team-member-item">
        <a href="{{ $teacher->slug ? route('instructor.details', $teacher->slug) : '#' }}"
           class="member-img">
            <img src="{{ getFileLink('128x128', $teacher->user->images) }}"
                 alt="{{ $teacher->user->first_name }}">
        </a>
        <div class="member-content">
            <h5 class="title"><a
                    href="{{ $teacher->slug ? route('instructor.details', $teacher->slug) : '#' }}">{{ $teacher->user->first_name }}
                    {{ $teacher->user->last_name }} </a>
            </h5>
            @if ($teacher->expertises != null)
                @php
                    $expertises = \App\Models\Expertise::whereIn('id', $teacher->expertises)->get();
                @endphp
                <p>
                    @foreach ($expertises as $expert)
                        {{ $expert->title }}
                    @endforeach
                </p>
            @endif
            <div class="member-footer">
                <a href="{{ $teacher->slug ? route('instructor.details', $teacher->slug) : '#' }}"
                   class="template-btn">{{ __('details') }}</a>
                <ul class="social-profile">
                    <!-- add theme-color-icon class for white bg icon -->
                    <li><a target="_blank"
                           href="{{ arrayCheck('facebook', $teacher->social_links) ? $teacher->social_links['facebook'] : '#' }}"><i
                                class="fab fa-facebook-f"></i></a></li>
                    <li><a target="_blank"
                           href="{{ arrayCheck('twitter', $teacher->social_links) ? $teacher->social_links['twitter'] : '# ' }}"><i
                                class="fab fa-twitter"></i></a></li>
                    <li><a target="_blank"
                           href="{{ arrayCheck('linkedin', $teacher->social_links) ? $teacher->social_links['linkedin'] : '#' }}"><i
                                class="fab fa-linkedin-in"></i></a></li>
                    <li><a target="_blank"
                           href="{{ arrayCheck('instagram', $teacher->social_links) ? $teacher->social_links['instagram'] : '#' }}"><i
                                class="fab fa-instagram"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
