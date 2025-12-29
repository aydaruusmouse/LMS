<section class="featured-news-section color-bg-off-white p-t-80 p-b-50 p-t-sm-40 p-b-sm-20">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="common-heading text-center m-b-40">
                    <h3>{{__($section->contents['title']) }}</h3>
                    <p>{{__($section->contents['sub_title']) }}</p>
                </div>
            </div>
        </div>
        <div class="row blog-post-items-v3">
            @if(count($blogs))
                @foreach($blogs as $key =>$blog)
                    @include('frontend.blogs.component')
                @endforeach
            @else
                @include('frontend.not_found',$data=['title'=> 'blog'])
            @endif
        </div>
    </div>
</section>
