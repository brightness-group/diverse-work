@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<div class="wrapper">
<!-- Inner Page Title start --> 
@include('includes.inner_page_common_title', ['page_title'=>__('Dashboard')]) 
<!-- Inner Page Title end -->
    <div class="container">@include('flash::message')
        <div class="row"> @include('includes.company_dashboard_menu')
            <div class="col-lg-9"> @include('includes.company_dashboard_stats')
        <?php
        if((bool)config('company.is_company_package_active')){        
        $packages = App\Package::where('package_for', 'like', 'employer')->get();
        $package = Auth::guard('company')->user()->getPackage();
        if(null !== $package){
        $packages = App\Package::where('package_for', 'like', 'employer')->where('id', '<>', $package->id)->where('package_price', '>=', $package->package_price)->get();
        }
        ?>
        
        <?php if(null !== $package){ ?>
        @include('includes.company_package_msg')
        @include('includes.company_packages_upgrade')
        <?php }elseif(null !== $packages){ ?>
        @include('includes.company_packages_new')
        <?php }} ?>

        <?php 
        $company = \App\Company::findOrFail(Auth::guard('company')->user()->id);
        $userIdsArray = $company->getLatestFollowerIdsArray();
        $users = \App\User::whereIn('id', $userIdsArray)->get();
        ?>
        <div class="clearfix"></div>
                <div class="row" style="margin-top:20px;">
                    <div class="card job-opning-list">
                        @if(isset($users) && count($users))
                        <div class="card-header"><h3 class="title">{{ __('Latest Followers') }}</h3></div>
                        @foreach($users as $user)
                        <div class="card-list-wrp">
                            <div class="card-list">
                                <div class="card-list-header">
                                    <div class="card-list-job-logo">
                                        <div class="jobimg">{{$user->printUserImage(100, 100)}}</div>
                                    </div>
                                    <h3 class="title"><a href="{{route('user.profile', $user->id)}}">{{$user->getName()}}</a></h3>
                                </div>
                                <div class="card-list-body">
                                    <div class="row">
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <div class="location"> {{$user->getLocation()}}</div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="listbtn flower-btn"><a class="btn theme-btn btn-sm" href="{{route('user.profile', $user->id)}}">{{__('View Profile')}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
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