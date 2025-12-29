<div class="col-sm-6">
    <div class="blog-post-item">
        <div class="post-thumbnail">
            <a href="{{route('blog-details',['slug'=>$blog->slug])}}">
                <img src="{{ getFileLink('402x248', $blog->image) }}"
                     alt="Blog Thumbnail">
            </a>
            <ul class="post-meta">
                <li class="date"><a href="{{route('blog-details',['slug'=>$blog->slug])}}"><i class="fal fa-calendar"></i>{{ Carbon\Carbon::parse($blog->published_date)->format('d M Y') }}</a></li>
            </ul>
        </div>
        <div class="post-content">
            <h4 class="title">
                <a href="{{route('blog-details',['slug'=>$blog->slug])}}">{{ $blog->title }}</a>
            </h4>
            <p class="content">
                {{ $blog->short_description }}
            </p>
            <div class="post-meta-wrapper">
                <div class="left-content">
                    <ul class="post-meta">
{{--                        <li><a href="#"><i class="fal fa-comment-alt"></i> 203</a></li>--}}
                        <li><a href="{{route('blog-details',['slug'=>$blog->slug])}}"><i class="fal fa-user"></i> By {{$blog->user->user_type}}</a></li>
                    </ul>
                </div>
                <div class="right-content">
                    <a href="{{route('blog-details',['slug'=>$blog->slug])}}" class="read-more-btn">{{__('read_more')}} <i class="fas fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
