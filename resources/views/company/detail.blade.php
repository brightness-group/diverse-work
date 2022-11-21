@extends('layouts.app')

@section('content')

<!-- Header start -->

@include('includes.header')

<!-- Header end -->

<div class="wrapper">
    <!-- Inner Page Title start -->

    @include('includes.inner_page_common_title', ['page_title'=>__('Company Detail')])

    <!-- Inner Page Title end -->

    <div class="container">

        @include('flash::message')

        <!-- Job Header start -->


        <div class="job-header">

            <div class="jobinfo">

                <div class="row">
                    <div class="col-md-8 col-sm-7">
                        <div class="card job-d-styel-1 no-stick">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center user_profile_img"> <a href="{{route('company.detail',$company->slug)}}">{{$company->printCompanyImage()}}</a>
                                        <h4 class="meg-0">{{$company->name}}</h4>
                                        <span>{{$company->getIndustry('industry')}}</span>
                                    </div>
                                    <div class="col-md-8 user_job_detail">
                                        <div class="col-sm-12 mrg-bot-10"> <i class="ti-user padd-r-10"></i> {{__('Member Since')}}, {{$company->created_at->format('M d, Y')}}</div>
                                        <div class="col-sm-12 mrg-bot-10"> <i class="ti-location-pin padd-r-10"></i> {{$company->location}}</div>
                                        <div class="col-sm-12 mrg-bot-10">
                                        <div class="jobButtons"> @if(Auth::check() && Auth::user()->isFavouriteCompany($company->slug)) 
                                            <a href="{{route('remove.from.favourite.company', $company->slug)}}" class="btn theme-btn btn-sm"><i class="ti-heart" aria-hidden="true"></i> {{__('Favourite Company')}} </a> @else 
                                            <a href="{{route('add.to.favourite.company', $company->slug)}}" class="btn theme-btn btn-sm"><i class="ti-heart" aria-hidden="true"></i> {{__('Add to Favourite')}}</a> @endif 
                                            <a href="{{route('report.abuse.company', $company->slug)}}" class="btn report theme-btn  btn-sm"><i class="ti-file" aria-hidden="true"></i> {{__('Report Abuse')}}</a> 
                                            <a href="javascript:;" onclick="send_message()" class="btn"><i class="fa fa-envelope" aria-hidden="true"></i> {{__('Send Message')}}</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card no-stick">
                            <div class="card-header">
                                <h4 class="title">{{__('About Company')}}</h4>
                            </div>
                            <div class="card-body">

                                <h3></h3>

                                <p>{!! $company->description !!}</p>

                            </div>
                        </div>

                        <div class="card job-opning-list">
                            <div class="card-header">
                                <h4 class="title">{{__('Job Openings')}}</h4>
                            </div>

                            @if(isset($company->jobs) && count($company->jobs))
                                @foreach($company->jobs as $companyJob)
                            <div class="card-list-wrp">                       
                                <div class="card-list">                               
                                    <div class="card-list-header">
                                        <div class="card-list-job-logo">
                                        <a href="{{route('job.detail', [$companyJob->slug])}}" title="{{$companyJob->title}}"> {{$company->printCompanyImage()}} </a>
                                        
                                        </div>
                                        <h4 class="title"><a href="{{route('job.detail', [$companyJob->slug])}}" title="{{$companyJob->title}}">{{$companyJob->title}}</a></h4>
                                        <span class="com-tagline"><a href="{{route('company.detail', $company->slug)}}" title="{{$company->name}}">{{$company->name}}</a></span> 
                                    </div>
                                    <div class="card-list-body">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-12 col-xs-12">
                                                <ul class="can-skils">
                                                    <li><strong>{{ __('Job Type') }}: </strong>  <label class="fulltime" title="{{$companyJob->getJobType('job_type')}}">{{$companyJob->getJobType('job_type')}}</label>,      <label class="partTime" title="{{$companyJob->getJobShift('job_shift')}}">{{$companyJob->getJobShift('job_shift')}}</label></li>
                                                    
                                                    <li><strong>{{ __('Skills') }}: </strong>
                                                        <div><span class="skill-tag">HTML</span> <span class="skill-tag">css</span> <span class="skill-tag">java</span> <span class="skill-tag">php</span></div>
                                                    </li>
                                                   
                                                    <li><strong>{{ __('Location') }}: </strong> <span>{{$companyJob->getCity('city')}}</span></li>
                                                </ul>

                                                <p>{{\Illuminate\Support\Str::limit(strip_tags($companyJob->description), 150, '...')}}</p>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="vrt-job-act"> 
                                                    <a class="btn-job theme-btn job-apply" href="{{route('job.detail', [$companyJob->slug])}}">{{__('View Detail')}}</a>
                                                    

                                                </div>
                                            </div>
                                          
                                        </div>
                                    </div>
                                  

                                </div>
                            </div>
                        @endforeach
                        @endif
                        </div>
                       
                    </div>

                    <div class="col-md-4 col-sm-5">

                        <div class="sidebar">
                            <!-- Start: Job Overview -->
                            <div class="card-boxed">
                            <div class="card-boxed-header">
                                    <h4 class="title"><i class="ti-user padd-r-10"></i>{{ __('Company Information') }}</h4>
                                </div>
                                @if(!Auth::user() && !Auth::guard('company')->user())

                                <div class="card-boxed-header">
                                    <p class=""><i class="ti-lock padd-r-10"></i>{{ __('Login to View contact details') }}</p>
                                    <a href="{{route('login')}}" class="btn theme-btn w-100">{{ __('Login') }}</a>
                                </div>
                                @else
                              
                                <div class="card-boxed-body">
                                    <div class="side-list no-border">

                                        <ul>
                                            @if(!empty($company->phone))
                                            <li><i class="ti-mobile padd-r-10"></i><a href="tel:{{$company->phone}}">{{$company->phone}}</a></li>
                                            @endif

                                            @if(!empty($company->email))
                                            <li><i class="ti-email padd-r-10"></i><a href="mailto:{{$company->email}}">{{$company->email}}</a></li>
                                            @endif

                                            @if(!empty($company->website))
                                            <li><i class="ti-world padd-r-10"></i><a href="{{$company->website}}" target="_blank">{{$company->website}}</a></li>
                                            @endif

                                            <li class="social-nav"><i class="ti-comment padd-r-10"></i>{!!$company->getSocialNetworkHtml()!!}</li>
                                        <ul>

                                    </div>
                                </div>

                                @endif
                            </div>
                            <!-- End: Job Overview -->

                            <!-- Start: Opening hour -->
                            <div class="card-boxed">
                                <div class="card-boxed-header">
                                    <h4 class="title"><i class="icon-briefcase padd-r-10"></i>{{__('Company Detail')}}</h4>
                                </div>
                                <div class="card-boxed-body">
                                    <div class="side-list">
                                        <ul>
                                            <li>{{__('Is Email Verified')}} <span class="f-right">{{((bool)$company->verified)? 'Yes':'No'}}</span></li>
                                            <li>{{__('Total Employees')}} <span class="f-right">{{$company->no_of_employees}}</span></li>
                                            <li>{{__('Established In')}} <span class="f-right">{{$company->established_in}}</span></li>
                                            <li>{{__('Current jobs')}} <span class="f-right">{{$company->countNumJobs('company_id',$company->id)}}</span></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Start: Location -->
                            <div class="card-boxed">
                                <div class="card-boxed-header">
                                    <h4 class="title"><i class="ti-location-pin padd-r-10"></i>{{ __('Location') }}</h4>
                                </div>
                                <div class="card-boxed-body">
                                    <iframe src="https://maps.google.it/maps?q={{urlencode(strip_tags($company->map))}}&output=embed" width="100%" height="360" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Buttons -->          
        </div>
    </div>

</div>

<!-- Modal -->

<div class="modal fade" id="sendmessage" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

            <form action="" id="send-form">

                @csrf

                <input type="hidden" name="company_id" id="company_id" value="{{$company->id}}">

                <div class="modal-header">

                    <h4 class="modal-title">{{ __('Send Message') }}</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <textarea class="form-control" name="message" id="message" cols="10" rows="7"></textarea>

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
    .formrow iframe {

        height: 78px;

    }
</style>

@endpush

@push('scripts')

<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '#send_company_message', function() {

            var postData = $('#send-company-message-form').serialize();

            $.ajax({

                type: 'POST',

                url: "{{ route('contact.company.message.send') }}",

                data: postData,

                //dataType: 'json',

                success: function(data) {

                    response = JSON.parse(data);

                    var res = response.success;

                    if (res == 'success') {

                        var errorString = '<div role="alert" class="alert alert-success">' +

                            response.message + '</div>';

                        $('#alert_messages').html(errorString);

                        $('#send-company-message-form').hide('slow');

                        $(document).scrollTo('.alert', 2000);

                    } else {

                        var errorString = '<div class="alert alert-danger" role="alert"><ul>';

                        response = JSON.parse(data);

                        $.each(response, function(index, value) {

                            errorString += '<li>' + value + '</li>';

                        });

                        errorString += '</ul></div>';

                        $('#alert_messages').html(errorString);

                        $(document).scrollTo('.alert', 2000);

                    }

                },

            });

        });

    });



    function send_message() {

        const el = document.createElement('div')

        el.innerHTML =

            "Please <a class='btn' href='{{route('login')}}' onclick='set_session()'>log in</a> as a Canidate and try again."

        @if(Auth::check())

        $('#sendmessage').modal('show');

        @else

        swal({

            title: "You are not Loged in",

            content: el,

            icon: "error",

            button: "OK",

        });

        @endif

    }

    if ($("#send-form").length > 0) {

        $("#send-form").validate({

            validateHiddenInputs: true,

            ignore: "",



            rules: {

                message: {

                    required: true,

                    maxlength: 5000

                },

            },

            messages: {



                message: {

                    required: "Message is required",

                }



            },

            submitHandler: function(form) {

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });

                @if(null !== (Auth::user()))

                $.ajax({

                    url: "{{route('submit-message')}}",

                    type: "POST",

                    data: $('#send-form').serialize(),

                    success: function(response) {

                        $("#send-form").trigger("reset");

                        $('#sendmessage').modal('hide');

                        swal({

                            title: "Success",

                            text: response["msg"],

                            icon: "success",

                            button: "OK",

                        });

                    }

                });

                @endif

            }

        })

    }
</script>

@endpush