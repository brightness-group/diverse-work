@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<div class="wrapper">
<!-- Inner Page Title start -->
@include('includes.inner_page_common_title', ['page_title'=>__('Favourite Jobs')])
<!-- Inner Page Title end -->
    <div class="container">
        <div class="row">
            @include('includes.user_dashboard_menu')

            <div class="col-md-12 col-sm-12 col-lg-9 col-12"> 
                <div class="card job-opning-list">

                    @if(isset($jobs) && count($jobs))
                    @foreach($jobs as $job)
                    @php $company = $job->getCompany(); @endphp
                    @if(null !== $company)
                    <div class="card-list-wrp favourite-job">
                        <div class="card-list">
                            <div class="card-list-header">
                                <div class="card-list-job-logo">
                                    <div class="jobimg">{{$company->printCompanyImage()}}</div>
                                </div>
                                <h3 class="title"><a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}">{{$job->title}}</a></h3>
                                <span class="com-tagline"><a href="{{route('company.detail', $company->slug)}}" title="{{$company->name}}">{{$company->name}}</a></span>
                            </div>
                            <div class="card-list-body">
                                <div class="row">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <div class="location">
                                            <label class="fulltime" title="{{$job->getJobShift('job_shift')}}">{{$job->getJobShift('job_shift')}}</label>
                                                - <span>{{$job->getCity('city')}}</span>
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                        <p>{{\Illuminate\Support\Str::limit(strip_tags($job->description), 150, '...')}}</p>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="listbtn"><a href="{{route('job.detail', [$job->slug])}}" class="btn-job theme-btn job-apply">{{__('View Details')}}</a></div>
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
@push('scripts')
@include('includes.immediate_available_btn')
@endpush