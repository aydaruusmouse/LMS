@if(count($comments) > 0)
    <ul class="comments-list active">
        @foreach($comments as $comment)
            <li class="comment">
                <div class="comment-body">
                    <div class="avatar">
                        <img src="{{ getFileLink('80x80',$comment->user->images) }}"
                             alt="{{ $comment->user->name }}">
                    </div>
                    <div class="comment-content">
                        <div class="author-name-wrapper">
                            <h5 class="author-name">
                                {{ $comment->user->name }}
                                <span class="author-role">{{ ucwords($comment->user->user_type) }}</span>
                            </h5>
                            <span class="date">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                        </div>
                        <p>{{ $comment->comment }}</p>
                    </div>
                </div>

                <div class="less-more reply_for_{{ $comment->id }}">
                    @if($comment->replies_count > 0)
                        <button class="load_replies less-more-btn"
                                data-comment_id="{{ $comment->id }}">{{ $comment->replies_count }} {{ __('replies') }}</button>
                        @include('components.frontend_loading_btn', ['class' => 'less-more-btn'])
                    @endif
                </div>

                <form class="reply ajax_form" action="{{ route('blog.comment.reply') }}" method="POSt"
                      data-fetch_reply=".reply_for_{{ $comment->id }}">@csrf
                    <input type="hidden" name="blog_id" value="{{ $comment->blog_id }}">
                    <input type="hidden" name="blog_comment_id" value="{{ $comment->id }}">
                    <textarea name="reply" placeholder="{{ __('reply') }}"></textarea>
                    <button type="submit" class="template-btn mb-3">{{ __('post') }}</button>
                    @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                </form>
            </li>
        @endforeach
    </ul>
    @if($comments->nextPageUrl())
        <div class="less-more m-t-30">
            <a data-page="{{ $comments->currentPage() }}" data-url="{{ $comments->nextPageUrl() }}"
               href="javascript:void(0)"
               class="less-more-btn load_more">{{__('load_more') }}</a>
            @include('components.frontend_loading_btn', ['class' => 'less-more-btn comment_load_more'])
        </div>
    @endif
@endif
