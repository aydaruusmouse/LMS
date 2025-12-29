@extends('backend.layouts.master')
@section('title', __('server_information'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-lg-4 col-md-4">
                <h3 class="section-title">{{ __('server_information') }}</h3>
                <div class="bg-white redious-border py-3 py-sm-30 mb-30">
                    <div class="email-tamplate-sidenav">
                        <ul class="default-sidenav">
                            @if(hasPermission('system.info'))
                                <li>
                                    <a aria-current="page" href="{{ route('system.info') }}"
                                       class="{{ request()->route()->getName() == 'system.info' ? 'active' : '' }}">
                                        <span class="icon"><i class="las la-stream"></i></span>
                                        <span>{{ __('system_information') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if(hasPermission('server.info'))
                                <li>
                                    <a href="{{ route('server.info') }}"
                                       class="{{ request()->route()->getName() == 'server.info' ? 'active' : '' }}">
                                        <span class="icon"><i class="lar la-bell"></i></span>
                                        <span>{{ __('server_information') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if(hasPermission('extension.library'))
                                <li>
                                    <a href="{{ route('extension.library') }}"
                                       class="{{ request()->route()->getName() == 'extension.library' ? 'active' : '' }}">
                                        <span class="icon"><i class="las la-toggle-off"></i></span>
                                        <span>{{ __('extension_library') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if(hasPermission('file.system.permission'))
                                <li>
                                    <a href="{{ route('file.system.permission') }}"
                                       class="{{ request()->route()->getName() == 'file.system.permission' ? 'active' : '' }}">
                                        <span class="icon"><i class="las la-copy"></i></span>
                                        <span>{{ __('file_system_permission') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xxl-9 col-lg-8 col-md-8">
                <div class="row">
                    <div class="col-lg-12">
                        @if(request()->route()->getName() == 'server.info')
                            <h3 class="section-title">{{ __('server_information') }}</h3>
                        @elseif(request()->route()->getName() == 'extension.library')
                            <h3 class="section-title">{{ __('extension_library') }}</h3>
                        @elseif(request()->route()->getName() == 'file.system.permission')
                            <h3 class="section-title">{{ __('file_system_permission') }}</h3>
                        @else
                            <h3 class="section-title">{{ __('system_information') }}</h3>
                        @endif
                        <div class="bg-white redious-border p-20 p-sm-30">
                            <div class="default-list-table table-responsive">
                                @if(request()->route()->getName() == 'server.info')
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('config_name') }}</th>
                                            <th scope="col">{{ __('current') }}</th>
                                            <th scope="col">{{ __('recommended') }}</th>
                                            <th scope="col" class="text-end pe-5">{{ __('status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">01.</th>
                                            <td>
                                                {{__('file_uploads')}}
                                            </td>
                                            <td>{{ ini_get('file_uploads') == 1 ? 'On' : 'Off' }}</td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled id="checkbox1"
                                                           {{ ini_get('file_uploads') == 1 ? 'checked' : '' }} disabled>
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">02.</th>
                                            <td>
                                                {{__('max_file_uploads')}}
                                            </td>
                                            <td>{{ ini_get('max_file_uploads') }}</td>
                                            <td>20+</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox2" {{ ini_get('max_file_uploads') >= 20 ? 'checked' : '' }}>
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">03.</th>
                                            <td>
                                                {{ __('upload_max_file_size')}}
                                            </td>
                                            <td>{{ ini_get('upload_max_filesize')}}</td>
                                            <td>128M+</td>
                                            <td>
                                                @php
                                                    $upload_max_filesize = ini_get('upload_max_filesize');
                                                    if (preg_match('/^(\d+)(.)$/', $upload_max_filesize, $matches)) {
                                                        if ($matches[2] == 'G') {
                                                            $upload_max_filesize = $matches[1] * 1024 * 1024 * 1024; // nnnM -> nnn GB
                                                        } else if ($matches[2] == 'M') {
                                                            $upload_max_filesize = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
                                                        } else if ($matches[2] == 'K') {
                                                            $upload_max_filesize = $matches[1] * 1024; // nnnK -> nnn KB
                                                        }
                                                    }
                                                @endphp

                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox3" {{ $upload_max_filesize >= (128 * 1024 * 1024) ? 'checked' : '' }}>
                                                    <label for="checkbox3"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">04.</th>
                                            <td>
                                                {{__('post_max_size')}}
                                            </td>
                                            <td>{{ ini_get('post_max_size')}}</td>
                                            <td>128M+</td>
                                            <td>
                                                @php
                                                    $post_max_size = ini_get('post_max_size');
                                                    if (preg_match('/^(\d+)(.)$/', $post_max_size, $matches)) {
                                                        if ($matches[2] == 'G') {
                                                            $post_max_size = $matches[1] * 1024 * 1024 * 1024; // nnnM -> nnn GB
                                                        } else if ($matches[2] == 'M') {
                                                            $post_max_size = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
                                                        } else if ($matches[2] == 'K') {
                                                            $post_max_size = $matches[1] * 1024; // nnnK -> nnn KB
                                                        }
                                                    }
                                                @endphp
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox4" {{ $post_max_size >= (128 * 1024 * 1024) ? 'checked' : '' }}>
                                                    <label for="checkbox4"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">05.</th>
                                            <td>
                                                {{__('allow_url_fopen')}}
                                            </td>
                                            <td>{{ ini_get('allow_url_fopen') == 1 ? 'On' : 'Off' }}</td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox5" {{ ini_get('allow_url_fopen') == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox5"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">06.</th>
                                            <td>
                                                {{__('max_execution_time')}}
                                            </td>
                                            <td>{{ ini_get('max_execution_time') == '-1' ? __('unlimited') : ini_get('max_execution_time') }}</td>
                                            <td>600+</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox6" {{ ini_get('max_execution_time') == -1 || ini_get('max_execution_time') >= 600 ? 'checked' : '' }}>
                                                    <label for="checkbox6"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">07.</th>
                                            <td>
                                                {{__('max_input_time')}}
                                            </td>
                                            <td>{{ ini_get('max_input_time') == '-1' ? __('unlimited') : ini_get('max_input_time') }}</td>
                                            <td>120+</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox7" {{ ini_get('max_input_time') == -1 || ini_get('max_input_time') >= 120 ? 'checked' : '' }}>
                                                    <label for="checkbox7"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">08.</th>
                                            <td>
                                                {{__('max_input_vars')}}
                                            </td>
                                            <td>{{ ini_get('max_input_vars') }}</td>
                                            <td>1000+</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox8" {{ ini_get('max_input_vars') >= 1000 ? 'checked' : '' }}>
                                                    <label for="checkbox8"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">09.</th>
                                            <td>
                                                {{__('memory_limit')}}
                                            </td>
                                            <td>{{ ini_get('memory_limit') == '-1' ? __('unlimited') : ini_get('memory_limit') }}</td>
                                            <td>256M+</td>
                                            <td>
                                                @php
                                                    $memory_limit = ini_get('memory_limit');
                                                    if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
                                                        if ($matches[2] == 'G') {
                                                            $memory_limit = $matches[1] * 1024 * 1024 * 1024; // nnnM -> nnn GB
                                                        } else if ($matches[2] == 'M') {
                                                            $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
                                                        } else if ($matches[2] == 'K') {
                                                            $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
                                                        }
                                                    }
                                                @endphp
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox9" {{ ini_get('memory_limit') == -1 || $memory_limit >= (256 * 1024 * 1024) ? 'checked' : '' }}>
                                                    <label for="checkbox9"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                                @if(request()->route()->getName() == 'system.info')
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('name') }}</th>
                                            <th scope="col">{{ __('current_version') }}</th>
                                            <th scope="col">{{ __('required_version') }}</th>
                                            <th scope="col" class="text-end pe-5">{{ __('status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">01.</th>
                                            <td>
                                                PHP Version
                                            </td>
                                            <td>{{ phpversion() }}</td>
                                            <td>8.0 or Later</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox1" {{ floatval(phpversion()) >= 7.3 && floatval(phpversion()) < 9.0 ? 'checked' : '' }}>
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">02.</th>
                                            <td>
                                                MySQL
                                            </td>
                                            <td>
                                                @php
                                                    $results = DB::select( DB::raw("select version()") );
                                                    $mysql_version =  $results[0]->{'version()'};
                                                @endphp
                                                {{ $mysql_version }}
                                            </td>
                                            <td>5.7+</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox2" {{ $mysql_version >= 5.7 ? 'checked' : '' }}>
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                                @if(request()->route()->getName() == 'extension.library')
                                    @php
                                        $curl_success = false;
                                        $gd_success = false;
                                        $allow_url_fopen_success = false;
                                        $timezone_success = true;
                                        if (function_exists("curl_version")) :
                                            $curl_success = true;
                                        endif;
                                        //check gd
                                        if (extension_loaded('gd') && function_exists('gd_info')) :
                                            $gd_success = true;
                                        endif;
                                        //check allow_url_fopen
                                        if (ini_get('allow_url_fopen')) :
                                            $allow_url_fopen_success = true;
                                        endif;
                                        //check allow_url_fopen
                                        $timezone_settings = ini_get('date.timezone');
                                        if ($timezone_settings) :
                                            $timezone_success = true;
                                        endif;
                                    @endphp

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('extension_settings') }}</th>
                                            <th scope="col">{{ __('current_settings') }}</th>
                                            <th scope="col">{{ __('required_settings') }}</th>
                                            <th scope="col" class="text-end pe-5">{{ __('status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">01.</th>
                                            <td>
                                                GD
                                            </td>
                                            <td>{{ $gd_success ? 'On' : 'Off' }}</td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox1" {{ $gd_success ? 'checked' : '' }}>
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">02.</th>
                                            <td>
                                                cURL
                                            </td>
                                            <td>{{ $curl_success ? 'On' : 'Off'}}</td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox2" {{ $curl_success ? 'checked' : 'off'}}>
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">03.</th>
                                            <td>
                                                allow_url_fopen
                                            </td>
                                            <td>{{ $allow_url_fopen_success ? 'on' : 'off' }}</td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox3" {{ $allow_url_fopen_success ? 'checked' : '' }}>
                                                    <label for="checkbox3"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">04.</th>
                                            <td>
                                                zip
                                            </td>
                                            <td>{{ extension_loaded('zip') ? 'On' : 'Off' }}</td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox4" {{ extension_loaded('zip') ? 'checked' : '' }}>
                                                    <label for="checkbox4"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">05.</th>
                                            <td>
                                                zlib
                                            </td>
                                            <td>{{ extension_loaded('zlib') ? 'On' : 'Off' }}</td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox5" {{ extension_loaded('zlib') ? 'checked' : '' }}>
                                                    <label for="checkbox5"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">06.</th>
                                            <td>
                                                OpenSSL PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if( OPENSSL_VERSION_NUMBER < 0x009080bf)
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @else
                                                    On
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox6" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox6"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">07.</th>
                                            <td>
                                                PDO PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if(PDO::getAvailableDrivers())
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox7" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox7"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">08.</th>
                                            <td>
                                                BCMath PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if(extension_loaded('bcmath'))
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox8" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox8"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">09.</th>
                                            <td>
                                                Ctype PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if(extension_loaded('ctype'))
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox9" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox9"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">10.</th>
                                            <td>
                                                Fileinfo PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if(extension_loaded('fileinfo'))
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox10" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox10"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">11.</th>
                                            <td>
                                                Mbstring PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if(extension_loaded('mbstring'))
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox11" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox11"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">12.</th>
                                            <td>
                                                Tokenizer PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if(extension_loaded('tokenizer'))
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox12" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox12"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">13.</th>
                                            <td>
                                                XML PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if(extension_loaded('xml'))
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox13" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox13"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">14.</th>
                                            <td>
                                                JSON PHP Extension
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp

                                                @if(extension_loaded('json'))
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox14" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox14"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">15.</th>
                                            <td>
                                                PHP ZipArchive Class
                                            </td>
                                            <td>
                                                @php $all_requirement_success = true; @endphp
                                                @if(class_exists('ZipArchive'))
                                                    On
                                                @else
                                                    @php $all_requirement_success = false; @endphp
                                                    Off
                                                @endif
                                            </td>
                                            <td>On</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" disabled
                                                           id="checkbox15" {{ $all_requirement_success ? 'checked' : '' }}>
                                                    <label for="checkbox15"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                                @if(request()->route()->getName() == 'file.system.permission')
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{__('file_or_folder')}}</th>
                                            <th scope="col" class="text-end pe-5">{{__('status')}}</th>
                                        </tr>
                                        </thead>
                                        @php
                                            $required_paths = ['.env','app','bootstrap/cache','storage','resources','routes']
                                        @endphp
                                        <tbody>
                                        @foreach ($required_paths as $key=> $path)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $path }}</td>
                                                <td>
                                                    <div class="setting-check">
                                                        <input type="checkbox" disabled
                                                               id="checkbox1" {{ is_writable(base_path($path)) ? 'checked' : '' }}>
                                                        <label for="checkbox1"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
