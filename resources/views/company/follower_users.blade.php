@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<div class="wrapper">
<!-- Inner Page Title start --> 
@include('includes.inner_page_common_title', ['page_title'=>__('Company Followers')]) 
<!-- Inner Page Title end -->
    <div class="container">
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-12 col-sm-12 col-lg-9"> 
                <div class="card job-opning-list">
                    @if(isset($users) && count($users))
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
@include('includes.footer')
@endsection