@extends('backend.layouts.master')
@section('content')
        <!-- Main content wrapper=== -->
        <!-- Book List -->
        <div class="container-fluid">
            <div class="row gx-20">
                <div class="col-lg-12">
                    <h3 class="section-title">All Books</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row gx-20 mb-30">
                            <div class="col">
                                <div class="select-type-v2">
                                    <label for="categories" class="form-label">Categories</label>
                                    <select id="categories" class="form-select form-select-lg mb-3 without_search" aria-label=".form-select-lg example">
                                        <option selected>All</option>
                                        <option value="1">UI Design</option>
                                        <option value="2">Graphic Design</option>
                                        <option value="3">Web Design</option>
                                        <option value="4">Web Development</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Book Categories -->

                            <div class="col">
                                <div class="select-type-v2">
                                    <label for="bookType" class="form-label">Book Type</label>
                                    <select id="bookType" class="form-select form-select-lg mb-3 without_search" aria-label=".form-select-lg example">
                                        <option selected>All</option>
                                        <option value="1">Islamic</option>
                                        <option value="2">Science Fiction</option>
                                        <option value="3">Marketing</option>
                                        <option value="4">Novel</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Book Type -->

                            <div class="col">
                                <div class="select-type-v2">
                                    <label for="bookPublisher" class="form-label">Publisher</label>
                                    <select id="bookPublisher" class="form-select form-select-lg mb-3 without_search" aria-label=".form-select-lg example">
                                        <option selected>All</option>
                                        <option value="1">Dibboprokash</option>
                                        <option value="2">Madina</option>
                                        <option value="3">Seba Prokashani</option>
                                        <option value="4">Somoy Prokashon</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Book Publisher -->

                            <div class="col">
                                <div class="select-type-v2">
                                    <label for="bookAuthor" class="form-label">Author</label>
                                    <select id="bookAuthor" class="form-select form-select-lg mb-3 without_search" aria-label=".form-select-lg example">
                                        <option selected>All</option>
                                        <option value="2">Arif Azad</option>
                                        <option value="3">Mizanur Rahman</option>
                                        <option value="4">Abdullah Jahangir</option>
                                        <option value="1">Humayun Ahmed</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Book Author -->

                            <div class="col">
                                <button type="button" class="btn sg-btn-primary w-100 mt-30">Filter</button>
                            </div>
                        </div>

                        <div class="row mb-30">
                            <div class="col-lg-6">
                                <div class="oftions-content-left">
                                    <form action="#" class="">
                                        <div class="select-type-v2 d-flex align-items-center gap-20">
                                            <label for="customer" class="order-1">Book Per Page</label>
                                            <select name="customer" id="customer" class="customer-length form-select without_search" aria-label=".form-select-lg example">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="oftions-content-right mb-20">
                                    <form action="#" class="oftions-content-search">
                                        <input type="search" name="search" id="search" placeholder="Search">
                                        <button type="submit"><img src="./assets/img/icons/search.svg" alt="Search"></button>
                                    </form>

                                    <a href="book-add.php" class="d-flex align-items-center button-default gap-2">
                                        <img class="icon" src="./assets/img/icons/plus.svg" alt="plus">
                                        <span>Add New Book</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="default-list-table table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">S. No</th>
                                            <th scope="col">Book Name</th>
                                            <th scope="col">Categories</th>
                                            <th scope="col">Total Sale</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">01.</th>
                                            <td>How To Get People To Like Web Development.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox1" checked>
                                                    <label for="checkbox1"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">02.</th>
                                            <td>What I Wish Everyone Knew About Marketing.</td>
                                            <td>Design</td>
                                            <td>Total Enrolment : 57</td>
                                            <td>$1324.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox2" checked>
                                                    <label for="checkbox2"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">03.</th>
                                            <td>The Biggest Contribution Of Marketing To Humanity.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox3" checked>
                                                    <label for="checkbox3"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">

                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">04.</th>
                                            <td>Learn All About Design From This Politician.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox4" checked>
                                                    <label for="checkbox4"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">

                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">05.</th>
                                            <td>Most Effective Ways To Overcome Marketing's Problem.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox5">
                                                    <label for="checkbox5"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">

                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">06.</th>
                                            <td>Ten Latest Developments In Web Development.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox6" checked>
                                                    <label for="checkbox6"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">

                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">07</th>
                                            <td>15 Web Development That Had Gone Way Too Far.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox7">
                                                    <label for="checkbox7"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">

                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">08.</th>
                                            <td>7 Things You Probably Didn't Know About Design.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox8" checked>
                                                    <label for="checkbox8"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">

                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">09.</th>
                                            <td>5 Doubts About Web Development You Should Clarify.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox9" checked>
                                                    <label for="checkbox9"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">

                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">10.</th>
                                            <td>Learn How To Make More Money With Design.</td>
                                            <td>Development</td>
                                            <td>Total Enrolment : 45</td>
                                            <td>$534.00</td>
                                            <td>
                                                <div class="setting-check">
                                                    <input type="checkbox" id="checkbox10">
                                                    <label for="checkbox10"></label>
                                                </div>
                                            </td>
                                            <td class="action-card">

                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="course-edit.php">Edit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Visit Course</a></li>
                                                        <li><a class="dropdown-item" href="#">Manage Student</a></li>
                                                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- END Main Content Wrapper -->
@endsection
