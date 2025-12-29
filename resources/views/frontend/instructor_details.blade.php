@extends('frontend.layouts.master')
@section('title', $user->name.' '. __('profile'))
@section('content')
    <!--====== Start instructor Details Area ======-->
    <section class="instructor-details-area p-t-50 p-t-sm-30 p-b-50 p-b-sm-30">
        <div class="container container-1278">
            <!-- Instructor Profile Overview -->
            <div class="instructor-profile-preview instructor-profile-preview m-b-50 m-b-sm-40">
                <div class="instructor-profile-picture">
                    <img src="{{ getFileLink('417x384', $user->images) }}" alt="{{ $user->name }}">
                </div>
                <div class="instructor-preview-content">
                    <div class="instructor-title-with-rating">
                        <div class="instructor-title-with-rating-content">
                            <h3 class="title">{{ $user->name }}</h3>
                            <p class="designation">{{ $instructor->designation }}</p>
                            <div class="rating-review">
                                <div class="my-rating all-rating star-2.6"></div>
                                <span class="total-review">({{ $total_review }} Reviews)</span>
                            </div>
                        </div>
                        <div class="instructor-badges">
                            <ul>
                                @foreach($badges as $badge)
                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $badge->badge_name }}"><img src="{{ static_asset($badge->logo) }}"
                                                                              alt="{{ $badge->badge_name }}"></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="instructor-current-content">
                        <a href="#" class="instructor-content-countdown">
                            <svg width="24" height="29" viewBox="0 0 24 29" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="svg-primary"
                                      d="M17.8012 7.58198V6.59303H15.8232V7.58198H17.8012ZM7.25232 7.58198V6.59303H5.27442V7.58198H7.25232ZM11.5378 0.988957L11.885 0.0629667C11.6612 -0.0209889 11.4144 -0.0209889 11.1906 0.0629667L11.5378 0.988957ZM0.988953 4.94477L0.641712 4.01878C0.255717 4.16354 0 4.53254 0 4.94477C0 5.35701 0.255717 5.726 0.641712 5.87076L0.988953 4.94477ZM11.5378 8.90058L11.1906 9.82657C11.4144 9.91053 11.6612 9.91053 11.885 9.82657L11.5378 8.90058ZM22.0866 4.94477L22.4338 5.87076C22.8199 5.726 23.0756 5.35701 23.0756 4.94477C23.0756 4.53254 22.8199 4.16354 22.4338 4.01878L22.0866 4.94477ZM12.4753 20.7758L11.7722 20.0804L12.4753 20.7758ZM14.57 18.6577L15.2731 19.3532L14.57 18.6577ZM15.8074 18.3208L16.0864 17.3721L15.8074 18.3208ZM8.50559 18.6577L9.20873 17.9623L8.50559 18.6577ZM10.6003 20.7758L11.3033 20.0804L10.6003 20.7758ZM7.26814 18.3208L6.98913 17.3721L7.26814 18.3208ZM21.0977 27.361C21.0977 27.9072 21.5404 28.35 22.0866 28.35C22.6328 28.35 23.0756 27.9072 23.0756 27.361H21.0977ZM0 27.361C0 27.9072 0.442774 28.35 0.988953 28.35C1.53513 28.35 1.97791 27.9072 1.97791 27.361H0ZM15.8232 7.58198V10.2192H17.8012V7.58198H15.8232ZM7.25232 10.2192V7.58198H5.27442V10.2192H7.25232ZM11.5378 14.5047C9.17102 14.5047 7.25232 12.586 7.25232 10.2192H5.27442C5.27442 13.6784 8.07862 16.4826 11.5378 16.4826V14.5047ZM15.8232 10.2192C15.8232 12.586 13.9045 14.5047 11.5378 14.5047V16.4826C14.997 16.4826 17.8012 13.6784 17.8012 10.2192H15.8232ZM11.1906 0.0629667L0.641712 4.01878L1.33619 5.87076L11.885 1.91495L11.1906 0.0629667ZM11.885 9.82657L22.4338 5.87076L21.7394 4.01878L11.1906 7.97459L11.885 9.82657ZM11.1906 1.91495L21.7394 5.87076L22.4338 4.01878L11.885 0.0629667L11.1906 1.91495ZM11.885 7.97459L1.33619 4.01878L0.641712 5.87076L11.1906 9.82657L11.885 7.97459ZM13.1785 21.4711L15.2731 19.3532L13.8668 17.9623L11.7722 20.0804L13.1785 21.4711ZM15.5284 19.2697C19.053 20.3061 21.0977 22.5172 21.0977 24.7238H23.0756C23.0756 21.2154 19.9596 18.5111 16.0864 17.3721L15.5284 19.2697ZM7.80242 19.3532L9.89704 21.4711L11.3033 20.0804L9.20873 17.9623L7.80242 19.3532ZM1.97791 24.7238C1.97791 22.5172 4.02257 20.3061 7.54715 19.2697L6.98913 17.3721C3.11598 18.5111 0 21.2154 0 24.7238H1.97791ZM21.0977 24.7238V27.361H23.0756V24.7238H21.0977ZM0 24.7238V27.361H1.97791V24.7238H0ZM9.20873 17.9623C8.6504 17.3977 7.80753 17.1314 6.98913 17.3721L7.54715 19.2697C7.61171 19.2507 7.71361 19.2634 7.80242 19.3532L9.20873 17.9623ZM15.2731 19.3532C15.362 19.2634 15.4638 19.2507 15.5284 19.2697L16.0864 17.3721C15.268 17.1314 14.4251 17.3977 13.8668 17.9623L15.2731 19.3532ZM11.7722 20.0804C11.6431 20.2108 11.4324 20.2108 11.3033 20.0804L9.89704 21.4711C10.8003 22.3845 12.2753 22.3845 13.1785 21.4711L11.7722 20.0804Z"
                                      fill="var(--color-secondary-4)"/>
                            </svg>
                            <div class="name">
                                <span>{{ ReadableHumanNumber($total_student) }}</span>
                                <h6>{{__('students') }}</h6>
                            </div>
                        </a>
                        <a href="#" class="instructor-content-countdown">
                            <svg width="26" height="29" viewBox="0 0 26 29" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="svg-primary"
                                      d="M18.1305 3.95627C17.5843 3.95627 17.1415 4.39904 17.1415 4.94521C17.1415 5.49138 17.5843 5.93414 18.1305 5.93414V3.95627ZM7.58184 5.93414C8.12801 5.93414 8.57077 5.49138 8.57077 4.94521C8.57077 4.39904 8.12801 3.95627 7.58184 3.95627V5.93414ZM13.8451 23.4053C13.8451 22.8592 13.4023 22.4164 12.8562 22.4164C12.31 22.4164 11.8672 22.8592 11.8672 23.4053H13.8451ZM8.90042 26.3721C8.35425 26.3721 7.91148 26.8149 7.91148 27.3611C7.91148 27.9072 8.35425 28.35 8.90042 28.35V26.3721ZM16.8119 28.35C17.3581 28.35 17.8008 27.9072 17.8008 27.3611C17.8008 26.8149 17.3581 26.3721 16.8119 26.3721V28.35ZM13.8451 2.55518C13.8451 2.00901 13.4023 1.56624 12.8562 1.56624C12.31 1.56624 11.8672 2.00901 11.8672 2.55518H13.8451ZM11.8672 9.86186C11.8672 10.408 12.31 10.8508 12.8562 10.8508C13.4023 10.8508 13.8451 10.408 13.8451 9.86186H11.8672ZM8.63371 0.995243L8.52572 1.97827L8.63371 0.995243ZM12.8562 2.30805L12.2993 3.12534L12.8562 3.50467L13.413 3.12534L12.8562 2.30805ZM8.63371 8.87211L8.52572 9.85512L8.63371 8.87211ZM12.8562 10.2195L12.2993 11.0368C12.6353 11.2657 13.077 11.2657 13.413 11.0368L12.8562 10.2195ZM17.0786 0.995243L17.1866 1.97827L17.0786 0.995243ZM17.0786 8.87211L17.1866 9.85512L17.0786 8.87211ZM23.7344 7.58237V20.7682H25.7123V7.58237H23.7344ZM22.0862 22.4164H3.6261V24.3943H22.0862V22.4164ZM1.97787 20.7682V7.58237H0V20.7682H1.97787ZM18.1305 5.93414H22.0862V3.95627H18.1305V5.93414ZM3.6261 5.93414H7.58184V3.95627H3.6261V5.93414ZM3.6261 22.4164C2.7158 22.4164 1.97787 21.6785 1.97787 20.7682H0C0 22.7708 1.62346 24.3943 3.6261 24.3943V22.4164ZM23.7344 20.7682C23.7344 21.6785 22.9966 22.4164 22.0862 22.4164V24.3943C24.0889 24.3943 25.7123 22.7708 25.7123 20.7682H23.7344ZM25.7123 7.58237C25.7123 5.57973 24.0889 3.95627 22.0862 3.95627V5.93414C22.9966 5.93414 23.7344 6.67207 23.7344 7.58237H25.7123ZM1.97787 7.58237C1.97787 6.67207 2.7158 5.93414 3.6261 5.93414V3.95627C1.62346 3.95627 0 5.57973 0 7.58237H1.97787ZM11.8672 23.4053V27.3611H13.8451V23.4053H11.8672ZM12.8562 26.3721H8.90042V28.35H12.8562V26.3721ZM12.8562 28.35H16.8119V26.3721H12.8562V28.35ZM11.8672 2.55518V9.86186H13.8451V2.55518H11.8672ZM8.52572 1.97827C9.06057 2.03703 9.78232 2.16465 10.4955 2.36558C11.2219 2.57022 11.8675 2.83112 12.2993 3.12534L13.413 1.49075C12.7247 1.02189 11.8441 0.690651 11.0318 0.461812C10.2063 0.229241 9.37689 0.0820078 8.7417 0.0122286L8.52572 1.97827ZM8.52572 9.85512C9.05261 9.91301 9.7713 10.0476 10.4856 10.2569C11.2116 10.4696 11.8623 10.7391 12.2993 11.0368L13.413 9.40223C12.7298 8.93688 11.8544 8.59694 11.0417 8.35883C10.2173 8.11729 9.38485 7.95974 8.7417 7.88908L8.52572 9.85512ZM6.5929 1.98179V7.75815H8.57077V1.98179H6.5929ZM8.7417 7.88908C8.68462 7.88281 8.6349 7.85599 8.60317 7.82303C8.57412 7.79284 8.57077 7.77054 8.57077 7.75815H6.5929C6.5929 8.90424 7.50908 9.74344 8.52572 9.85512L8.7417 7.88908ZM8.7417 0.0122286C7.51547 -0.122491 6.5929 0.876755 6.5929 1.98179H8.57077C8.57077 1.96255 8.57801 1.95816 8.57378 1.9622C8.57123 1.96462 8.56456 1.9699 8.55292 1.974C8.5472 1.976 8.54132 1.97733 8.5358 1.97798C8.53021 1.97863 8.52663 1.97836 8.52572 1.97827L8.7417 0.0122286ZM16.9707 0.0122286C16.3354 0.0820078 15.506 0.229241 14.6805 0.461812C13.8682 0.690651 12.9876 1.02189 12.2993 1.49075L13.413 3.12534C13.8448 2.83112 14.4904 2.57022 15.2168 2.36558C15.93 2.16465 16.6517 2.03703 17.1866 1.97827L16.9707 0.0122286ZM16.9707 7.88908C16.3275 7.95974 15.495 8.11729 14.6707 8.35883C13.8579 8.59694 12.9825 8.93688 12.2993 9.40223L13.413 11.0368C13.85 10.7391 14.5007 10.4696 15.2267 10.2569C15.941 10.0476 16.6597 9.91301 17.1866 9.85512L16.9707 7.88908ZM17.1415 1.98179V7.75815H19.1194V1.98179H17.1415ZM17.1866 9.85512C18.2033 9.74344 19.1194 8.90424 19.1194 7.75815H17.1415C17.1415 7.77054 17.1382 7.79284 17.1091 7.82303C17.0775 7.85599 17.0278 7.88281 16.9707 7.88908L17.1866 9.85512ZM17.1866 1.97827C17.1857 1.97836 17.1822 1.97863 17.1765 1.97798C17.1709 1.97733 17.1651 1.976 17.1593 1.974C17.1477 1.9699 17.141 1.96462 17.1385 1.9622C17.1343 1.95816 17.1415 1.96255 17.1415 1.98179H19.1194C19.1194 0.876755 18.1968 -0.122491 16.9707 0.0122286L17.1866 1.97827Z"
                                      fill="var(--color-secondary-4)"/>
                            </svg>
                            <div class="name">
                                <span>{{ ReadableHumanNumber($total_course) }}</span>
                                <h6>{{__('courses') }}</h6>
                            </div>
                        </a>
                        @if (addon_is_activated('book_store'))
                            <a href="#" class="instructor-content-countdown">
                                <svg width="29" height="26" viewBox="0 0 29 26" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path class="svg-primary"
                                          d="M5.0419 6.86735C4.5079 6.78465 4.00796 7.15051 3.92526 7.68452C3.84255 8.21852 4.20841 8.71846 4.74242 8.80116L5.0419 6.86735ZM9.75756 10.0948C10.2616 10.2897 10.8281 10.0391 11.023 9.53509C11.2179 9.03109 10.9674 8.46451 10.4634 8.26962L9.75756 10.0948ZM5.0419 12.0857C4.5079 12.003 4.00796 12.3688 3.92526 12.9029C3.84255 13.4368 4.20841 13.9367 4.74242 14.0195L5.0419 12.0857ZM7.26196 14.528C7.78591 14.6601 8.31782 14.3426 8.45001 13.8186C8.58221 13.2946 8.26462 12.7628 7.74066 12.6305L7.26196 14.528ZM15.0026 4.96254C15.0026 4.42216 14.5645 3.98411 14.0242 3.98411C13.4838 3.98411 13.0458 4.42216 13.0458 4.96254H15.0026ZM13.0458 23.5516C13.0458 24.092 13.4838 24.53 14.0242 24.53C14.5645 24.53 15.0026 24.092 15.0026 23.5516H13.0458ZM3.58019 0.993893L3.69005 0.0216452L3.58019 0.993893ZM13.1329 4.14207L13.6944 3.34077L13.1329 4.14207ZM3.58019 21.0335L3.69005 20.0613L3.58019 21.0335ZM13.1329 24.1817L13.6944 23.3804L13.1329 24.1817ZM24.4682 0.993893L24.3584 0.0216452L24.4682 0.993893ZM14.9155 4.14207L14.354 3.34077L14.9155 4.14207ZM24.4682 21.0335L24.3584 20.0613L24.4682 21.0335ZM14.9155 24.1817L14.354 23.3804L14.9155 24.1817ZM4.74242 8.80116C6.34545 9.04942 8.11557 9.4598 9.75756 10.0948L10.4634 8.26962C8.65548 7.57052 6.74148 7.13056 5.0419 6.86735L4.74242 8.80116ZM4.74242 14.0195C5.55027 14.1446 6.40303 14.3113 7.26196 14.528L7.74066 12.6305C6.81572 12.3972 5.90258 12.2189 5.0419 12.0857L4.74242 14.0195ZM13.0458 4.96254V23.5516H15.0026V4.96254H13.0458ZM3.47033 1.96614C6.30953 2.28696 10.0019 3.1428 12.5714 4.94335L13.6944 3.34077C10.7229 1.25858 6.63892 0.354873 3.69005 0.0216452L3.47033 1.96614ZM3.47033 22.0058C6.30953 22.3266 10.0019 23.1824 12.5714 24.983L13.6944 23.3804C10.7229 21.2982 6.63892 20.3945 3.69005 20.0613L3.47033 22.0058ZM0 3.50378V18.1996H1.95686V3.50378H0ZM3.69005 20.0613C2.71191 19.9507 1.95686 19.1376 1.95686 18.1996H0C0 20.2128 1.58386 21.7926 3.47033 22.0058L3.69005 20.0613ZM3.69005 0.0216452C1.58707 -0.215983 0 1.53923 0 3.50378H1.95686C1.95686 2.51697 2.7087 1.88008 3.47033 1.96614L3.69005 0.0216452ZM24.3584 0.0216452C21.4095 0.354873 17.3254 1.25858 14.354 3.34077L15.477 4.94335C18.0465 3.1428 21.7388 2.28696 24.5781 1.96614L24.3584 0.0216452ZM24.3584 20.0613C21.4095 20.3945 17.3254 21.2982 14.354 23.3804L15.477 24.983C18.0465 23.1824 21.7388 22.3266 24.5781 22.0058L24.3584 20.0613ZM26.0915 3.50378V18.1996H28.0484V3.50378H26.0915ZM24.5781 22.0058C26.4645 21.7926 28.0484 20.2128 28.0484 18.1996H26.0915C26.0915 19.1376 25.3364 19.9507 24.3584 20.0613L24.5781 22.0058ZM24.5781 1.96614C25.3397 1.88008 26.0915 2.51697 26.0915 3.50378H28.0484C28.0484 1.53923 26.4614 -0.215983 24.3584 0.0216452L24.5781 1.96614ZM12.5714 24.983C13.441 25.5923 14.6073 25.5923 15.477 24.983L14.354 23.3804C14.1586 23.5173 13.8898 23.5173 13.6944 23.3804L12.5714 24.983ZM12.5714 4.94335C13.441 5.55265 14.6073 5.55265 15.477 4.94335L14.354 3.34077C14.1586 3.4777 13.8898 3.4777 13.6944 3.34077L12.5714 4.94335Z"
                                          fill="var(--color-secondary-4)"/>
                                </svg>
                                <div class="name">
                                    <span>{{ ReadableHumanNumber($books->count()) }}</span>
                                    <h6>{{__('books') }}</h6>
                                </div>
                            </a>
                        @endif
                        {{--                        <a href="#" class="instructor-content-countdown">--}}
                        {{--                            <svg width="26" height="29" viewBox="0 0 26 29" fill="none"--}}
                        {{--                                 xmlns="http://www.w3.org/2000/svg">--}}
                        {{--                                <path class="svg-primary"--}}
                        {{--                                      d="M19.5278 28.5H6.33334C2.90278 28.5 0 25.7292 0 22.1667V6.33333C0 2.90278 2.77083 0 6.33334 0H19.5278C22.9583 0 25.8611 2.77083 25.8611 6.33333V22.1667C25.8611 25.5972 22.9583 28.5 19.5278 28.5ZM6.33334 2.11111C3.95833 2.11111 2.11111 3.95833 2.11111 6.33333V22.1667C2.11111 24.5417 4.09028 26.3889 6.33334 26.3889H19.5278C21.9028 26.3889 23.75 24.4097 23.75 22.1667V6.33333C23.75 3.95833 21.7708 2.11111 19.5278 2.11111H6.33334Z"--}}
                        {{--                                      fill="var(--color-secondary-4)"/>--}}
                        {{--                                <path class="svg-primary"--}}
                        {{--                                      d="M7.64931 19.792C7.12153 19.792 6.59375 20.1878 6.59375 20.8475C6.59375 21.5073 6.98958 21.9031 7.64931 21.9031V19.792ZM12.9271 21.9031C13.4549 21.9031 13.9826 21.5073 13.9826 20.8475C13.9826 20.1878 13.5868 19.792 12.9271 19.792V21.9031ZM7.64931 21.9031H12.9271V19.9239H7.64931V21.9031Z"--}}
                        {{--                                      fill="var(--color-secondary-4)"/>--}}
                        {{--                                <path class="svg-primary"--}}
                        {{--                                      d="M7.64931 13.1953C7.12153 13.1953 6.59375 13.5911 6.59375 14.2509C6.59375 14.9106 6.98958 15.3064 7.64931 15.3064V13.1953ZM18.2049 15.3064C18.7326 15.3064 19.2604 14.9106 19.2604 14.2509C19.2604 13.5911 18.8646 13.1953 18.2049 13.1953V15.3064ZM7.64931 15.3064H18.2049V13.3273H7.64931V15.3064Z"--}}
                        {{--                                      fill="var(--color-secondary-4)"/>--}}
                        {{--                                <path class="svg-primary"--}}
                        {{--                                      d="M7.64931 6.59766C7.12153 6.59766 6.59375 7.12543 6.59375 7.65321C6.59375 8.18099 7.12153 8.70877 7.64931 8.70877V6.59766ZM18.2049 8.70877C18.7326 8.70877 19.2604 8.31294 19.2604 7.65321C19.2604 6.99349 18.7326 6.59766 18.2049 6.59766V8.70877ZM7.64931 8.70877H18.2049V6.59766H7.64931V8.70877Z"--}}
                        {{--                                      fill="var(--color-secondary-4)"/>--}}
                        {{--                            </svg>--}}
                        {{--                            <div class="name">--}}
                        {{--                                <span>{{ ReadableHumanNumber($blogs->total()) }}</span>--}}
                        {{--                                <h6>{{__('articles') }}</h6>--}}
                        {{--                            </div>--}}
                        {{--                        </a>--}}
                    </div>
                    <div class="instructor-social-activity">
                        <div class="instructor-follow-wrapper">
                            <ul class="following-and-followers">
                                <li>
                                    <span
                                        class="following_counter"> {{ ReadableHumanNumber($instructor->user->following->count()) }}</span>{{__('following') }}
                                </li>
                                <li>
                                    <span
                                        class="follow_counter">{{ ReadableHumanNumber($instructor->user->followers->count()) }}</span>{{__('followers') }}
                                </li>
                            </ul>
                            @if(auth()->check() && auth()->id() != $instructor->user_id)
                                <div class="follow-btn" id="followArea">
                                    <a href="javascript:void(0)" data-follow-id="{{ $instructor->user->id }}"
                                       data-value="0" id="unfollow"
                                       class="template-btn follow-instructor {{ $is_followed ? '' : 'd-none' }}">
                                        <i
                                            class="fal fa-minus ms-0 m-r-5"></i>{{__('Unfollow') }}</a>

                                    <a href="javascript:void(0)" data-follow-id="{{ $instructor->user->id }}"
                                       data-value="1" id="follow"
                                       class="template-btn follow-instructor {{ !$is_followed ? '' : 'd-none' }}">
                                        <i
                                            class="fal fa-plus ms-0 m-r-5"></i>{{__('follow') }}</a>
                                    @include('components.frontend_loading_btn', ['class' => 'template-btn follow-instructor'])
                                </div>
                            @endif
                        </div>
                        @if(setting('hide_all_instructor_contact_information_from_everywhere') !='1')
                            @if(setting('hide_instructor_social_contact_information') !='1')
                                <ul class="social-profile">
                                    @if(getArrayValue('facebook',$instructor->social_links) !="")
                                        <li><a href="{{ getArrayValue('facebook',$instructor->social_links) }}"
                                               target="_blank"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                    @if(getArrayValue('twitter',$instructor->social_links) !="")
                                        <li><a href="{{ getArrayValue('twitter',$instructor->social_links) }}"
                                               target="_blank"><i
                                                    class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if(getArrayValue('instagram',$instructor->social_links) !="")
                                        <li><a href="{{ getArrayValue('instagram',$instructor->social_links) }}"
                                               target="_blank"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                    @endif
                                    @if(getArrayValue('linkedin',$instructor->social_links) !="")
                                        <li><a href="{{ getArrayValue('linkedin',$instructor->social_links) }}"
                                               target="_blank"><i
                                                    class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if(getArrayValue('youtube',$instructor->social_links) !="")
                                        <li><a href="{{ getArrayValue('youtube',$instructor->social_links) }}"
                                               target="_blank"><i
                                                    class="fab fa-youtube"></i></a></li>
                                    @endif
                                </ul>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Instructor Details Tab -->
                    <div class="instructor-details-tabs main-tabs">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session()->has('contact') ? '' : 'active' }}"
                                        id="about-instructor-tab" data-bs-toggle="pill"
                                        data-bs-target="#about-instructor" type="button" role="tab"
                                        aria-controls="about-instructor" aria-selected="true">{{__('about')}}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="instructor-course-tab" data-bs-toggle="pill"
                                        data-bs-target="#instructor-course" type="button" role="tab"
                                        aria-controls="instructor-course" aria-selected="false">{{__('course')}}
                                </button>
                            </li>
                            @if(addon_is_activated('book_store'))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="instructor-book-tab" data-bs-toggle="pill"
                                            data-bs-target="#instructor-book" type="button" role="tab"
                                            aria-controls="instructor-book" aria-selected="false">{{__('book')}}
                                    </button>
                                </li>
                            @endif
                            {{--                            <li class="nav-item" role="presentation">--}}
                            {{--                                <button class="nav-link" id="instructor-article-tab" data-bs-toggle="pill"--}}
                            {{--                                        data-bs-target="#instructor-article" type="button" role="tab"--}}
                            {{--                                        aria-controls="instructor-article" aria-selected="false">{{__('article')}}--}}
                            {{--                                </button>--}}
                            {{--                            </li>--}}
                            @if(setting('hide_all_instructor_contact_information_from_everywhere') !='1')
                                @if(setting('hide_instructor_contact_information') !='1')
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ session()->has('contact') ? 'active' : '' }}"
                                                id="instructor-contact-tab" data-bs-toggle="pill"
                                                data-bs-target="#instructor-contact" type="button" role="tab"
                                                aria-controls="instructor-contact"
                                                aria-selected="false">{{__('contact')}}
                                        </button>
                                    </li>
                                @endif
                            @endif
                        </ul>

                        <div class="instructor-details-tab-content tab-content" id="pills-tabContent">
                            <!-- About Instructor Tab -->
                            <div class="tab-pane fade {{ session()->has('contact') ? '' : 'show active' }}"
                                 id="about-instructor" role="tabpanel"
                                 aria-labelledby="about-instructor-tab">
                                <div class="about-instructor-content">
                                    <h4>{{ __('about') }} {{ $user->name }} </h4>
                                    <p>{!! $user->about !!}</p>
                                </div>
                            </div>

                            <!-- Instructor Course Tab -->
                            <div class="instructor-course-tab tab-pane fade" id="instructor-course" role="tabpanel"
                                 aria-labelledby="instructor-course-tab">
                                <div class="row append_area course-items-v3">
                                    @foreach($courses as $key=> $course)
                                        @include('frontend.course.component',['col' => 'col-lg-4'])
                                    @endforeach
                                </div>
                                @if($courses->nextPageUrl())
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <a href="javascript:void(0)"
                                               class="template-btn load_more"
                                               data-page="{{ $courses->currentPage() }}"
                                               data-url="{{ route('instructor.courses') }}">{{ __('load_more') }}</a>
                                            @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Instructor Book Tab -->
                            @if(addon_is_activated('book_store'))
                                <div class="instructor-book-tab tab-pane fade m-b-10" id="instructor-book"
                                     role="tabpanel"
                                     aria-labelledby="instructor-book-tab">
                                    <div class="row append_area">
                                        @foreach($books as $book)
                                            @include('frontend.books.component')
                                        @endforeach
                                    </div>
                                    @if($books->nextPageUrl())
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <a href="javascript:void(0)"
                                                   class="template-btn load_more"
                                                   data-page="{{ $books->currentPage() }}"
                                                   data-url="{{ route('instructor.books') }}">{{ __('load_more') }}</a>
                                                @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- Instructor Article Tab -->
                            <div class="instructor-article-tab tab-pane fade" id="instructor-article" role="tabpanel"
                                 aria-labelledby="instructor-article-tab">
                                <div class="row blog-post-items-v3 append_area">
                                    @foreach($blogs as $key => $blog)
                                        @include('frontend.blogs.component')
                                    @endforeach
                                </div>
                                @if($blogs->nextPageUrl())
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <a href="javascript:void(0)"
                                               class="template-btn load_more"
                                               data-page="{{ $blogs->currentPage() }}"
                                               data-url="{{ route('instructor.blogs') }}">{{ __('load_more') }}</a>
                                            @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if(setting('hide_all_instructor_contact_information_from_everywhere') !='1')
                                <!-- Instructor Contact Tab -->
                                <div
                                    class="instructor-contact-tab m-b-30 tab-pane fade {{ session()->has('contact') ? 'show active' : '' }}"
                                    id="instructor-contact"
                                    role="tabpanel" aria-labelledby="instructor-contact-tab">
                                    <div class="row">
                                        @if(setting('hide_contact_form') !='1')
                                            <div class="col-md-6 m-b-sm-30">
                                                <form method="POST" action="{{ route('instructor.contact') }}"
                                                      class="user-form contact-form">
                                                    @csrf
                                                    <input type="hidden" name="instructor_id"
                                                           value="{{ $instructor->id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="name">{{__('name') }}</label>
                                                            <input type="text" class="form-control mb-0 " name="name"
                                                                   id="name"
                                                                   placeholder="{{__('name') }}">
                                                            @if($errors->has('name'))
                                                                <div class="nk-block-des text-danger">
                                                                    <p>{{ $errors->first('name') }}</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <label for="email ">{{__('email') }}</label>
                                                            <input type="email" class="form-control mb-0 " name="email"
                                                                   id="email"
                                                                   placeholder="{{__('email') }}">
                                                            @if($errors->has('email'))
                                                                <div class="nk-block-des text-danger">
                                                                    <p>{{ $errors->first('email') }}</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <label for="message">{{__('message') }}</label>
                                                            <textarea class="form-control" name="message" id="message"
                                                                      placeholder="{{__('message') }}"></textarea>
                                                            @if($errors->has('message'))
                                                                <div class="nk-block-des text-danger">
                                                                    <p>{{ $errors->first('message') }}</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12">
                                                            <button class="template-btn"
                                                                    type="submit">{{__('send_message') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="contact-form-info">
                                                <h4>{{__('get_in_touch_with_instructor') }}</h4>
                                                <ul>
                                                    @if($user->phone)
                                                        <li><a href="tel:{{ $user->phone }}"><i
                                                                    class="fas fa-phone"></i> {{ $user->phone }}</a>
                                                        </li>
                                                    @endif
                                                    @if($user->email)
                                                        <li><a href="mailto:{{ $user->email }}"><i
                                                                    class="fas fa-envelope"></i> {{ $user->email }}</a>
                                                        </li>
                                                    @endif
                                                    @if($instructor->website)
                                                        <li><a href="{{ $instructor->website }}" target="_blank"><i
                                                                    class="fal fa-globe"></i>{{ $instructor->website }}
                                                            </a></li>
                                                    @endif
                                                    @if($user->address)
                                                        <li><i class="fal fa-map-marker-alt"></i>{{ $user->address }}
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Instructor Details Area ======-->
@endsection
@push('css')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/star-rating-svg.css') }}">
@endpush
@push('js')
    <script src="{{ static_asset('frontend/js/jquery.star-rating-svg.js') }}"></script>
    <script>
        $(document).ready(function () {

            $(".my-rating").starRating({
                initialRating: parseFloat('{{ $total_rating }}'),
                starShape: 'rounded',
                starSize: 20,
                readOnly: true,
                activeColor: '#fdcc0d',
                useGradient: false
            });

            $(".books_rating").starRating({
                starShape: 'rounded',
                starSize: 20,
                readOnly: true,
                activeColor: '#fdcc0d',
                useGradient: false
            });

            $(document).on('click', '.follow-instructor', function () {
                var follow_id = $(this).data('follow-id');
                var status = $(this).data('value');
                var url = "{{ route('follow') }}";
                var token = "{{ @csrf_token() }}";
                let that = this;

                $(that).addClass('d-none');
                $(that).closest('.follow-btn').find('.loading_button').removeClass('d-none');

                $.ajax({
                    url: url,
                    type: 'post',
                    data: {status: status, follow_id: follow_id, _token: token},
                    success: function (data) {
                        if (data.success) {
                            let selector = $('.follow_counter');
                            toastr.success(data.success);
                            $(that).closest('.follow-btn').find('.loading_button').addClass('d-none');
                            if (status == 1) {
                                selector.text(parseInt(selector.text()) + 1);
                                $('#follow').addClass('d-none');
                                $('#unfollow').removeClass('d-none');
                            } else {
                                selector.text(parseInt(selector.text()) - 1);
                                $('#follow').removeClass('d-none');
                                $('#unfollow').addClass('d-none');
                            }
                        } else {
                            $(that).removeClass('d-none');
                            $(that).closest('.follow-btn').find('.loading_button').addClass('d-none');
                            toastr.error(data.error);
                        }
                    }
                });
            });

            $(document).on('click', '.load_more', function () {
                let url = $(this).data('url');
                let page = parseInt($(this).data('page')) + 1;
                let data = {
                    page: page,
                    user_id: {{ $user->id }}
                };
                let selector = $(this).closest('.tab-pane').find('.append_area');
                let that = $(this);
                that.closest('.row').find('.loading_button').removeClass('d-none');
                that.addClass('d-none');

                $.ajax({
                    url: url,
                    type: 'get',
                    data: data,
                    success: function (data) {
                        if (data.success) {
                            selector.append(data.html);
                            initAOS();
                            if (data.next_page_url) {
                                that.data('page', page);
                                that.closest('.row').find('.loading_button').addClass('d-none');
                                that.removeClass('d-none');
                            } else {
                                that.closest('.row').find('.loading_button').addClass('d-none');
                                that.remove();
                            }
                        } else {
                            that.removeClass('d-none');
                            that.closest('.row').find('.loading_button').addClass('d-none');
                        }
                    }
                });
            });
        });
    </script>
@endpush
