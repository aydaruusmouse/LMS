<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BoardResource;
use App\Http\Resources\Api\BookResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\CourseResource;
use App\Http\Resources\Api\CurrencyResource;
use App\Http\Resources\Api\LanguageResource;
use App\Http\Resources\Api\MyCourseResource;
use App\Http\Resources\Api\SliderResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Country;
use App\Models\HomeScreen;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\OnBoardRepository;
use App\Repositories\PageRepository;
use App\Repositories\SliderRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiReturnFormatTrait;

    public function configs(LanguageRepository $languageRepository, CurrencyRepository $currencyRepository, PageRepository $pageRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $active_currencies = $currencyRepository->activeCurrency();
            $active_languages  = $languageRepository->activeLanguage();
            $languages         = LanguageResource::collection($active_languages);
            $currencies        = CurrencyResource::collection($active_currencies);
            $country           = Country::find(setting('default_country'));
            $default_currency  = 'USD';

            $currency_lists    = [];
            $id                = 0;

            if (count($active_currencies) > 0) {
                $currency_lists = $currencies;
                $currency       = $active_currencies->where('id', setting('default_currency'))->first();
                if ($currency) {
                    $default_currency = $currency->code;
                }
            } else {
                $currency_lists[] = [
                    'id'            => $id + 1,
                    'name'          => 'US Dollar',
                    'symbol'        => '$',
                    'code'          => 'USD',
                    'exchange_rate' => 1,
                ];
            }

            $privacy_page      = $pageRepository->get(100, true);
            $terms_page        = $pageRepository->get(101, true);
            $support_page      = $pageRepository->get(102, true);
            $about_page        = $pageRepository->get(103, true);

            $data              = [
                'app_config'      => [
                    'login_mandatory'     => setting('mandatory_login') == 1,
                    'intro_skippable'     => setting('intro_skippable') == 1,
                    'privacy_policy_url'  => setting('privacy_policy_url'),
                    'terms_condition_url' => setting('terms_condition_url'),
                    'support_url'         => setting('support_url'),
                    'cancellation_policy' => setting('cancellation_policy'),
                    'refund_policy'       => setting('refund_policy'),
                    'disable_otp'         => (bool) setting('disable_otp_verification'),
                    'disable_email'       => (bool) setting('disable_email_confirmation'),
                    'default_country'     => $country ? $country->iso2 : 'BD',
                    'logo'                => setting('logo') ? asset('storage/'.setting('logo')) : static_asset('images/default/logo/logo-green-white.png'),
                    'base_url'            => url('/'),
                    'asset_base_url'      => static_asset('/'),
                    'default_currency'    => $default_currency,
                    'pagination_limit'    => setting('api_paginate') ?: 15,
                ],
                'android_version' => [
                    'latest_apk_version' => setting('android_current_version_name'),
                    'apk_code'           => setting('android_current_version_code'),
                    'apk_file_url'       => setting('android_app_url'),
                    'whats_new'          => setting('android_whats_new'),
                    'update_skippable'   => (bool) setting('android_skippable'),
                ],
                'ios_version'     => [
                    'latest_ipa_version' => setting('ios_current_version_name'),
                    'ipa_code'           => setting('ios_current_version_code'),
                    'ipa_file_url'       => setting('ios_app_url'),
                    'whats_new'          => setting('ios_whats_new'),
                    'update_skippable'   => (bool) setting('ios_skippable'),
                ],
                'languages'       => $languages,
                'currencies'      => $currency_lists,
                'pages'           => [
                    'privacy_policy'   => $privacy_page ? [
                        'id'          => $privacy_page->id,
                        'title'       => $privacy_page->title,
                        'description' => $privacy_page->content,
                    ] : null,
                    'terms_conditions' => $terms_page ? [
                        'id'          => $terms_page->id,
                        'title'       => $terms_page->title,
                        'description' => $terms_page->content,
                    ] : null,
                    'about_us'         => $support_page ? [
                        'id'          => $support_page->id,
                        'title'       => $support_page->title,
                        'description' => $support_page->content,
                    ] : null,
                    'help_support'     => $about_page ? [
                        'id'          => $about_page->id,
                        'title'       => $about_page->title,
                        'description' => $about_page->content,
                    ] : null,
                ],
                'addons'          => [],
                'currency_config' => [
                    'default_currency'       => $default_currency,
                    'currency_symbol_format' => (string) setting('currency_symbol_format'),
                    'decimal_separator'      => (string) setting('decimal_separator'),
                    'no_of_decimals'         => (string) setting('no_of_decimals'),
                ],
            ];

            return $this->responseWithSuccess(__('Config Retrieved'), $data, 200);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function home(SliderRepository $sliderRepository, CourseRepository $courseRepository, CategoryRepository $categoryRepository, UserRepository $repository, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $home_sections = HomeScreen::where('type', 'home_screen')->orderBy('position')->get();
            $results[]     = [
                'section_type' => 'sliders',
                'sliders'      => SliderResource::collection($sliderRepository->activeSliders()),
            ];

            if (jwtUser()) {
                $results[] = [
                    'section_type' => 'my_courses',
                    'my_courses'   => MyCourseResource::collection($courseRepository->activeCourses([
                        'my_course' => 1,
                        'user_id'   => jwtUser()->id,
                        'paginate'  => setting('api_paginate'),
                    ])),
                ];
            }

            $results[]     = [
                'section_type' => 'categories',
                'categories'   => CategoryResource::collection($categoryRepository->activeCategories([
                    'type' => 'course',
                    'lang' => $request->header('lang') ?? app()->getLocale(),
                ])),
            ];
            foreach ($home_sections as $home_section) {
                if ($home_section->section == 'top_courses') {
                    $results[] = [
                        'section_type' => 'top_courses',
                        'top_courses'  => CourseResource::collection($courseRepository->activeCourses([
                            'paginate'         => 10,
                            'suggested_course' => 1,
                        ])),
                    ];
                }
                if ($home_section->section == 'instructors') {
                    $results[] = [
                        'section_type' => 'instructors',
                        'instructors'  => UserResource::collection($repository->searchUsers(['instructor.organization'], [
                            'role_id'  => 2,
                            'status'   => 1,
                            'ids'      => $home_section->values ?: [],
                            'paginate' => setting('api_paginate'),
                        ])),
                    ];
                }
                if ($home_section->section == 'offer_courses') {
                    $results[] = [
                        'section_type'  => 'offer_courses',
                        'offer_courses' => CourseResource::collection($courseRepository->activeCourses([
                            'offered'  => 1,
                            'paginate' => setting('api_paginate'),
                        ])),
                    ];
                }
                if ($home_section->section == 'featured_courses') {
                    $results[] = [
                        'section_type'     => 'featured_courses',
                        'featured_courses' => CourseResource::collection($courseRepository->activeCourses([
                            'is_featured' => 1,
                            'paginate'    => 10,
                        ])),
                    ];
                }

            }

            return $this->responseWithSuccess(__('home_screen_data'), $results);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function explore(Request $request, CourseRepository $courseRepository, CategoryRepository $categoryRepository, UserRepository $repository, BookRepository $bookRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $data = [
                'suggested_courses' => CourseResource::collection($courseRepository->activeCourses([
                    'paginate'         => setting('api_paginate'),
                    'suggested_course' => 1,
                ])),
                'course_categories' => CategoryResource::collection($categoryRepository->activeCategories([
                    'type' => 'course',
                    'lang' => $request->header('lang') ?? app()->getLocale(),
                ])),
                'featured_courses'  => CourseResource::collection($courseRepository->activeCourses([
                    'is_featured' => 1,
                    'paginate'    => setting('api_paginate'),
                ])),
                'free_courses'      => CourseResource::collection($courseRepository->activeCourses([
                    'is_free'  => 1,
                    'paginate' => setting('api_paginate'),
                ])),
                'offered_courses'   => CourseResource::collection($courseRepository->activeCourses([
                    'offered'  => 1,
                    'paginate' => setting('api_paginate'),
                ])),
                'instructors'       => UserResource::collection($repository->searchUsers(['instructor.organization'], [
                    'role_id'  => 2,
                    'status'   => 1,
                    'paginate' => setting('api_paginate'),
                ])),
            ];

            if (addon_is_activated('book_store')) {
                $data['books'] = BookResource::collection($bookRepository->activeBooks([
                    'paginate' => setting('api_paginate'),
                ]));
            }

            return $this->responseWithSuccess(__('explore_screen_data'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function onBoards(Request $request, OnBoardRepository $boardRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $data = [
                'on_boards' => BoardResource::collection($boardRepository->activeBoards([
                    'lang' => $request->header('lang') ?? app()->getLocale(),
                ])),
            ];

            return $this->responseWithSuccess(__('on_boards_retrieved'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
