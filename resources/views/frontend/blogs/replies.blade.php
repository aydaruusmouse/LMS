@if(count($replies) > 0)
    <ul class="children">
        @foreach($replies as $reply)
            <li class="mb-2">
                <div class="comment-body">
                    <div class="avatar">
                        <img src="{{ getFileLink('80x80',$reply->user->images) }}"
                             alt="{{ $reply->user->name }}">
                    </div>
                    <div class="comment-content">
                        <div class="author-name-wrapper">
                            <h5 class="author-name">
                                {{ $reply->user->name }}
                                <span class="author-role">{{ ucwords($reply->user->user_type) }}</span>
                            </h5>
                            <span class="date">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</span>
                        </div>
                        <p>{{ $reply->reply }}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif

