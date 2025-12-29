@extends('backend.layouts.master')
@section('title', __('blog_category'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{__('blog_category') }}</h3>
                        @if(hasPermission('blog-categories.create'))
                            <div class="oftions-content-right mb-12">
                                <a href="{{ route('blog-categories.create') }}"
                                   class="d-flex align-items-center btn sg-btn-primary gap-2">
                                    <i class="las la-plus"></i>
                                    <span>{{__('create_new_category') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="default-list-table table-responsive apk-setting">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('title') }}</th>
                                <th scope="col">{{__('slug') }}</th>
                                <th scope="col">{{__('status') }}</th>
                                <th scope="col">{{__('option') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key=> $category)
                                <tr>
                                    <th>{{ ++$key }}</th>
                                    <td>{{ $category->lang_title }}</td>
                                    <td>{{ $category->slug }}</a></td>
                                    <td>
                                        @if(hasPermission('blog-categories.edit'))
                                            <div class="setting-check">
                                                <input type="checkbox" class="status-change"
                                                       {{ ($category->status == 1) ? 'checked' : '' }} data-id="{{ $category->id }}"
                                                       value="blog-category-status/{{$category->id}}"
                                                       id="customSwitch2-{{$category->id}}">
                                                <label for="customSwitch2-{{ $category->id }}"></label>
                                            </div>
                                        @endif

                                    </td>
                                    <td class="action-card">
                                        <ul class="d-flex gap-30 justify-content-end">
                                            @if(hasPermission('blog-categories.edit'))
                                                <li>
                                                    <a href="{{ route('blog-categories.edit',$category->id) }}"><i
                                                            class="las la-edit"></i></a>
                                                </li>
                                            @endif
                                            @if(hasPermission('blog-categories.destroy'))
                                                <li>
                                                    <a href="javascript:void(0)"
                                                       onclick="delete_row('{{ route('blog-categories.destroy', $category->id) }}',null,true)"
                                                       data-toggle="tooltip"
                                                       data-original-title="{{ __('delete') }}"><i
                                                            class="las la-trash-alt"></i></a>
                                                </li>
                                            @endif
                                        </ul>
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
            @if($categories->total() > 0)
                <div class="pagination pt-20">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-between">

                            <div class="col-lg-6 col-sm-6">
                                <div class="pagination-content-left">
                                    {{ __('showing') }} {{ $categories->firstItem() }} {{ __('to') }} {{ $categories->lastItem() }} {{ __('of') }} {{ $categories->total() }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="pagination-content-right d-sm-flex justify-content-end">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            {{ $categories->links('vendor.pagination.bootstrap-4') }}
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
