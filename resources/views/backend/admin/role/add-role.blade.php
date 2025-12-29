@extends('backend.layouts.master')
@section('title', __('add_role'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('add_role')}}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <form action="{{ route('roles.store')}}" class="form-validate form" method="POST">
                        @csrf
                        <div class="row gx-20">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <div class="select-type-v2">
                                        <label for="name" class="form-label mb-1">{{__('name')}}</label>
                                        <input class="form-control mb-3" type="text" name="name" id="name"
                                               placeholder="{{__('name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="name_error error">{{ $errors->first('name') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <div class="select-type-v2">
                                        <label for="slug" class="form-label mb-1">{{__('slug')}}</label>
                                        <input class="form-control mb-3" type="text" name="slug" id="slug"
                                               placeholder="{{__('slug') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="slug_error error">{{ $errors->first('slug') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="staff-role-heigh simplebar">
                                    <div class="default-list-table table-responsive staff-role-table">
                                        <table class="table table">
                                            <tbody>
                                            @foreach($pemissions as $permission)
                                                <tr>
                                                    <td><span class="text-capitalize">{{__($permission->name) }}</span></td>
                                                    <td>
                                                        @foreach($permission->keywords as $key=>$keyword)
                                                            <div class="custom-checkbox mb-2">
                                                                @if($keyword != "")
                                                                    <label  for="{{$keyword}}">
                                                                        <input type="checkbox" name="permissions[]"
                                                                               value="{{$keyword}}" id="{{$keyword}}">
                                                                        <span class="text-capitalize">{{__($key)}}</span>
                                                                    </label>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Permissions Tab====== -->
                        <div class="d-flex justify-content-between align-items-center mt-40">
                            <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                            @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

