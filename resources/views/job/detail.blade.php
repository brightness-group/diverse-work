@extends('layouts.app')
@section('content') 

@php
$company = $job->getCompany();
@endphp
<div class="wrapper">
    <!-- Header start --> 
    @include('includes.header') 
    <!-- Header end --> 
    <!-- ======================= Page Title ===================== -->
    <div id="titlebar" class="photo-bg page-banner" style="background: url(assets/img/job-page-photo.jpg)">
        <div class="container">
            <div class="col-md-8 col-sm-12">
                <span class="sub-title"><a href="#">{{$job->getFunctionalArea()->functional_area}}</a></span>
                <h2 class="title">{{$job->title}} at {{$company->name}} in {{$job->getCity('city')}} <span class="full-time">{{$job->getJobType('job_type')}}</span></h2>
            </div>
            <div class="col-md-4 col-sm-12 text-right">
                @if($job->isJobExpired())
                <span class="jbexpire">{{__('Job is expired')}}</span>
                @elseif(Auth::check() && Auth::user()->isAppliedOnJob($job->id))
                <a href="javascript:;" class="btn-job theme-btn white apply applied"> {{__('Already Applied')}}</a>
                @else                
                <a href="{{route('apply.job', $job->slug)}}" class="btn-job theme-btn white apply"></i> {{__('Apply Now')}}</a>
                @endif
           </div>
        </div>
    </div>
    <!-- ======================= End Page Title ===================== -->

    @include('flash::message')
    <!-- ====================== Start Job Detail 2 ================ -->
    <section class="padd-top-80 padd-bot-60">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="card job-d-styel-1 no-stick">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mrg-bot-10 user_profile_img"> <img src="assets/img/company_logo_1.png" class="width-100 hidden" alt="">
                                    <h4 class="meg-0">{{$job->title}} at {{$company->name}} in {{$job->getCity('city')}}</h4>
                                </div>
                                <div class="col-md-12 user_job_detail">
                                    <div class="mrg-bot-10">{!! $job->description !!}</div>
                                    <div class="text-right">
                                        @if($job->isJobExpired())
                                            <span class="jbexpire">{{__('Job is expired')}}</span>
                                        @elseif(Auth::check() && Auth::user()->isAppliedOnJob($job->id))
                                            <a href="javascript:;" class="btn-job theme-btn white apply applied"> {{__('Already Applied')}}</a>
                                        @else                
                                            <a href="{{route('apply.job', $job->slug)}}" class="btn-job theme-btn white apply"></i> {{__('Apply Now')}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($job->benefits) && ($job->benefits != ''))
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title">{{ __('Job Benifits') }}</h4>
                        </div>
                        <div class="card-body">
                            <p>{!! $job->benefits !!}</p>
                        </div>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title">{{ __('Job Skill') }}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="detail-list">
                                {!!$job->getJobSkillsList()!!}
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title">{{ __('Location') }}</h4>
                        </div>
                        <div class="card-body">
                            {!!$company->map!!}

                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2440.153022924081!2d4.6964813!3d52.295077!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5e6537733cbe9%3A0x6afbe7b73777ca56!2sBrightness%20Group%20BV!5e0!3m2!1sen!2sin!4v1613470875805!5m2!1sen!2sin"
                                width="100%" height="320" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="title">{{ __('Company') }} : {{$company->name}} in {{$job->getCity('city')}}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="detail-list">
                                {!! $company->description !!}
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4 col-sm-5">
                    <div class="sidebar">
                        <!-- Start: Job Overview -->
                        <div class="card-boxed">
                            <div class="card-boxed-header">
                                <h4 class="title"><i class="ti-location-pin padd-r-10"></i>{{ __('In brief') }}</h4>
                            </div>
                            <div class="card-boxed-body">
                                <div class="side-list no-border">
                                    <ul>
                                        @if(!(bool)$job->hide_salary)
                                        <li><i class="ti-credit-card padd-r-10"></i>{{ __('Package') }}: € {{$job->salary_from}} {{ __('To') }} € {{$job->salary_to}} {{$job->getSalaryPeriod('salary_period')}}</li>
                                        @endif
                                        <li><i class="ti-location-pin padd-r-10"></i>{{$job->getCity('city')}}</li>
                                        <!-- If salary period is weekly, display hours a week -->
                                        @if($job->salary_period_id == 3 && $job->weekly_hours > 0)
                                        <li><i class="ti-time padd-r-10"></i>{{$job->weekly_hours}} {{ __('hours a week') }}</li>
                                        @endif
                                        @if($job->getDegreeLevel('degree_level'))
                                        <li><i class="ti-list padd-r-10"></i>{{$job->getDegreeLevel('degree_level')}}</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="jobButtons job-small-btn">
                                    <a href="{{route('email.to.friend', $job->slug)}}" class="btn theme-btn btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i> {{__('Email to Friend')}}</a>
                                    @if(Auth::check() && Auth::user()->isFavouriteJob($job->slug)) <a href="{{route('remove.from.favourite', $job->slug)}}" class="btn theme-btn btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Favourite Job')}} </a> @else <a href="{{route('add.to.favourite', $job->slug)}}" class="btn theme-btn btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Add to Favourite')}}</a> @endif
                                    <a href="{{route('report.abuse', $job->slug)}}" class="btn theme-btn report btn-sm"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{__('Report Abuse')}}</a>
                                </div>
                                
                            </div>
                        </div>
                        <!-- End: Job Overview -->
                    </div>
                </div>
            </div>
            <!-- End Row -->

            @if(isset($relatedJobs) && count($relatedJobs))
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mrg-bot-30">{{ __('Similar Jobs') }}</h4>
                </div>
            </div>
            <div class="row">
                <!-- Single Job -->                  
                        @foreach($relatedJobs as $relatedJob)
                        <?php $relatedJobCompany = $relatedJob->getCompany(); ?>
                        @if(null !== $relatedJobCompany)
                        <?php 
                            $jobTypeClass = '';
                            if ($relatedJob->job_type_id == 3) {
                                $jobTypeClass = \App\Job::FULLTYPE;
                            } else if ($relatedJob->job_type_id == 4 || $relatedJob->job_type_id == 1 || $relatedJob->job_type_id == 2) {
                                $jobTypeClass = \App\Job::PARTTYPE;
                            } else if ($relatedJob->job_type_id == 5 ) {
                                $jobTypeClass = \App\Job::INTERNSHIPTYPE;
                            }
                        ?>

                            <div class="col-md-3 col-sm-6">
                                <div class="service-box-card-2"> <span class="job-type {{ $jobTypeClass }}">{{$relatedJob->getJobType('job_type')}}</span>

                                    <div class="u-content">
                                        <div class="avatar box-80">
                                            <a href="{{route('job.detail', [$relatedJob->slug])}}" title="{{$relatedJob->title}}">
                                                {{--{{$company->printCompanyImage()}}
                                                <img class="img-responsive" src="" alt="">--}}
                                            </a>
                                        </div>
                                        <h5><a href="{{route('job.detail', [$relatedJob->slug])}}" title="{{$relatedJob->title}}">{{$relatedJob->title}}</a>
                                        </h5>
                                        <p class="text-muted">{{$relatedJob->getCity('city')}}, {{$relatedJob->getState('state')}}  </p>
                                    </div>
                                    @if($relatedJob->isJobExpired())
                                        <span class="jbexpire"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Job is expired')}}</span>
                                    @elseif(Auth::check() && Auth::user()->isAppliedOnJob($relatedJob->id))
                                        <div class="utf_apply_job_btn_item">
                                            <a href="javascript:;" class="btn apply applied"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Already Applied')}}</a>
                                        </div>
                                    @else
                                    <div class="utf_apply_job_btn_item">
                                        <a href="{{route('apply.job', $relatedJob->slug)}}" class="btn job-browse-btn btn-radius br-light">{{ __('Apply Now') }}</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @endforeach
            </div>
            @endif
        </div>
    </section>
    <!-- ====================== End Job Detail 2 ================ -->
</div>
@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .view_more{display:none !important;}
</style>
@endpush
@push('scripts') 
<script>
    $(document).ready(function ($) {
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);

        $(".view_more_ul").each(function () {
            if ($(this).height() > 100)
            {
                $(this).css('height', 100);
                $(this).css('overflow', 'hidden');
                //alert($( this ).next());
                $(this).next().removeClass('view_more');
            }
        });



    });
</script> 
@endpush