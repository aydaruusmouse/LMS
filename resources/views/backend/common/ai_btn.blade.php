@if(setting('ai_secret_key'))
    <div class="ai_btn_page">
        <a href="javascript:void(0)" data-url="{{ route('ai.content') }}" class="ai_writer d-block text-right"
           data-name="{{ $name }}"
           data-length="{{ $length }}" data-use_case="{{ $use_case }}" data-topic="{{ $topic }}"
           data-extra_query="{{ isset($long_description) ? 1 : '' }}">
            <span class="a_writer_text">{{ __('use_ai_writer_to_generate_content') }}</span>
            <span class="a_writer_loader d-none"><i class="las la-spinner la-spin"></i></span>
        </a>
    </div>
@endif
