@extends('frontend.layouts.base')
@section('base.content')
    @include('frontend.layouts.header.' . $section['header'])
    @yield('content')
    @include('frontend.homePage.cta')
    @include('frontend.layouts.footer')
@endsection
