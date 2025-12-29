@if($blog->status == 'published')
    <span class="badge badge-success">{{ __('published') }}</span>
@elseif($blog->status == 'draft')
    <span class="badge badge-primary">{{ __('draft') }}</span>
@elseif($blog->status == 'pending')
    <span class="badge badge-warning">{{ __('pending') }}</span>
@endif
