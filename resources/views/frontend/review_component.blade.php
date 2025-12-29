@php
    $user = $review->user;
@endphp
<li class="comment p-0 mb-3 mb-md-4">
    <div class="comment-body">
        <div class="avatar">
            <img src="{{ $user->profile_pic }}" alt="comment author">
        </div>
        <div class="comment-content">
            <div class="author-name-wrapper m-0">
                <h5 class="author-name">{{ $user->name }}</h5>
                <span class="date">{{ Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</span>
            </div>
            <div class="d-flex m-b-10">
                <span class="author-role">{{ $user->tagline }}</span>
                <div class="rating-review review_list all-rating star-5" data-rating="{{ round($review->rating,2) }}"></div>
            </div>
            <p>{{ $review->comment }}</p>
        </div>
    </div>
</li>
