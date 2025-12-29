@extends('frontend.layouts.master')
@section('title', __('audio'))
@section('content')
<!--====== Start Course Audio Section ======-->
<section class="course-audio-section p-t-50 p-b-105 p-t-sm-30">
    <div class="container container-1278">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="border-bottom-soft-white-lg p-b-md-10 m-b-sm-15 m-b-25 fw-medium fz-22">
                            <h3>SSC Animated Lessons</h3>
                        </div>
                    </div>
                </div>
                <div class="audio-wrapper">
                    <div class="audio-thumb">
                        <img src="assets/img/audio/audio-thumbnail-1.jpg" alt="Audio Thumbnail">
                    </div>
                    <div class="audio-content">
                        <h6>Introduction & Structure of Sentence</h6>
                        <p>Present Indefinite Tense</p>
                        <audio class="audio-podcast" crossorigin>
                            <source src="https://cdn.plyr.io/static/demo/Kishi_Bashi_-_It_All_Began_With_a_Burst.mp3" type="audio/mp3">
                            <source src="https://cdn.plyr.io/static/demo/Kishi_Bashi_-_It_All_Began_With_a_Burst.ogg" type="audio/ogg">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-container m-t-md-45">
                    <h4 class="border-bottom-soft-white-lg p-b-md-10 m-b-sm-15 m-b-25 fw-medium fz-22">Topics Lessons</h4>
                    <div class="curriculum-tab curriculum-tab-v2">
                        <div class="accordion accordion-flush" id="curriculumAccordion">
                            <div class="accordion-item">
                                <div class="accordion-header" id="course-curriculum-headingOne">
                                    <div class="accordion-button" role="button" data-bs-toggle="collapse" data-bs-target="#course-curriculum-collapseOne" aria-expanded="true" aria-controls="course-curriculum-collapseOne">
                                        Nouns & Articles
                                    </div>
                                </div>
                                <div id="course-curriculum-collapseOne" class="accordion-collapse collapse show" aria-labelledby="course-curriculum-headingOne" data-bs-parent="curriculumAccordion">
                                    <div class="accordion-body">
                                        <div class="course-playlist">
                                            <ul>
                                                <li>
                                                    <a href="video.html">
                                                        <div class="icon">
                                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>How to Tell the Time in English </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="audio.html">                                                
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.13281 12.4541V14.9996" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.20312 15H9.06979" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Introduction & Structure of Sentence </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>Perfect Continuous Tenses</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="quiz.html">
                                                        <div class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8 11.5H8.007" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Countable & Non-Countable Nouns</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9.90914C8.76142 9.90914 11 7.91476 11 5.45457C11 2.99438 8.76142 1 6 1C3.23858 1 1 2.99438 1 5.45457C1 7.91476 3.23858 9.90914 6 9.90914Z" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.29397 9.20265L2.42969 15L6.00112 13.0909L9.57254 15L8.70826 9.19629" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Subject Verb Agreement</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="video.html">
                                                        <div class="icon">
                                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>How to Tell the Time in English </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="audio.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.13281 12.4541V14.9996" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.20312 15H9.06979" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Introduction & Structure of Sentence </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>Perfect Continuous Tenses </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="quiz.html">
                                                        <div class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8 11.5H8.007" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Countable & Non-Countable Nouns</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9.90914C8.76142 9.90914 11 7.91476 11 5.45457C11 2.99438 8.76142 1 6 1C3.23858 1 1 2.99438 1 5.45457C1 7.91476 3.23858 9.90914 6 9.90914Z" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.29397 9.20265L2.42969 15L6.00112 13.0909L9.57254 15L8.70826 9.19629" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Subject Verb Agreement</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header" id="course-curriculum-headingTwo">
                                    <div class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#course-curriculum-collapseTwo" aria-expanded="false" aria-controls="course-curriculum-collapseTwo">
                                        Structure of Sentence
                                    </div>
                                </div>
                                <div id="course-curriculum-collapseTwo" class="accordion-collapse collapse" aria-labelledby="course-curriculum-headingTwo" data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        <div class="course-playlist">
                                            <ul>
                                                <li>
                                                    <a href="video.html">
                                                        <div class="icon">
                                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>How to Tell the Time in English </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="audio.html">                                                
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.13281 12.4541V14.9996" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.20312 15H9.06979" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Introduction & Structure of Sentence </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>Perfect Continuous Tenses</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="quiz.html">
                                                        <div class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8 11.5H8.007" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Countable & Non-Countable Nouns</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9.90914C8.76142 9.90914 11 7.91476 11 5.45457C11 2.99438 8.76142 1 6 1C3.23858 1 1 2.99438 1 5.45457C1 7.91476 3.23858 9.90914 6 9.90914Z" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.29397 9.20265L2.42969 15L6.00112 13.0909L9.57254 15L8.70826 9.19629" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Subject Verb Agreement</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="video.html">
                                                        <div class="icon">
                                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>How to Tell the Time in English </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="audio.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.13281 12.4541V14.9996" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.20312 15H9.06979" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Introduction & Structure of Sentence </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>Perfect Continuous Tenses </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="quiz.html">
                                                        <div class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8 11.5H8.007" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Countable & Non-Countable Nouns</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9.90914C8.76142 9.90914 11 7.91476 11 5.45457C11 2.99438 8.76142 1 6 1C3.23858 1 1 2.99438 1 5.45457C1 7.91476 3.23858 9.90914 6 9.90914Z" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.29397 9.20265L2.42969 15L6.00112 13.0909L9.57254 15L8.70826 9.19629" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Subject Verb Agreement</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header" id="course-curriculum-headingThree">
                                    <div class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#course-curriculum-collapseThree" aria-expanded="false" aria-controls="course-curriculum-collapseThree">
                                        Adjectives & Adverbs
                                    </div>
                                </div>
                                <div id="course-curriculum-collapseThree" class="accordion-collapse collapse" aria-labelledby="course-curriculum-headingThree" data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        <div class="course-playlist">
                                            <ul>
                                                <li>
                                                    <a href="video.html">
                                                        <div class="icon">
                                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>How to Tell the Time in English </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="audio.html">                                                
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.13281 12.4541V14.9996" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.20312 15H9.06979" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Introduction & Structure of Sentence </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>Perfect Continuous Tenses</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="quiz.html">
                                                        <div class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8 11.5H8.007" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Countable & Non-Countable Nouns</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9.90914C8.76142 9.90914 11 7.91476 11 5.45457C11 2.99438 8.76142 1 6 1C3.23858 1 1 2.99438 1 5.45457C1 7.91476 3.23858 9.90914 6 9.90914Z" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.29397 9.20265L2.42969 15L6.00112 13.0909L9.57254 15L8.70826 9.19629" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Subject Verb Agreement</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="video.html">
                                                        <div class="icon">
                                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>How to Tell the Time in English </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="audio.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.13281 12.4541V14.9996" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.20312 15H9.06979" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Introduction & Structure of Sentence </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>Perfect Continuous Tenses </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="quiz.html">
                                                        <div class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8 11.5H8.007" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Countable & Non-Countable Nouns</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9.90914C8.76142 9.90914 11 7.91476 11 5.45457C11 2.99438 8.76142 1 6 1C3.23858 1 1 2.99438 1 5.45457C1 7.91476 3.23858 9.90914 6 9.90914Z" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.29397 9.20265L2.42969 15L6.00112 13.0909L9.57254 15L8.70826 9.19629" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Subject Verb Agreement</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header" id="course-curriculum-headingFour">
                                    <div class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#course-curriculum-collapseFour" aria-expanded="false" aria-controls="course-curriculum-collapseFour">
                                        WH Questions
                                    </div>
                                </div>
                                <div id="course-curriculum-collapseFour" class="accordion-collapse collapse" aria-labelledby="course-curriculum-headingFour" data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        <div class="course-playlist">
                                            <ul>
                                                <li>
                                                    <a href="video.html">
                                                        <div class="icon">
                                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>How to Tell the Time in English </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="audio.html">                                                
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.13281 12.4541V14.9996" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.20312 15H9.06979" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Introduction & Structure of Sentence </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>Perfect Continuous Tenses</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="quiz.html">
                                                        <div class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8 11.5H8.007" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Countable & Non-Countable Nouns</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9.90914C8.76142 9.90914 11 7.91476 11 5.45457C11 2.99438 8.76142 1 6 1C3.23858 1 1 2.99438 1 5.45457C1 7.91476 3.23858 9.90914 6 9.90914Z" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.29397 9.20265L2.42969 15L6.00112 13.0909L9.57254 15L8.70826 9.19629" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Subject Verb Agreement</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="video.html">
                                                        <div class="icon">
                                                            <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65082 12.6716L9.6672 7.27008C9.85301 7.14489 9.85301 6.85511 9.6672 6.72992L1.65082 1.32843C1.45213 1.19456 1.19345 1.34732 1.19345 1.59852L1.19345 12.4015C1.19345 12.6527 1.45213 12.8054 1.65082 12.6716ZM10.3032 8.35042C11.2323 7.72444 11.2323 6.27556 10.3032 5.64958L2.28685 0.248098C1.29343 -0.421275 9.38703e-07 0.342513 8.83801e-07 1.59852L4.11588e-07 12.4015C3.56687e-07 13.6575 1.29343 14.4213 2.28685 13.7519L10.3032 8.35042Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>How to Tell the Time in English </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="audio.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6.12969 1C5.54621 1 4.98663 1.20114 4.57405 1.55916C4.16147 1.91718 3.92969 2.40277 3.92969 2.90909V8C3.92969 8.50632 4.16147 8.99191 4.57405 9.34993C4.98663 9.70795 5.54621 9.90909 6.12969 9.90909C6.71316 9.90909 7.27274 9.70795 7.68532 9.34993C8.0979 8.99191 8.32969 8.50632 8.32969 8V2.90909C8.32969 2.40277 8.0979 1.91718 7.68532 1.55916C7.27274 1.20114 6.71316 1 6.12969 1Z" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M11.2667 6.72754V8.00027C11.2667 9.18169 10.7258 10.3147 9.76315 11.1501C8.80046 11.9855 7.49478 12.4548 6.13333 12.4548C4.77189 12.4548 3.46621 11.9855 2.50352 11.1501C1.54083 10.3147 1 9.18169 1 8.00027V6.72754" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.13281 12.4541V14.9996" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.20312 15H9.06979" stroke="#FDCC0D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Introduction & Structure of Sentence </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.23848 0C11.4885 0 13 1.51391 13 3.76685V10.2331C13 12.5058 11.535 13.9838 9.26782 13.9979L3.76224 14C1.51219 14 0 12.4861 0 10.2331V3.76685C0 1.49352 1.46496 0.0161728 3.73218 0.00281266L9.23777 0H9.23848ZM9.23848 1.05475L3.73576 1.05756C2.06969 1.0674 1.07349 2.07996 1.07349 3.76685V10.2331C1.07349 11.9313 2.079 12.9453 3.76152 12.9453L9.26425 12.9431C10.9303 12.9333 11.9265 11.9193 11.9265 10.2331V3.76685C11.9265 2.06871 10.9217 1.05475 9.23848 1.05475ZM9.10043 9.47422C9.39671 9.47422 9.63718 9.71049 9.63718 10.0016C9.63718 10.2927 9.39671 10.529 9.10043 10.529H3.93335C3.63707 10.529 3.3966 10.2927 3.3966 10.0016C3.3966 9.71049 3.63707 9.47422 3.93335 9.47422H9.10043ZM9.10043 6.53043C9.39671 6.53043 9.63718 6.76669 9.63718 7.0578C9.63718 7.34891 9.39671 7.58517 9.10043 7.58517H3.93335C3.63707 7.58517 3.3966 7.34891 3.3966 7.0578C3.3966 6.76669 3.63707 6.53043 3.93335 6.53043H9.10043ZM5.90478 3.59345C6.20107 3.59345 6.44153 3.82971 6.44153 4.12082C6.44153 4.41193 6.20107 4.6482 5.90478 4.6482H3.93314C3.63685 4.6482 3.39639 4.41193 3.39639 4.12082C3.39639 3.82971 3.63685 3.59345 3.93314 3.59345H5.90478Z" fill="var(--color-secondary-4)"/>
                                                            </svg>
                                                        </div>
                                                        <span>Perfect Continuous Tenses </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="quiz.html">
                                                        <div class="icon">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M5.96094 5.89923C6.12551 5.43139 6.45034 5.0369 6.87791 4.78562C7.30547 4.53434 7.80816 4.44248 8.29696 4.52633C8.78576 4.61017 9.22911 4.86429 9.54849 5.2437C9.86787 5.6231 10.0427 6.10329 10.0419 6.59923C10.0419 7.99923 7.94194 8.69923 7.94194 8.69923" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M8 11.5H8.007" stroke="#D16D86" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Countable & Non-Countable Nouns</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="note-book.html">
                                                        <div class="icon">
                                                            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9.90914C8.76142 9.90914 11 7.91476 11 5.45457C11 2.99438 8.76142 1 6 1C3.23858 1 1 2.99438 1 5.45457C1 7.91476 3.23858 9.90914 6 9.90914Z" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M3.29397 9.20265L2.42969 15L6.00112 13.0909L9.57254 15L8.70826 9.19629" stroke="#FDCC0D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Subject Verb Agreement</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Course Audio Section ======-->
@endsection
