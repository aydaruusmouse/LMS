@php
    $page = App\Models\Page::with('language')->find(403);
@endphp
@extends($page ? 'frontend.layouts.master' : 'errors::minimal')
@if($page)
    @section('content')
        <section class="error-section">
            <div class="container container-1278">
                <div class="row align-items-center justify-content-center text-center vh-100">
                    <div class="col-lg-8 col-md-10 col-sm-10">
                        <div class="error-page-title">
                            <h1 class="m-b-65 m-b-md-30 m-b-sm-20"><span>403</span></h1>
                            <h2 class="m-b-15">{{ $page->lang_title }}</h2>
                            <p class="m-b-55 m-b-md-30 m-b-sm-20">{{ $page->lang_content }}</p>
                            <a href="{{ url('/') }}" class="template-btn">
                                {{__('back_to_homepage')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
@else
    @section('title', __('403 Forbidden'))
    @section('code', '403')
    @section('message', __('403 Forbidden'))
@endif
