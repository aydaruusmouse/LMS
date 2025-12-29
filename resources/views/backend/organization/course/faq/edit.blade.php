<form action="{{ route('organization.faqs.update',$faq->id) }}" method="POST" class="form">
    @csrf
    @method('PUT')
    <input type="hidden" name="course_id" value="{{ $faq->course_id }}">
    <input type="hidden" class="is_modal" value="0">
    <div class="row gx-20">
        <div class="col-12">
            <div class="mb-4">
                <label for="question" class="form-label">{{__('question') }}</label>
                <input type="text" class="form-control rounded-2" id="question"
                       placeholder="{{ __('enter_question') }}" name="question" value="{{ $faq->question }}">
                <div class="nk-block-des text-danger">
                    <p class="question_error error"></p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="editor-wrapper mb-4">
                <label for="answer" class="form-label">{{__('answer') }}</label>
                <textarea class="summernote" id="answer"
                          placeholder="{{ __('enter_answer') }}" name="answer">{{ $faq->answer }}</textarea>
                <div class="nk-block-des text-danger">
                    <p class="answer_error error"></p>
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
