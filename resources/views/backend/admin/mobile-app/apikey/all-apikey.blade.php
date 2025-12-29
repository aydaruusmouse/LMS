@extends('backend.layouts.master')
@section('title', __('api_setting'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('api_setting') }}</h3>
                    <div class="bg-white rounded-20 p-20 p-sm-30">
                        <div class="row">
                            <div class="col-12">
                                <div class="base-upload-link mb-30">
                                    <label for="baseURL" class="form-label mb-1">{{__('api_url')}}</label>
                                    <input type="url" class="form-control rounded-2" id="baseURL" placeholder=""
                                           value="{{ url('/api') }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h6 class="sub-title">{{ __('app_keys') }}</h6>
                                @if(hasPermission('apikeys.create'))
                                    <div class="oftions-content-right mb-20">
                                        <a href="{{ route('apikeys.create') }}" class="button-default gap-2">
                                            <i class="las la-plus"></i>
                                            <span> {{__('add_api_key') }} </span>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-12">
                                <div class="default-list-table table-responsive apk-setting">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{__('title') }}</th>
                                            <th scope="col">{{__('key') }}</th>
                                            <th scope="col">{{__('option') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($api_keys as $key=> $api_key)
                                            <tr>
                                                <th>{{ ++$key }}</th>
                                                <td>{{ $api_key->api_title ? : $api_key->title }}</td>
                                                <td>
                                                    <div class="user-password">
                                                        <input class="passField" type="password" readonly=""
                                                               value="{{ $api_key->key }}">
                                                        @if(!config('app.demo_mode'))
                                                            <label for="password3" class="toggle-password"><i
                                                                    class="lar la-eye"></i></label>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if(hasPermission('apikeys.revoke') || hasPermission('apikeys.edit'))
                                                        <ul class="d-flex gap-30 justify-content-end">
                                                            @if(hasPermission('apikeys.revoke'))
                                                                <li>
                                                                    @if($api_key->status == 1)
                                                                        <a href="javascript:void(0)"
                                                                           onclick="delete_row('apikeys/revoke',{{ $api_key->id }},null,true)"
                                                                           data-toggle="tooltip"
                                                                           data-original-title="{{ __('Delete') }}"><span
                                                                                class="title">{{ __('revoke') }}</span></a></a>
                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           onclick="delete_row('apikeys/revoke',{{ $api_key->id }},null,true)"
                                                                           data-toggle="tooltip"
                                                                           data-original-title="{{ __('Delete') }}"><span
                                                                                class="title">{{ __('inactive') }}</span></a></a>
                                                                    @endif
                                                                </li>
                                                            @endif
                                                            @if(hasPermission('apikeys.edit'))
                                                                <li><a href="{{ route('apikeys.edit', $api_key->id) }}"><i
                                                                            class="las la-edit"></i></a></li>
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
                        @if($api_keys->total() > 0)
                            <div class="pagination pt-20">
                                <div class="container-fluid">
                                    <div class="row align-items-center justify-content-between">

                                        <div class="col-lg-6 col-sm-6">
                                            <div class="pagination-content-left">
                                                {{ __('showing') }} {{ $api_keys->firstItem() }} {{ __('to') }} {{ $api_keys->lastItem() }} {{ __('of') }} {{ $api_keys->total() }}
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-6">
                                            <div class="pagination-content-right d-sm-flex justify-content-end">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        {{ $api_keys->links('vendor.pagination.bootstrap-4') }}
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
@endsection
@include('backend.admin.mobile-app.apikey.revoke-script')
@include('backend.common.change-status-script')
