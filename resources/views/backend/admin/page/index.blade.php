@extends('backend.layouts.master')
@section('title', __('all_pages'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('all_pages') }}</h3>
                        @if(hasPermission('pages.create'))
                            <div class="oftions-content-right mb-20">
                                <a href="{{ route('pages.create') }}"
                                   class="d-flex align-items-center btn sg-btn-primary gap-2">
                                    <i class="las la-plus"></i>
                                    <span> {{__('create_new_page') }} </span>
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
                                    <th scope="col">{{__('link') }}</th>
                                    <th scope="col">{{__('status') }}</th>
                                    <th scope="col">{{__('option') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pages as $key=> $page)
                                    <tr>
                                        <th>{{ ++$key }}</th>
                                        <td>{{ $page->lang_title }}</td>
                                        @if($page->id == 7)
                                            <td><a target="_blank"
                                                   href="{{ url($page->link) }}">{{ url($page->link) }}</a>
                                            </td>
                                        @else
                                            <td><a target="_blank"
                                                   href="{{ url('page/'.$page->link) }}">{{ url('page/'.$page->link) }}</a>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="setting-check">
                                                <input type="checkbox" class="status-change"
                                                       {{ ($page->status == 1) ? 'checked' : '' }} data-id="{{$page->id}}"
                                                       value="pages-status/{{$page->id}}"
                                                       id="customSwitch2-{{$page->id}}">
                                                <label for="customSwitch2-{{ $page->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="action-card">
                                            @if(hasPermission('pages.edit') || (hasPermission('pages.destroy') && $page->type == "custom_page"))
                                                <ul class="d-flex gap-30 justify-content-end">
                                                    @if(hasPermission('pages.edit'))
                                                        <li>
                                                            <a href="{{ route('pages.edit',$page->id) }}"><i
                                                                    class="las la-edit"></i></a>
                                                        </li>
                                                    @endif
                                                    @if(hasPermission('pages.destroy') && $page->type == "custom_page")
                                                        <li>
                                                            <a href="javascript:void(0)"
                                                               onclick="delete_row('{{ route('pages.destroy', $page->id) }}',null,true)"
                                                               data-toggle="tooltip"
                                                               data-original-title="{{ __('delete') }}"><i
                                                                    class="las la-trash-alt"></i></a>
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
                @if($pages->total() > 0)
                    <div class="pagination pt-20">
                        <div class="container-fluid">
                            <div class="row align-items-center justify-content-between">

                                <div class="col-lg-6 col-sm-6">
                                    <div class="pagination-content-left">
                                        {{ __('showing') }} {{ $pages->firstItem() }} {{ __('to') }} {{ $pages->lastItem() }} {{ __('of') }} {{ $pages->total() }}
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <div class="pagination-content-right d-sm-flex justify-content-end">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $pages->links('vendor.pagination.bootstrap-4') }}
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
@include('backend.common.delete-script')
