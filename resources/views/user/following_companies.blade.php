@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<div class="wrapper">
<!-- Inner Page Title start --> 
@include('includes.inner_page_common_title', ['page_title'=>__('My Followings')]) 
<!-- Inner Page Title end -->
    <div class="container">
        <div class="row">
            @include('includes.user_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
                <div class="card job-opning-list">
                    <div class="card-header">
                        <h4 class="title">{{__('My Followings')}}</h4>
                    </div>                   
                                       
                    <!-- job start --> 
                    @if(isset($companies) && count($companies))
                    @foreach($companies as $company)
                    <div class="card-list-wrp">    
                        <div class="card-list">  
                            <div class="card-list-header">
                                <div class="card-list-job-logo">
                                {{$company->printCompanyImage()}}
                                    
                                    </div>
                                    <h4 class="title"><a href="{{route('company.detail', $company->slug)}}" title="{{$company->name}}">{{$company->name}}</a></h4>
                                    <span class="com-tagline">{{$company->getLocation()}}</span> 
                                </div> 
                                <div class="card-list-body">
                                <div class="row">
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                <p>{{\Illuminate\Support\Str::limit(strip_tags($company->description), 150, '...')}}</p>
                                </div>
                                    
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="vrt-job-act"><a href="{{route('company.detail', $company->slug)}}" class="theme-btn btn-job ">{{__('View Details')}}</a></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- job end --> 
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