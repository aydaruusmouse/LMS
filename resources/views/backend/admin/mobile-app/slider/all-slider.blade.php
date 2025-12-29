@extends('backend.layouts.master')
@section('title', __('slider'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('slider_setting') }}</h3>
                        @if(hasPermission('sliders.create'))
                            <div class="oftions-content-right mb-20">
                                <a href="{{ route('sliders.create') }}"
                                   class="d-flex align-items-center btn sg-btn-primary gap-2">
                                    <i class="las la-plus"></i>
                                    <span>{{__('add') }} {{__('new_slider') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <div class="default-list-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('s_no') }}</th>
                                    <th scope="col">{{__('order') }}</th>
                                    <th scope="col">{{__('image') }}</th>
                                    <th scope="col">{{__('action_type') }}</th>
                                    <th scope="col">{{__('status') }}</th>
                                    <th scope="col" class="text-end">{{__('option') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <th>{{ $sl++ }}</th>
                                        <td>{{ $slider->order_no }}</td>
                                        <td>
                                            <div class="app-img">
                                                <img src="{{ getFileLink('68x48',$slider->image) }}"
                                                     alt="{{__($slider->title) }}">
                                            </div>
                                        </td>
                                        <td>{{__($slider->source) }}</td>
                                        <td>
                                            @if(hasPermission('sliders.edit'))
                                                <div class="setting-check">
                                                    <input type="checkbox" class="status-change"
                                                           {{ ($slider->status == 1) ? 'checked' : '' }} data-id="{{ $slider->id }}"
                                                           value="slider-status/{{$slider->id}}"
                                                           id="customSwitch2-{{$slider->id}}">
                                                    <label
                                                        for="customSwitch2-{{ $slider->id }}"></label>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="action-card">
                                            @if(hasPermission('sliders.edit') || hasPermission('sliders.destroy'))
                                                <ul class="d-flex gap-30 justify-content-end">
                                                    @if(hasPermission('sliders.edit'))
                                                        <li><a href="{{ route('sliders.edit', $slider->id) }}"><i
                                                                    class="las la-edit"></i></a></li>
                                                    @endif
                                                    @if(hasPermission('sliders.destroy'))
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                               onclick="delete_row('{{ route('sliders.destroy', $slider->id) }}',null,true)"
                                                               data-toggle="tooltip"
                                                               data-original-title="{{ __('delete') }}"><i
                                                                    class="las la-trash-alt"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination_container">
                @if($sliders->total() > 0)
                    <div class="pagination pt-20">
                        <div class="container-fluid">
                            <div class="row align-items-center justify-content-between">

                                <div class="col-lg-6 col-sm-6">
                                    <div class="pagination-content-left">
                                        {{ __('showing') }} {{ $sliders->firstItem() }} {{ __('to') }} {{ $sliders->lastItem() }} {{ __('of') }} {{ $sliders->total() }}
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <div class="pagination-content-right d-sm-flex justify-content-end">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $sliders->links('vendor.pagination.bootstrap-4') }}
                                            </ul>
                                        </nav>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- End Oftions Section -->
@endsection
@include('backend.common.delete-script')
