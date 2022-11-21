@extends('layouts.app')

@section('content') 

<!-- Header start --> 

@include('includes.header') 

<!-- Header end --> 

<!-- Inner Page Title start --> 

@include('flash::message')

<!-- Inner Page Title end -->
<!-- JS files for auto-complete -->
<style type="text/css">
    .page-banner .image{
        position: relative;
    }

    .page-banner .image:after {
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background: linear-gradient(to right, #323232 20%, rgba(50, 50, 50, 0.95) 50%, rgba(50, 50, 50, 0.1) 80%, rgba(50, 50, 50, 0) 100%);
    }
    
    video {
        width: 100%; /* width needs to be set to 100% */
        height: 400px; /* height needs to be set to 100% */
        object-fit: cover;
        left: 0;
        top: 0;
    }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


@php
    $sliderImage = asset('diverswerk/assets/img/slider_bg.jpg');
    $bg_video = asset('diverswerk/assets/video/pexels-karolina-grabowska-8540026.mp4');
@endphp


<div id="titlebar" class="page-banner" >
    <div class="image" style="opacity: 0.8">
        <video playsinline autoplay muted loop poster="{{$sliderImage}}" id="bgvid">
            <source src="{{$bg_video}}" type="video/mp4">
        </video>
    </div>
    
    <div class="container">
       <div class="banner-text">
           <span class="sub-title"><div class="breadCrumb"><a href="{{route('index')}}">{{__('Home')}}</a> / <span>{{ __('Job Search')}}</span></div></span>
           <h2 class="title">{{ __('Job Search')}}</h2>
       </div>
     
   </div>
</div>

<div class="wrapper">
    <!-- ======================= Page Title ===================== -->
    <div id="titlebar" class="page-banner">
        <div class="container">
            <div class="row">
            <div class="col-md-8 col-sm-12">
                @if($jobTypes == '' && strlen($industry) == 0 && strlen($search) == 0)
                    <span class="sub-title">{{ __('We found') }} {{!empty($jobs) && count($jobs)>0 ? $jobs->total() : 0}} {{ __('Jobs') }} </span>
                @else                     
                    <span class="sub-title">{{ __('We found') }} {{!empty($jobs) && count($jobs)>0 ? $jobs->total() : 0}} {{ __('jobs matching') }}:</span>
                    <h2 class="title">
                        @if($jobTypes != '')
                        {{ $jobTypes }}
                        @else
                        {{ (strlen($industry) > 0 && $industry != '') ? $industry : (!is_null($search) ? $search : '') }}
                        @endif
                    </h2>
                @endif
            </div>
            <div class="col-md-4 col-sm-12 text-right">
            @if (Auth::guard('company')->check())
                <a href="{{ route('post.job') }}" class="btn-job theme-btn">{{ __('Post a Job, It’s Free!') }}</a>
            @endif
            </div>
            </div>
            
        </div>
    </div>
    <!-- ======================= End Page Title ===================== -->

    <div class="container">
        <!-- ====================== Start Job Detail 2 ================ -->
        <section class="padd-top-0 padd-bot-80">
            <div class="container">
                <form action="{{route('job.list')}}" method="get">
                    <div class="row">
                        @include('includes.job_list_side_bar')

                        <!-- Start Job List -->
                        <div class="col-md-9 col-sm-7">
                            <div class="row mrg-bot-20">
                                <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
                                    <h4 class="job_vacancie">{{!empty($jobs) && count($jobs)>0 ? count($jobs) : 0}} {{__('Jobs & Vacancies')}}</h4>
                                </div>
                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <div class="fl-right short_by_filter_list">
                                        <div class="search-wide short_by_til">
                                            <h5>{{__('Sort By')}}</h5>
                                        </div>
                                        <div class="search-wide full">
                                            <select class="wide form-control" style="display: none;" onchange="this.form.submit()" name="order_by" id="order_by">
                                                <option value="1" {{ ( '1' == $order_by) ? 'selected="selected" focus' : '' }}>{{__('Newest')}}</option>
                                                <option value="2" {{ ( '2' == $order_by) ? 'selected="selected" focus' : '' }}>{{__('Oldest')}}</option>
                                            </select>
                                            <div class="nice-select wide form-control" tabindex="0"><span class="current">{{ ( '2' == $order_by) ? __('Oldest') : __('Newest') }}</span>
                                                <ul class="list">
                                                    <li data-value="1" class="option {{ ( '1' == $order_by) ? 'selected focus' : '' }}"  >{{__('Newest')}}</li>
                                                    <li data-value="2" class="option {{ ( '2' == $order_by) ? 'selected focus' : '' }}" >{{__('Oldest')}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="search-wide full hidden">
                                            <select class="wide form-control" style="display: none;">
                                                <option>10 {{ __('Per Page') }}</option>
                                                <option value="1">20 {{ __('Per Page') }}</option>
                                                <option value="2">30 {{ __('Per Page') }}</option>
                                                <option value="4">50 {{ __('Per Page') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Verticle job -->
                            @if(isset($jobs) && count($jobs))
                            @foreach($jobs as $job)
                            @php 
                                $company =$job->getCompany();
                                $salaryPeriod =$job->getSalaryPeriod();

                            @endphp

                                 <?php if(isset($company))
                                {
                                ?>
                                    <div class="card-list-wrp">
                                        <div class="card-list">
                                            <div class="card-list-header">
                                                <div class="card-list-job-logo hidden">
                                                    {{$company->printCompanyImage()}}
                                                </div>
                                                <h4 class="title"><a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}">{{$job->title}} at {{$company->name}} in {{$job->getCity('city')}}</a></h4>
                                                <span class="com-tagline hidden"></span> <span
                                                    class="pull-right vacancy-no hidden">{{ __('Open Position') }} <span
                                                        class="v-count">2</span></span>
                                            </div>
                                            <div class="card-list-body">
                                                <div class="row">
                                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                                        <ul class="can-skils">
                                                            <li><strong>{{ __('Job Type') }}: </strong>{{$job->getJobType('job_type')}}</li>
                                                            <li class="hidden"><strong>{{ __('Skills') }}: </strong>
                                                                <div><span class="skill-tag">HTML</span> <span
                                                                        class="skill-tag">css</span> <span
                                                                        class="skill-tag">java</span> <span
                                                                        class="skill-tag">php</span></div>
                                                            </li>

                                                            @if (!is_null($salaryPeriod))
                                                                <li><strong>{{ __('Salary') }}: </strong>{{ __('Between') }} € {{$job->salary_from}} {{ __('and') }} € {{$job->salary_to}} {{ $salaryPeriod->salary_period }}</li>
                                                            @endif
                                                            <li><strong>{{ __('Location') }}: </strong>{{$job->getCity('city')}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="vrt-job-act"> <a href="#" data-toggle="modal"
                                                                data-target="#apply-job"
                                                                class="btn-job hidden theme-btn job-apply">{{ __('Apply Now') }}</a>
                                                                <a href="{{route('job.detail', [$job->slug])}}" title="" class="btn-job theme-btn btn-sm">{{ __('View Job') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                            <!-- job end --> 

                            @endforeach
                            @endif

                            <div class="clearfix"></div>
                            <!-- Pagination Start -->
                                <div class="utf_flexbox_area padd-0">
                                    <ul class="pagination">

                                        @if(isset($jobs) && count($jobs))

                                        {{ $jobs->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}

                                        @endif

                                    </ul>
                            </div>

                            <!-- Pagination end --> 
                                </div>
                        </div>  
                        <!-- End job list -->              
                    </div>
                </form>
                <!-- End Row -->
            </div>
        </section>
        <!-- ====================== End Job Detail 2 ================ -->

    </div>

</div>

<div class="modal fade" id="show_alert" role="dialog">

    <div class="modal-dialog search-popup">
        <?php 
        $salary_offered_id = Request::get('salary_offered_id') ? implode(',', Request::get('salary_offered_id')) : '';
        $career_level_id = Request::get('career_level_id') ? implode(',', Request::get('career_level_id')) : '';
        $job_experience_id = Request::get('job_experience_id') ? implode(',', Request::get('job_experience_id')) : '';
        $degree_level_id = Request::get('degree_level_id') ? implode(',', Request::get('degree_level_id')) : '';
        $job_type_id = Request::get('job_type_id') ? implode(',', Request::get('job_type_id')) : '';
        ?>

        <div class="modal-content">

            <form id="submit_alert">

                @csrf

                <input type="hidden" name="search" value="{{ Request::get('search') }}">

                <input type="hidden" name="country_id" value="@if(isset(Request::get('country_id')[0])) {{ Request::get('country_id')[0] }} @endif">

                <input type="hidden" name="state_id" value="@if(isset(Request::get('state_id')[0])){{ Request::get('state_id')[0] }} @endif">

                <input type="hidden" name="city_id" value="{{$cityId}}">

                <input type="hidden" name="salary_offered_ids" value="{{$salary_offered_id}}">
                <input type="hidden" name="job_type_ids" value="{{$job_type_id}}">
                <input type="hidden" name="career_level_ids" value="{{$career_level_id}}">
                <input type="hidden" name="job_experience_ids" value="{{$job_experience_id}}">
                <input type="hidden" name="degree_level_ids" value="{{$degree_level_id}}">

                <div class="modal-header">

                    <h4 class="modal-title">{{ __('Job Alert') }}</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body">

					

					<h3>{{ __('Get the latest') }} <strong>{{ ucfirst(Request::get('search')) }}</strong> {{ __('job') }}s  @if(Request::get('location')!='') in <strong>{{ ucfirst(Request::get('location')) }}</strong>@endif {{ __('sent straight to your inbox') }}</h3>

					

                    <div class="form-group">

                        <input type="text" class="form-control" name="email" id="email" placeholder="{{ __('Enter your Email...') }}"

                            value="@if( Auth::check() ){{Auth::user()->email}}@endif">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>

                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>

                </div>

            </form>

        </div>



    </div>

</div>

@include('includes.footer')

@endsection

@push('styles')

<style type="text/css">

    .searchList li .jobimg {

        min-height: 80px;

    }

    .hide_vm_ul{

        height:100px;

        overflow:hidden;

    }

    .hide_vm{

        display:none !important;

    }

    .view_more{

        cursor:pointer;

    }

</style>

@endpush

@push('scripts') 

<script>

    $('.btn-job-alert').on('click', function() {

        $('#show_alert').modal('show');

    })

     $(document).ready(function ($) {
        $("#search-job-list").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });



        $("#search-job-list").find(":input").prop("disabled", false);



        $(".view_more_ul").each(function () {

            if ($(this).height() > 100)

            {

                $(this).addClass('hide_vm_ul');

                $(this).next().removeClass('hide_vm');

            }

        });

        $('.view_more').on('click', function (e) {

            e.preventDefault();

            $(this).prev().removeClass('hide_vm_ul');

            $(this).addClass('hide_vm');

        });



    });

    if ($("#submit_alert").length > 0) {

    $("#submit_alert").validate({



        rules: {

            email: {

                required: true,

                maxlength: 5000,

                email: true

            }

        },

        messages: {

            email: {

                required: "Email is required",

            }



        },

        submitHandler: function(form) {

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $.ajax({

                url: "{{route('subscribe.alert')}}",

                type: "GET",

                data: $('#submit_alert').serialize(),

                success: function(response) {

                    $("#submit_alert").trigger("reset");

                    $('#show_alert').modal('hide');

                    swal({

                        title: "Success",

                        text: response["msg"],

                        icon: "success",

                        button: "OK",

                    });

                }

            });

        }

    })

}

</script>

@include('includes.country_state_city_js')

@endpush