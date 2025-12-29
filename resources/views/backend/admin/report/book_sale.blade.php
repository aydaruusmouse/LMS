@extends('backend.layouts.master')
@section('content')
    <!-- Book List -->
    <div class="container-fluid">
        <div class="row gx-20">
            <div class="col-lg-12">
                <h3 class="section-title">{{__('book_sale')}}</h3>
                <div class="bg-white redious-border p-20 p-sm-30 mb-4">
                    <div class="selection-row gx-20">
                        <div class="col-custom">
                            <div class="select-type-v2">
                                <label for="course" class="form-label">{{__('top_rated')}}</label>
                                <select id="course" class="form-select form-select-lg mb-3 without_search"
                                        aria-label=".form-select-lg example">
                                    <option selected>{{__('all')}}</option>
                                    <option value="1">Marketing</option>
                                    <option value="2">Design</option>
                                    <option value="3">Development</option>
                                    <option value="4">SEO</option>
                                    <option value="4">Programming</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Course -->

                        <div class="col-custom">
                            <div class="select-type-v2">
                                <label for="categories" class="form-label">{{__('categories')}}</label>
                                <select id="categories" class="form-select form-select-lg mb-3 without_search"
                                        aria-label=".form-select-lg example">
                                    <option selected>{{__('all')}}</option>
                                    <option value="1">Marketing</option>
                                    <option value="2">Design</option>
                                    <option value="3">Development</option>
                                    <option value="4">SEO</option>
                                    <option value="4">Programming</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Categories -->

                        <div class="col-custom">
                            <div class="select-type-v2">
                                <label for="organisation" class="form-label">{{__('select_writer')}}</label>
                                <select id="organisation" class="form-select form-select-lg mb-3 without_search"
                                        aria-label=".form-select-lg example">
                                    <option selected>{{__('all')}}</option>
                                    <option value="2">Cameron Williamson</option>
                                    <option value="3">Leslie Alexander</option>
                                    <option value="4">Kristin Watson</option>
                                    <option value="1">Brooklyn Simmons</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Organisation -->

                        <div class="col-custom">
                            <div class="select-type-v2">
                                <label for="ReportDataRange" class="form-label">{{__('select_new')}}</label>
                                <select id="ReportDataRange" class="form-select form-select-lg mb-3 without_search"
                                        aria-label=".form-select-lg example">
                                    <option selected>{{__('all')}}</option>
                                    <option value="2">New</option>
                                    <option value="3">Last 7 days</option>
                                    <option value="4">Last 15 Days</option>
                                    <option value="1">Last 1 Month</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Data Range -->
                        <div class="col-custom">
                            <button type="button" class="btn sg-btn-primary py-2 w-100 mt-30">{{__('filter')}}</button>
                        </div>
                    </div>
                </div>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <div class="row mb-30">
                        <div class="col-lg-6 col-md-6">
                            <div class="oftions-content-left">
                                <form action="#" class="">
                                    <div class="select-type-v2 d-flex align-items-center gap-20">
                                        <label for="dataRange" class="order-1">{{__('book_per_page')}}</label>
                                        <select name="dataRange" id="dataRange" class="form-select without_search"
                                                aria-label=".form-select-lg example">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="oftions-content-right mb-20 mt-3 mt-md-0">
                                <form action="#" class="oftions-content-search">
                                    <input type="search" name="search" id="search" placeholder="{{__('search')}}">
                                    <button type="submit"><img src={{url("public/admin/img/icons/search.svg")}} alt="Search">
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="default-list-table table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{__('book_name')}}</th>
                                        <th scope="col">{{__('writer_name')}}</th>
                                        <th scope="col">{{__('category')}}</th>
                                        <th scope="col">{{__('organisation')}}</th>
                                        <th scope="col">{{__('total_sale')}}</th>
                                        <th scope="col" class="text-start">{{__('earning_amount')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">01.</th>
                                        <td>Digital Marketing</td>
                                        <td>Cameron Williamson</td>
                                        <td>Marketing</td>
                                        <td>Albert Flores</td>
                                        <td>402</td>
                                        <td class="text-start">$5421.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">02.</th>
                                        <td>UI/UX Design</td>
                                        <td>Leslie Alexander</td>
                                        <td>Design</td>
                                        <td>Jane Cooper</td>
                                        <td>203</td>
                                        <td class="text-start">$6524.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.</th>
                                        <td>Graphic Design</td>
                                        <td>Kristin Watson</td>
                                        <td>Design</td>
                                        <td>Kristin Watson</td>
                                        <td>254</td>
                                        <td class="text-start">$2458.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">04.</th>
                                        <td>Web Design</td>
                                        <td>Brooklyn Simmons</td>
                                        <td>Design</td>
                                        <td>Devon Lane</td>
                                        <td>145</td>
                                        <td class="text-start">$3254.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">05.</th>
                                        <td>Web Developer</td>
                                        <td>Albert Flores</td>
                                        <td>Development</td>
                                        <td>Esther Howard</td>
                                        <td>215</td>
                                        <td class="text-start">$6457.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">06.</th>
                                        <td>Email Marketing</td>
                                        <td>Guy Hawkins</td>
                                        <td>Marketing</td>
                                        <td>Jenny Wilson</td>
                                        <td>245</td>
                                        <td class="text-start">$3425.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">07.</th>
                                        <td>SEO Foundations</td>
                                        <td>Arlene McCoy</td>
                                        <td>SEO</td>
                                        <td>Jerome Bell</td>
                                        <td>145</td>
                                        <td class="text-start">$4782.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">08.</th>
                                        <td>Data Analytics</td>
                                        <td>Marvin McKinney</td>
                                        <td>SEO</td>
                                        <td>Guy Hawkins</td>
                                        <td>360</td>
                                        <td class="text-start">$3458.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">09.</th>
                                        <td>SAP courses</td>
                                        <td>Devon Lane</td>
                                        <td>Programming</td>
                                        <td>Bessie Cooper</td>
                                        <td>180</td>
                                        <td class="text-start">$4756.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">10.</th>
                                        <td>SEO Training</td>
                                        <td>Eleanor Pena</td>
                                        <td>SEO</td>
                                        <td>Ronald Richards</td>
                                        <td>255</td>
                                        <td class="text-start">$5478.00</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
