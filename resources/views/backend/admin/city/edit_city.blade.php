<form action="{{ route('cities.update',$city->id) }}" method="POST" class="form">
    @csrf
    <div class="row gx-20">
        <div class="col-12">
            <div class="mb-4">
                <label for="name" class="form-label">{{__('name') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-2 name" id="name"
                       placeholder="{{ __('enter_name') }}" name="name" value="{{ $city->name }}">
                <div class="nk-block-des text-danger">
                    <p class="name_error error"></p>
                </div>
            </div>
        </div>
        <!-- End Currency Name -->

        <div class="col-12">
            <div class="mb-4">
                <label for="country" class="form-label">{{__('country') }} <span class="text-danger">*</span></label>
                <div class="select-type-v2">
                    <select id="country" class="form-select form-select-lg mb-3 with_search country_id"
                            name="country_id" data-url="{{ route('ajax.states') }}">
                        <option value="" selected>{{ __('select_country') }}</option>
                        @foreach($countries as $key => $country)
                            <option value="{{ $country->id }}" {{ $country->id == $city->country_id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <div class="nk-block-des text-danger">
                        <p class="country_id_error error"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-4">
                <label for="state" class="form-label">{{__('state') }} <span class="text-danger">*</span></label>
                <div class="select-type-v2">
                    <select class="with_search" aria-hidden="true" id="state" data-no_area="1" name="state_id">
                        <option value="">{{ __('select_state') }}</option>
                        @foreach($states as $key => $state)
                            <option value="{{ $state->id }}" {{ $state->id == $city->state_id ? 'selected' : '' }}>{{ $state->name }}</option>
                        @endforeach
                    </select>
                    <div class="nk-block-des text-danger">
                        <p class="state_id_error error"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END Permissions Tab====== -->
    <div class="d-flex justify-content-end align-items-center mt-30">
        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
    </div>
</form>
