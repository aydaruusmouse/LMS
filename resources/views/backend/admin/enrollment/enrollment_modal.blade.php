<div class="modal fade" id="student_modal" tabindex="-1" aria-labelledby="editCityLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <h6 class="sub-title">{{__('add_students_to_courses') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <form action="{{ route('bulk.enrollments') }}" method="POST" class="form">@csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="country" class="form-label">{{__('student') }} <span
                                    class="text-danger">*</span></label>
                            <div class="select-type-v2">
                                <select class="form-select form-select-lg mb-3" data-role_id="3" data-route="{{ route('ajax.users') }}"
                                        name="student_id[]" id="student" multiple  placeholder="{{ __('select_students') }}">
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="student_id_error error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="state" class="form-label">{{__('course') }} <span
                                    class="text-danger">*</span></label>
                            <div class="select-type-v2">
                                <select aria-hidden="true" class="form-select form-select-lg" id="select_course" multiple placeholder="{{ __('select_courses') }}"
                                        name="course_id[]" data-route="{{ route('ajax.courses') }}">
                                    <option value="">{{ __('select_course') }}</option>
                                </select>
                                <div class="nk-block-des text-danger">
                                    <p class="course_id_error error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                </div>
            </form>
        </div>
    </div>
</div>
