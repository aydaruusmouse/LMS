@extends('backend.layouts.master')
@section('title', __('edit_role'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('edit_role')}}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <form action="{{ route('roles.update', $role->id)}}" class="form-validate form" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <div class="row gx-20">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <div class="select-type-v2">
                                        <label for="name" class="form-label mb-1">{{__('name')}}</label>
                                        <input class="form-control mb-3" type="text" name="name" id="name"
                                               placeholder="{{__('name') }}" value="{{ $role->name }}">
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
                                        <input class="form-control mb-3" type="text" name="slug" id="slug" value="{{ $role->slug }}"
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
                                                    <td><span class="text-capitalize">{{__($permission->name) }}</span>
                                                    </td>
                                                    <td>
                                                        @foreach($permission->keywords as $key=>$keyword)
                                                            <div class="custom-checkbox mb-2">
                                                                @if($keyword != "")
                                                                    <label>
                                                                        @if(!empty($role->permissions))
                                                                            <input type="checkbox" name="permissions[]"
                                                                                   value="{{$keyword}}"
                                                                                   id="{{$keyword}}" {{ in_array($keyword, $role->permissions)? 'checked':''}}>
                                                                        @else
                                                                            <input type="checkbox" name="permissions[]"
                                                                                   value="{{$keyword}}"
                                                                                   id="{{$keyword}}">
                                                                        @endif
                                                                        <span class="text-capitalize"
                                                                              for="{{$keyword}}">{{__($key)}}</span>
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

