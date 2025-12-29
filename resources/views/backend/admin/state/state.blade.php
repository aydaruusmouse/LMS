<div class="modal fade" id="state" tabindex="-1" aria-labelledby="editStateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h6 class="sub-title create_sub_title">{{__('add_state') }}</h6>
            <h6 class="sub-title edit_sub_title d-none">{{__('edit_state') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('states.store') }}" method="POST" class="form">
                @csrf
                <div class="row gx-20">
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="name" class="form-label">{{__('name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-2 name" id="name"
                                   placeholder="{{ __('enter_name') }}" name="name" value="{{ old('name') }}">
                            <div class="nk-block-des text-danger">
                                <p class="name_error error"></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Currency Name -->

                    <div class="col-12">
                        <div class="mb-4">
                            <label for="country_id" class="form-label">{{__('country') }} <span class="text-danger">*</span></label>
                            <div class="select-type-v2">
                                <select id="country_id" class="form-select form-select-lg mb-3 with_search country_id"
                                        name="country_id">
                                    <option value="" selected>{{ __('select_country') }}</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="country_id_error error"></p>
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
        </div>
    </div>
</div>
