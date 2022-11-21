@extends('layouts.master')

@section('title','Diverswerk')

{{-- header styles --}}
@push('styles')

@endpush

{{-- main contents --}}
@section('content')

    {{-- header --}}
    @include('layouts.partials.common.header')

    <!-- ======================= Start Banner ===================== -->
    <div class="banner-section" style="background-image:url({{asset('diverswerk/assets/img/slider_bg.jpg')}});" data-overlay="8">
        <div class="container">
            <div class="col-md-8 col-sm-10">
                <div class="caption cl-white home_two_slid">
                    <h2>Search Between More Then <span class="theme-cl">50,000</span> Open Jobs.</h2>
                    <p>Trending Jobs Keywords: <span class="trending_key"><a
                                    href="javascript:void(0);">Radiologist</a></span> <span class="trending_key"><a href="javascript:void(0);">Dentist</a></span>
                        <span class="trending_key"><a href="javascript:void(0);">Physician</a></span>
                        <span class="trending_key"><a href="javascript:void(0);">Orthopadic</a></span>
                    </p>
                </div>
                <form>
                    <fieldset class="utf_home_form_one">
                        <div class="col-md-4 col-sm-4 padd-0">
                            <input type="text" class="form-control br-1" placeholder="Search Keywords...">
                        </div>
                        <div class="col-md-3 col-sm-3 padd-0">
                            <select class="wide form-control br-1" style="display: none;">
                                <option data-display="Location">All Country</option>
                                <option value="1">Afghanistan</option>
                                <option value="2">Albania</option>
                                <option value="3">Algeria</option>
                                <option value="4">Brazil</option>
                                <option value="5">Burundi</option>
                                <option value="6">Bulgaria</option>
                                <option value="7">Germany</option>
                                <option value="8">Grenada</option>
                                <option value="9">Guatemala</option>
                                <option value="10" disabled="">Iceland</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 padd-0">
                            <select class="wide form-control" style="display: none;">
                                <option data-display="Category">Show All</option>
                                <option value="1">Radiologist</option>
                                <option value="2">Dentist</option>
                                <option value="3">Physician</option>
                                <option value="4" disabled="">Orthopadic</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-2 padd-0 m-clear">
                            <button type="submit" class="btn theme-btn cl-white seub-btn">Search</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- ======================= End Banner ===================== -->

    <!-- ================= Category start ========================= -->
    <section class="service-box-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="heading">
                        <h2>Job Categories</h2>
                        <p>Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3 col-sm-6">
                        <a href="job.html" title="">
                            <div class="service-box-card">
                                <div class="service-box-desc">
                                    <div class="service-box-icon"> <i class="icon-bargraph" aria-hidden="true"></i> </div>
                                    <div class="category-detail service-box-desc_text">
                                        <h4>Radiologist</h4>
                                        <p>122 Jobs</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="job.html" title="">
                            <div class="service-box-card">
                                <div class="service-box-desc">
                                    <div class="service-box-icon"> <i class="icon-tools" aria-hidden="true"></i> </div>
                                    <div class="category-detail service-box-desc_text">
                                        <h4>Dentist</h4>
                                        <p>155 Jobs</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="job.html" title="">
                            <div class="service-box-card">
                                <div class="service-box-desc">
                                    <div class="service-box-icon"> <i class="ti-briefcase" aria-hidden="true"></i> </div>
                                    <div class="category-detail service-box-desc_text">
                                        <h4>Physician</h4>
                                        <p>300 Jobs</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="job.html" title="">
                            <div class="service-box-card">
                                <div class="service-box-desc">
                                    <div class="service-box-icon"> <i class="ti-ruler-pencil" aria-hidden="true"></i> </div>
                                    <div class="category-detail service-box-desc_text">
                                        <h4>Orthopadic</h4>
                                        <p>80 Jobs</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12 mrg-top-20 text-center">
                        <a href="javascript:void(0);" class="btn theme-btn btn-m">View All Categories</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= Job start ========================= -->
    <section class="padd-top-80 padd-bot-80">
        <div class="container">
            <h2 class="text-center mrg-bot-30 ">Recent Jobs</h2>
            <div class="tab-content">
                <div class="tab-pane fade in show active" id="recent" role="tabpanel">
                    <div class="row">
                        <!-- Single Job -->
                        <div class="col-md-3 col-sm-6">
                            <div class="service-box-card-2"> <span class="job-type full-type">Full Time</span>

                                <div class="u-content">
                                    <div class="avatar box-80">
                                        <a href="javascript:void(0);"> <img class="img-responsive" src="{{asset('diverswerk/assets/img/company_logo_1.png')}}" alt=""> </a>
                                    </div>
                                    <h5><a href="javascript:void(0);">Lorem Ipsum</a>
                                    </h5>
                                    <p class="text-muted">2708 Scenic Way, IL 62373</p>
                                </div>
                                <div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>
                            </div>
                        </div>

                        <!-- Single Job -->
                        <div class="col-md-3 col-sm-6">
                            <div class="service-box-card-2"> <span class="job-type full-type">Full Time</span>

                                <div class="u-content">
                                    <div class="avatar box-80">
                                        <a href="javascript:void(0);"> <img class="img-responsive" src="{{asset('diverswerk/assets/img/company_logo_2.png')}}" alt=""> </a>
                                    </div>
                                    <h5><a href="javascript:void(0);">Lorem Ipsum</a></h5>
                                    <p class="text-muted">2708 Scenic Way, IL 62373</p>
                                </div>
                                <div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>
                            </div>
                        </div>

                        <!-- Single Job -->
                        <div class="col-md-3 col-sm-6">
                            <div class="service-box-card-2"> <span class="job-type part-type">Part Time</span>

                                <div class="u-content">
                                    <div class="avatar box-80">
                                        <a href="javascript:void(0);"> <img class="img-responsive" src="{{asset('diverswerk/assets/img/company_logo_3.png')}}" alt=""> </a>
                                    </div>
                                    <h5><a href="javascript:void(0);">Lorem Ipsum</a></h5>
                                    <p class="text-muted">3765 C Street, Worcester</p>
                                </div>
                                <div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>
                            </div>
                        </div>

                        <!-- Single Job -->
                        <div class="col-md-3 col-sm-6">
                            <div class="service-box-card-2"> <span class="job-type part-type">Part Time</span>

                                <div class="u-content">
                                    <div class="avatar box-80">
                                        <a href="javascript:void(0);"> <img class="img-responsive" src="{{asset('diverswerk/assets/img/company_logo_4.png')}}" alt=""> </a>
                                    </div>
                                    <h5><a href="javascript:void(0);">Lorem Ipsum</a></h5>
                                    <p class="text-muted">2719 Duff Avenue, Winooski</p>
                                </div>
                                <div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>
                            </div>
                        </div>

                        <!-- Single Job -->
                        <div class="col-md-3 col-sm-6">
                            <div class="service-box-card-2"> <span class="job-type internship-type">Internship</span>

                                <div class="u-content">
                                    <div class="avatar box-80">
                                        <a href="javascript:void(0);"> <img class="img-responsive" src="{{asset('diverswerk/assets/img/company_logo_5.png')}}" alt=""> </a>
                                    </div>
                                    <h5><a href="javascript:void(0);">Lorem Ipsume</a>
                                    </h5>
                                    <p class="text-muted">2708 Scenic Way, IL 62373</p>
                                </div>
                                <div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>
                            </div>
                        </div>

                        <!-- Single Job -->
                        <div class="col-md-3 col-sm-6">
                            <div class="service-box-card-2"> <span class="job-type part-type">Part Time</span>

                                <div class="u-content">
                                    <div class="avatar box-80">
                                        <a href="javascript:void(0);"> <img class="img-responsive" src="{{asset('diverswerk/assets/img/company_logo_6.png')}}" alt=""> </a>
                                    </div>
                                    <h5><a href="javascript:void(0);">Lorem Ipsum</a></h5>
                                    <p class="text-muted">2865 Emma Street, Lubbock</p>
                                </div>
                                <div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>
                            </div>
                        </div>

                        <!-- Single Job -->
                        <div class="col-md-3 col-sm-6">
                            <div class="service-box-card-2"> <span class="job-type full-type">Full Time</span>

                                <div class="u-content">
                                    <div class="avatar box-80">
                                        <a href="javascript:void(0);"> <img class="img-responsive" src="{{asset('diverswerk/assets/img/company_logo_7.png')}}" alt=""> </a>
                                    </div>
                                    <h5><a href="javascript:void(0);">Lorem Ipsum</a></h5>
                                    <p class="text-muted">2719 Burnside Avenue, Logan</p>
                                </div>
                                <div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>
                            </div>
                        </div>

                        <!-- Single Job -->
                        <div class="col-md-3 col-sm-6">
                            <div class="service-box-card-2"> <span class="job-type part-type">Part Time</span>

                                <div class="u-content">
                                    <div class="avatar box-80">
                                        <a href="javascript:void(0);"> <img class="img-responsive" src="{{asset('diverswerk/assets/img/company_logo_8.png')}}" alt=""> </a>
                                    </div>
                                    <h5><a href="javascript:void(0);">Lorem Ipsum</a>
                                    </h5>
                                    <p class="text-muted">3815 Forest Drive, Alexandria</p>
                                </div>
                                <div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mrg-top-20 text-center">
                <a href="#" class="btn theme-btn btn-m">Browse
                    All Jobs</a>
            </div>
        </div>
    </section>

    <section class="our-user-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="heading">
                        <h2>What Our Users Say <img src="{{asset('diverswerk/assets/img/smile-img.png')}}" alt=""></h2>
                        <p>We collect reviews from our users so you can get an honest opinion of what an experience with our website are really like!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="user-review-wrapper">
                        <div class="user-review-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                        </div>
                        <div class="user-review-profile">
                            <div class="user-review-profile-img"><img src="{{asset('diverswerk/assets/img/user-img1.png')}}" alt=""></div>
                            <h4>Jack Paden</h4>
                            <span>Jobseeker</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="user-review-wrapper">
                        <div class="user-review-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                        </div>
                        <div class="user-review-profile">
                            <div class="user-review-profile-img"><img src="{{asset('diverswerk/assets/img/user-img2.png')}}" alt=""></div>
                            <h4>Tom Baker</h4>
                            <span>HR Specialist</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="user-review-wrapper">
                        <div class="user-review-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                        </div>
                        <div class="user-review-profile">
                            <div class="user-review-profile-img"><img src="{{asset('diverswerk/assets/img/user-img3.png')}}" alt=""></div>
                            <h4>Jennie Smith</h4>
                            <span>Jobseeker</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="recent-post-section">
        <div class="container">
            <h2 class="text-center">Recent Posts</h2>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="recent-post-wrapper">
                        <div class="recent-post-img">
                            <img src="{{asset('diverswerk/assets/img/post-img.jpg')}}" alt="">
                        </div>
                        <div class="recent-post-text">
                            <h3>Hey Job Seeker,It's Time To Get Up And Get Hired</h3>
                            <div class="recent-post-date">
                                <span>October 10,2015</span>
                                <span class="post-comment">0 Comments</span>
                            </div>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that </p>
                            <a class="btn theme-btn btn-m" href="#" title="Read More">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="recent-post-wrapper">
                        <div class="recent-post-img">
                            <img src="{{asset('diverswerk/assets/img/post-img.jpg')}}" alt="">
                        </div>
                        <div class="recent-post-text">
                            <h3>Hey Job Seeker,It's Time To Get Up And Get Hired</h3>
                            <div class="recent-post-date">
                                <span>October 10,2015</span>
                                <span class="post-comment">0 Comments</span>
                            </div>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that </p>
                            <a class="btn theme-btn btn-m" href="#" title="Read More">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="recent-post-wrapper">
                        <div class="recent-post-img">
                            <img src="{{asset('diverswerk/assets/img/post-img.jpg')}}" alt="">
                        </div>
                        <div class="recent-post-text">
                            <h3>Hey Job Seeker,It's Time To Get Up And Get Hired</h3>
                            <div class="recent-post-date">
                                <span>October 10,2015</span>
                                <span class="post-comment">0 Comments</span>
                            </div>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that </p>
                            <a class="btn theme-btn btn-m" href="#" title="Read More">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter theme-bg" style="background-image:url(assets/img/bg-new.png)">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="heading light">
                        <h2>Subscribe Our Newsletter!</h2>
                        <p>Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                    <div class="newsletter-box text-center">
                        <div class="input-group"> <span class="input-group-addon"><span class="ti-email theme-cl"></span></span>
                            <input type="text" class="form-control" placeholder="Enter your Email...">
                        </div>
                        <button type="button" class="btn theme-btn btn-radius btn-m">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- footer start --}}
    @include('layouts.partials.common.footer')

    {{-- Signup Code --}}
    @include('layouts.partials.common.signup-modal')

@endsection

{{-- footer scripts --}}
@push('scripts')
<script>
    $(document).ready(function ($) {
        console.log('custom page js here');
    });
</script>
@endpush
