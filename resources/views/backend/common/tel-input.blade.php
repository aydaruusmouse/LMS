@php
    $countries = \App\Models\Country::with('flag')->where('status', 1)->orderBy('name')->get();
    $default_country = count($countries) > 0 ? $countries->where('id', $country_id)->first() : null;
@endphp
<div class="mb-4">
    <label class="form-label">{{ $label }}</label>
    <div class="phone-field d-flex align-items-center rounded-2">
        <div class="country-code-select">
            <ul class="rounded-2 dropdown country-code-filter">
                <li class="dropdown">
                    @if($default_country)
                        <a href="javascript:void(0)" class="dropdown-item dropdown-toggle changable_flag"
                           data-bs-toggle="dropdown" aria-expanded="false">
                                                            <span class="country-flag"><img
                                                                    src="{{ $default_country->flag_icon }}"
                                                                    alt="{{ $default_country->iso2 }}"></span>
                            <span
                                class="country-code-number">{{ str_contains($default_country->phonecode,'+') ? $default_country->phonecode : '+'.$default_country->phonecode }}</span>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="dropdown-item dropdown-toggle changable_flag"
                           data-bs-toggle="dropdown" aria-expanded="false">
                                                                <span class="country-flag"><img
                                                                        src="{{ static_asset('admin/img/flag/BD.svg') }}"
                                                                        alt="Flag"></span>
                            <span class="country-code-number">+880</span>
                        </a>
                    @endif

                    <ul class="dropdown-menu simplebar">
                        <input type="text" class="country-search"
                               placeholder="Search">
                        @foreach($countries as $country)
                            <li class="country_li" data-id="{{ $country->id }}" data-flag="{{ $country->flag_icon }}"
                                data-country_code="{{ str_contains($country->phonecode,'+') ? $country->phonecode : '+'.$country->phonecode }}">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    @if($country->flag)
                                        <span class="country-flag"><img src="{{ $country->flag_icon }}"
                                                                        alt="" class="img-fluid"></span>
                                    @else
                                        <span class="country-flag"><img
                                                src="{{ static_asset('images/default/default-image-40x40.png') }}"
                                                alt="default_image" width="16" height="11" class="img-fluid"></span>
                                    @endif
                                    <span
                                        class="country-code-number">{{ str_contains($country->phonecode,'+') ? $country->phonecode : '+'.$country->phonecode }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="phone-number">
            <input type="hidden" name="countries" value="{{ $countries }}">
            <input type="tel" class="" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}">
            <input type="hidden" name="{{ $country_id_field }}" class="country_id" value="{{ $country_id }}">
        </div>
    </div>
    <div class="nk-block-des text-danger">
        <p class="error {{$name}}_error">{{ $errors->first($name) }}</p>
    </div>
</div>

