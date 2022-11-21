@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<div class="wrapper">
<!-- Inner Page Title start -->
@include('includes.inner_page_common_title', ['page_title'=>__('My Job Alerts')])
<!-- Inner Page Title end -->
    <div class="container">
        <div class="row"> @include('includes.user_dashboard_menu')
            <div class="col-lg-9 col-sm-8">
                <div class="card job-alert-list">
                    <div class="card-header">
                        <h4 class="title">{{__('My Job Alerts')}}</h4>
                    </div>
                        @if (count($alerts) > 0)
                            @if(isset($alerts) && count($alerts))
                                @foreach($alerts as $alert)
                                    @php
                                    if(null!==($alert->search_title)){
                                        $title = $alert->search_title;
                                    }
                                    @endphp

                                    @php
                                    $city = '';
                                    if(null!==($alert->city_id)){
                                        $city = \App\City::where('id',  $alert->city_id)->first();
                                    }
                                    @endphp

                                    @php
                                    $experienceStr = ''; $experiences = [];
                                    if(null!==($alert->job_experience_ids)){
                                        $ids = explode(',', $alert->job_experience_ids);
                                        foreach ($ids as $id) {
                                            $experience = \App\JobExperience::where('job_experience_id',  $id)->first();
                                            $experiences[] = $experience['job_experience'];
                                        }
                                        $experienceStr = (!empty($experiences)) ? implode(', ', $experiences) : '';
                                    }
                                    @endphp

                                    @php
                                    $careerLevelStr = ''; $careerLevels = [];
                                    if(null!==($alert->career_level_ids)){
                                        $ids = explode(',', $alert->career_level_ids);
                                        foreach ($ids as $id) {
                                            $careerLevel = \App\CareerLevel::where('career_level_id',  $id)->first();
                                            $careerLevels[] = $careerLevel['career_level'];
                                        }
                                        $careerLevelStr = (!empty($careerLevels)) ? implode(', ', $careerLevels) : '';
                                    }
                                    @endphp

                                    @php
                                    $salaryOfferStr = ''; $salaryOffers = [];
                                    if(null!==($alert->salary_offered_ids)){
                                        $ids = explode(',', $alert->salary_offered_ids);
                                        $salaryArray = \App\Helpers\DataArrayHelper::defaultSalaryOfferedArray();
                                        foreach ($ids as $id) {
                                            $salaryOffers[] = $salaryArray[$id];
                                        }
                                        $salaryOfferStr = (!empty($salaryOffers)) ? implode(', ', $salaryOffers) : '';
                                    }
                                    @endphp

                                    @php
                                    $degreeLevelStr = ''; $degreeLevels = [];
                                    if(null!==($alert->degree_level_ids)){
                                        $ids = explode(',', $alert->degree_level_ids);
                                        foreach ($ids as $id) {
                                            $degreeLevel = \App\DegreeLevel::where('degree_level_id',  $id)->first();
                                            $degreeLevels[] = $degreeLevel['degree_level'];
                                        }
                                        $degreeLevelStr = (!empty($degreeLevels)) ? implode(', ', $degreeLevels) : '';
                                    }
                                    @endphp

                                    <div class="card-list-wrp" id="delete_{{$alert->id}}">
                                        <div class="card-list">
                                            <div class="card-list-header">                                               
                                                <h4 class="title">@if(isset($title) && $title!=''){{$title}}@else{{__('Job Alert')}}@endif</h4>
                                            </div>
                                            <div class="card-list-body">
                                                <div class="row">
                                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                                        <ul class="can-skils">
                                                            <li>
                                                                <i class="ti-calendar padd-r-10"></i>{{$alert->created_at->format('M d,Y')}}
                                                                @if(isset($city) && $city!='')<i class="ti-location-pin padd-l-10"></i>{{$city->city}}@endif
                                                            </li>
                                                            @if(isset($experienceStr) && $experienceStr!='')<li><i class="ti-star  padd-r-10"></i>{{ __('Experience') }} : {{$experienceStr}}</li>@endif
                                                            @if(isset($careerLevelStr) && $careerLevelStr!='')<li><i class="ti-id-badge padd-r-10"></i>{{ __('Designation') }} : {{$careerLevelStr}}</li>@endif
                                                            @if(isset($salaryOfferStr) && $salaryOfferStr!='')<li><i class="ti-credit-card padd-r-10"></i>{{ __('Salary Offered') }}(€) : {{$salaryOfferStr}}</li>@endif
                                                            @if(isset($degreeLevelStr) && $degreeLevelStr!='')<li><i class="ti-credit-card padd-r-10"></i>{{ __('Education') }} : {{$degreeLevelStr}}</li>@endif
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="vrt-job-act"> 
                                                            <a href="javascript:;" onclick="delete_alert({{$alert->id}})" class="delete_alert btn-job light-gray-btn">{{ __('Delete') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div> 
                                    </div> 
                                @endforeach
                            @endif						
                        @else
                            {{__('No alerts found')}}
                        @endif
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')
    @endsection
    @push('scripts')
    <script>
        function delete_alert(id) {

            $.ajax({
                type: 'GET',
                url: "{{url('/')}}/delete-alert/" + id,
                success: function(response) {
                    if (response["status"] == true) {
                        $('#delete_' + id).hide();
                        swal({
                            title: "Success",
                            text: response["msg"],
                            icon: "success",
                            button: "OK",
                        });

                    } else {
                        swal({
                            title: "Already exist",
                            text: response["msg"],
                            icon: "error",
                            button: "OK",
                        });
                    }

                }
            });
        }
    </script>
    @include('includes.immediate_available_btn')
    @endpush