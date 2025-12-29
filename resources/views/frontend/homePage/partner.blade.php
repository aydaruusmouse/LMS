@if(is_null($partners) != true)
    <section class="brands-section p-t-80 p-b-50 p-t-sm-40 p-b-sm-35">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="common-heading text-center m-b-50 m-b-sm-30">
                        <h3 class="fw-semibold">{{__($section->contents['title']) }}</h3>
                        <p>{{__($section->contents['sub_title']) }}</p>
                    </div>
                </div>
            </div>
            <div class="row gx-3 gx-md-4 brand-items-v2 justify-content-center">
                @if(count($partners)>0)
                    @foreach($partners as $partner)
                        <div class="col-3">
                            <a href="#" class="brand-item">
                                <img src="{{ getFileLink('195x34', $partner->logo) }}" alt="partner_logo">
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-6">
                        @include('frontend.not_found',$data=['title'=> 'partner'])
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
