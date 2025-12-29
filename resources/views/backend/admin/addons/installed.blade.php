@extends('backend.layouts.master')
@section('title', __('installed_addons'))
@section('content')
    <!-- Installed Addons -->
    <div class="container-fluid">
        <div class="row gx-20">
            <div class="col-lg-12">
                <div class="d-flex align-items-center justify-content-between mb-12">
                    <h3 class="section-title">{{__('installed_addons')}}</h3>
                    @if(hasPermission('addon.create'))
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addon_upload"
                           class="d-flex align-items-center btn sg-btn-primary gap-2">
                            <i class="las la-plus"></i>
                            <span>{{ __('upload') }}</span>
                        </a>
                    @endif
                </div>

                <div class="bg-white redious-border p-20 p-md-30">
                    <div class="row mb-30">
                        <div class="col-lg-12">
                            <div class="default-list-table table-responsive installed-addons-table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{__('plugin')}}</th>
                                        <th scope="col">{{__('description')}}</th>
                                        <th scope="col">{{__('activation')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($addons as $key=> $addon)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $addon->name }}</td>
                                            <td>
                                                {{ $addon->description }}
                                                <ul class="d-flex align-items-center">
                                                    <li>Version {{ $addon->version }}</li>
                                                    <li>By <a href="#" class="text-primary">SpaGreen</a></li>
                                                    <li><a href="#" class="text-primary">{{__('view_details')}}</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                @if(hasPermission('addon.edit'))
                                                    <div class="d-flex gap-12">
                                                        <div class="setting-check">
                                                            <input type="checkbox" class="status-change"
                                                                   {{ $addon->status == 1 ? 'checked' : '' }} data-id="{{ $addon->id }}"
                                                                   value="addon-status/{{$addon->id}}"
                                                                   id="customSwitch2-{{$addon->id}}">
                                                            <label for="customSwitch2-{{$addon->id}}"></label>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($addons->total() > 0)
                        <div class="row align-items-center justify-content-between mt-30">
                            <div class="col-lg-6 col-sm-6">
                                <div class="pagination-content-left">
                                    {{ __('showing') }} {{ $addons->firstItem() }} {{ __('to') }} {{ $addons->lastItem() }} {{ __('of') }} {{ $addons->total() }}
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="pagination-content-right d-sm-flex justify-content-end">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            {{ $addons->links('vendor.pagination.bootstrap-4') }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- End Pagination -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addon_upload" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <h6 class="sub-title">{{ __('install_or_update_addon') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form action="{{ route('addon.store') }}" method="post" class="form" enctype="multipart/form-data">@csrf
                    <div class="row gx-20">
                        <input type="hidden" name="is_modal" class="is_modal" value="0">
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label">{{ __('purchase_code') }}</label>
                                <input type="text" class="form-control rounded-2" name="purchase_code"
                                       placeholder="{{ __('enter_purchase_code') }}">
                                <div class="nk-block-des text-danger">
                                    <p class="purchase_code_error error"></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <label for="addon_file" class="form-label">{{ __('addon_file') }}</label>
                                <input type="file" class="form-control rounded-2" name="addon_zip_file" id="addon_file">
                                <div class="nk-block-des text-danger">
                                    <p class="addon_file_error error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-30">
                        <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                        @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
