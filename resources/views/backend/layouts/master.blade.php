@extends('backend.layouts.base')
@section('base.content')
    @if (Auth::check() && auth()->user()->role_id == 2)
        @include('backend.instructor.partials.sidebar')
    @elseif (Auth::check() && auth()->user()->role_id == 5)
        @include('backend.organization.partials.sidebar')
    @else
        @include('backend.layouts.sidebar')
    @endif
    <main class="main-wrapper">
        @if (Auth::check() && auth()->user()->role_id == 2)
            @include('backend.instructor.partials.header')
        @elseif (Auth::check() && auth()->user()->role_id == 5)
            @include('backend.organization.partials.header')
        @else
            @include('backend.layouts.header')
        @endif
        <div class="main-content-wrapper">
            @yield('content')
        </div>
    </main>
    @include('backend.layouts.footer')
@endsection
