
<div class="col-lg-6 col-6" data-aos="fade-up" data-aos-delay="{{ 200 * $key}}">
    <div class="team-member-item">
        <a href="{{ route('instructor.details', $instructor->slug) }}" class="member-img">
            <img src="{{ getFileLink('280x239', $instructor->user->images) }}" alt="{{  $instructor->user->name }}">
        </a>

        <div class="member-content">
            <h5 class="title"><a href="{{  route('instructor.details', $instructor->slug) }}">{{ $instructor->user->name }}</a></h5>
            <p>{{ $instructor->designation }}</p>
            <div class="member-footer">
                <a href="{{ route('instructor.details', $instructor->slug) }}" class="template-btn">{{__('details') }}</a>
                <ul class="social-profile"> <!-- add theme-color-icon class for white bg icon -->
                    <li><a target="_blank" href="{{ arrayCheck('facebook', $instructor->social_links) ? $instructor->social_links['facebook']: '#'  }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a target="_blank" href="{{ arrayCheck('twitter', $instructor->social_links) ? $instructor->social_links['twitter'] : '#' }}"><i class="fab fa-twitter"></i></a></li>
                    <li><a target="_blank" href="{{ arrayCheck('linkedin', $instructor->social_links) ? $instructor->social_links['linkedin']: '#'  }}"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a target="_blank" href="{{ arrayCheck('instagram', $instructor->social_links) ? $instructor->social_links['instagram'] : '#' }}"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
