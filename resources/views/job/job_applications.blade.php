@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<div class="wrapper">
<!-- Inner Page Title start -->
@include('includes.inner_page_common_title', ['page_title'=>__('Job Applications')])
<!-- Inner Page Title end -->
    <div class="container">
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-12 col-sm-12 col-lg-9 col-12"> 
                <div class="card job-opning-list">

                @if(isset($job_applications) && count($job_applications))
                    @foreach($job_applications as $job_application)
                    @php
                    $user = $job_application->getUser();
                    $job = $job_application->getJob();
                    $company = $job->getCompany();             
                    $profileCv = $job_application->getProfileCv();
                    @endphp
                    @if(null !== $job_application && null !== $user && null !== $job && null !== $company && null !== $profileCv)
                    <div class="card-list-wrp job-application">
                        <div class="card-list">
                            <div class="card-list-header">
                                <div class="card-list-job-logo">
                                    <div class="jobimg">{{$user->printUserImage(100, 100)}}</div>
                                </div>
                                <h3 class="title"><a href="{{route('applicant.profile', $job_application->id)}}">{{$user->getName()}}</a></h3>
                                <div class="com-tagline">{{$job_application->expected_salary}} {{$job_application->salary_currency}} <span>/ {{$job->getSalaryPeriod('salary_period')}}</span></div>
                            </div>
                            <div class="card-list-body">
                                <div class="row">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <div class="location"> {{$user->getLocation()}}</div>
                                        <div class="clearfix"></div>
                                        <p>{{\Illuminate\Support\Str::limit($user->getProfileSummary('summary'),150,'...')}}</p>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="listbtn"><a href="{{route('applicant.profile', $job_application->id)}}">{{__('View Profile')}}</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection