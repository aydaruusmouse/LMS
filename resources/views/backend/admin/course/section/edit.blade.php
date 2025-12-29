<form action="{{ route('sections.update',$section->id) }}" method="POST" class="form" id="form">
    @csrf
    @method('PUT')
    <input type="hidden" name="course_id" value="{{ $section->course_id }}">
    <input type="hidden" class="is_modal" value="0">
    <div class="row gx-20">
        <div class="col-12">
            <div class="mb-4">
                <label for="section_title" class="form-label">{{__('title') }}</label>
                <input type="text" class="form-control rounded-2 currency_name" id="section_title"
                       placeholder="{{ __('enter_title') }}" name="title" value="{{ $section->title }}">
                <div class="nk-block-des text-danger">
                    <p class="title_error error"></p>
                </div>
            </div>
        </div>
        <!-- End Currency Name -->

    </div>
    <!-- END Permissions Tab====== -->
    <div class="d-flex justify-content-end align-items-center mt-30">
        <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
    </div>
</form>
