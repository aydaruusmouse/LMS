<section class="our-instructor-section color-bg-black p-t-80 p-b-80 p-t-sm-45 p-b-sm-50 position-relative minh-450">
        <div class="bg-shape-2">
            <svg width="482" height="424" viewBox="0 0 482 424" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_1932_6349" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="482" height="424">
                <rect width="482" height="424" fill="#F6C32C"></rect>
                </mask>
                <g mask="url(#mask0_1932_6349)">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M364.139 105.384C378.332 89.4187 403.157 87.6565 419.587 101.448C436.016 115.24 437.83 139.363 423.637 155.328L279.893 317.026C265.701 332.991 240.876 334.753 224.446 320.962C208.016 307.17 206.203 283.047 220.396 267.082L364.139 105.384ZM-35.4787 118.778C-21.2859 102.812 3.53861 101.05 19.9684 114.842C36.3982 128.633 38.2117 152.756 24.0189 168.722L-119.725 330.419C-133.918 346.385 -158.742 348.147 -175.172 334.355C-191.602 320.564 -193.415 296.441 -179.222 280.475L-35.4787 118.778ZM-47.5483 277.735C-33.3555 261.769 -8.53098 260.007 7.89884 273.799C24.3287 287.59 26.1421 311.713 11.9493 327.679L-131.794 489.376C-145.987 505.342 -170.812 507.104 -187.242 493.312C-203.671 479.521 -205.485 455.398 -191.292 439.432L-47.5483 277.735ZM211.075 336.003C194.645 322.211 169.82 323.973 155.628 339.939L11.884 501.636C-2.3088 517.602 -0.495377 541.725 15.9344 555.516C32.3643 569.308 57.1888 567.546 71.3817 551.58L215.125 389.883C229.318 373.918 227.505 349.795 211.075 336.003ZM413.366 253.824C396.937 240.032 372.112 241.795 357.919 257.76L214.176 419.457C199.983 435.423 201.796 459.546 218.226 473.338C234.656 487.129 259.48 485.367 273.673 469.402L417.417 307.704C431.61 291.739 429.796 267.616 413.366 253.824ZM162.635 41.2992C176.827 25.3337 201.652 23.5715 218.082 37.3632C234.512 51.1549 236.325 75.2779 222.132 91.2434L78.3885 252.941C64.1957 268.906 39.3711 270.668 22.9413 256.877C6.51149 243.085 4.69804 218.962 18.8908 202.997L162.635 41.2992ZM194.73 209.01C178.3 195.218 153.476 196.98 139.283 212.946L-4.46073 374.643C-18.6535 390.609 -16.8401 414.731 -0.410239 428.523C16.0196 442.315 40.8441 440.553 55.0369 424.587L198.781 262.89C212.973 246.924 211.16 222.801 194.73 209.01Z" fill="white" fill-opacity="0.1"></path>
                </g>
            </svg>
        </div>
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="common-heading color-white text-center m-b-40 m-b-sm-30">
                        <h3>{{ __($section->contents['title']) }}</h3>
                        <p>{{ __($section->contents['sub_title']) }}</p>
                    </div>
                </div>
            </div>
            @php($instructors = 'instructors_' . $key)
            <div class="row team-items-v1 team-slider slider-primary"
                 dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                 @if (isset($$instructors))
                    @foreach ($$instructors as $instructor)
                        <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ 200 * $loop->iteration}}">
                            <div class="team-member-item">
                                <div class="member-img">
                                    <a href="{{ route('instructor.details', $instructor->instructor->slug) }}"><img
                                            src="{{ getFileLink('280x239', $instructor->images) }}"
                                            alt="{{ $instructor->name }}"></a>
                                </div>
                                <div class="member-content">
                                    <h5>
                                        <a
                                            href="{{ route('instructor.details', $instructor->instructor->slug) }}">{{ $instructor->name }}</a>
                                    </h5>
                                    <p>{{ $instructor->instructor->designation }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @include('frontend.not_found', $data = ['title' => 'instructors'])
                @endif
            </div>
        </div>
</section>
