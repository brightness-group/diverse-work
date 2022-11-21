@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<div class="wrapper">
<!-- Inner Page Title start --> 
@include('includes.inner_page_common_title', ['page_title'=>__($page_title)]) 
<!-- Inner Page Title end -->
    <div class="container">  
        @include('flash::message')  
        

        <!-- Job Detail start -->
        <div class="row">
            <div class="col-md-8 col-sm-7 applicant-home"> 
                <div class="card job-d-styel-1 no-stick">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center user_profile_img">
                            <div class="jobinfo">
                        <!-- Candidate Info -->
                        <div class="candidateinfo">
                            <div class="userPic">{{$user->printUserImage()}}</div>
                            <div class="title">
                               <h2> {{$user->getName()}}
                                @if((bool)$user->is_immediate_available)</h2>
                                <span><sup style="font-size:12px; color:#090;">{{__('Immediate Available For Work')}}</sup></span>
                                @endif
                            </div>
                        </div>                            
                    </div>
                            </div>
                            <div class="col-md-8 user_job_detail">
                            <div class="desi">{{$user->getLocation()}}</div>
                            <div class="loctext"><i class="fa fa-history" aria-hidden="true"></i> {{__('Member Since')}}, {{$user->created_at->format('M d, Y')}}</div>
                            
                            <div class="clearfix"></div>
                            <div class="jobButtons">
                                @if(isset($job) && isset($company))
                                @if(Auth::guard('company')->check() && Auth::guard('company')->user()->isFavouriteApplicant($user->id, $job->id, $company->id))
                                <a href="{{route('remove.from.favourite.applicant', [$job_application->id, $user->id, $job->id, $company->id])}}" class="btn theme-btn btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Short Listed Applicant')}} </a>
                                @else
                                <a href="{{route('add.to.favourite.applicant', [$job_application->id, $user->id, $job->id, $company->id])}}" class="btn theme-btn btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Short List This Applicant')}}</a>
                                 @endif
                                 @endif

                                 @if(null !== $profileCv)
                                    @if($user->is_resume_downloadable)
                                        <a href="{{asset('cvs/'.$profileCv->cv_file)}}" class="btn theme-btn btn-sm"><i class="fa fa-download" aria-hidden="true"></i> {{__('Download CV')}}</a>
                                    @endif
                                @endif
                                <a href="javascript:;" onclick="send_message()" class="btn"><i class="fa fa-envelope" aria-hidden="true"></i> {{__('Send Message')}}</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($user->getProfileSummary('summary') !== '')
                <div class="card no-stick">
                    <div class="card-header about">
                        <h3>{{__('About me')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="contentbox">
                            <p>{{$user->getProfileSummary('summary')}}</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card education">
                    <!-- Education start -->
                    <div class="card-header about">
                        <h3>{{__('Education')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="contentbox">
                            <div class="" id="education_div"></div>
                        </div>
                    </div>
                </div>

                <div class="card experience">
                <!-- Experience start -->
                    <div class="card-header about">
                        <h3>{{__('Experience')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="contentbox">
                        <div class="" id="experience_div"></div>
                        </div>
                    </div>
                </div>

                <div class="card portfolio">
                    <!-- Portfolio start -->
                    <div class="card-header about">
                    <h3>{{__('Portfolio')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="contentbox">
                            <div class="" id="projects_div"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-5 applicant-right"> 
				
				 <!-- Candidate Contact -->

                <div class="card-boxed">
                    <div class="card-boxed-header">
                        <h3 class="title">{{__('Candidate Contact')}}</h3>
                    </div>
                    <div class="card-boxed-body">
                        <div class="side-list no-border">
                            <div class="candidateinfo">            
                                @if(!empty($user->phone))
                                <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$user->phone}}">{{$user->phone}}</a></div>
                                @endif
                                 @if(!empty($user->mobile_num))
                                <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$user->mobile_num}}">{{$user->mobile_num}}</a></div>
                                @endif
                                @if(!empty($user->email))
                                <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$user->email}}">{{$user->email}}</a></div>
                                @endif
                                @if(!empty($user->street_address))
							    <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$user->street_address}}</div>
                                @endif
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- Candidate Detail start -->
                <div class="card-boxed">
                    <div class="card-boxed-header">
                        <h3 class="title">{{__('Candidate Detail')}}</h3>
                    </div>
                    <div class="card-boxed-body">
                        <div class="side-list no-border">
                        <ul class="jbdetail">
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Is Email Verified')}}</div>
                                <div class="col-md-6 col-xs-6"><span>{{((bool)$user->verified)? 'Yes':'No'}}</span></div>
                            </li>
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Immediate Available')}}</div>
                                <div class="col-md-6 col-xs-6"><span>{{((bool)$user->is_immediate_available)? 'Yes':'No'}}</span></div>
                            </li>
                            @if($user->getAge())
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Age')}}</div>
                                <div class="col-md-6 col-xs-6"><span>{{$user->getAge()}} {{ __('Years') }}</span></div>
                            </li>
                            @endif
                            @if($user->getGender('gender'))
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Gender')}}</div>
                                <div class="col-md-6 col-xs-6"><span>{{$user->getGender('gender')}}</span></div>
                            </li>
                            @endif
                            @if($user->getMaritalStatus('marital_status') != '')
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Marital Status')}}</div>
                                <div class="col-md-6 col-xs-6"><span>{{$user->getMaritalStatus('marital_status')}}</span></div>
                            </li>
                            @endif
                            @if($user->getJobExperience('job_experience') != '')
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Experience')}}</div>
                                <div class="col-md-6 col-xs-6"><span>{{$user->getJobExperience('job_experience')}}</span></div>
                            </li>
                            @endif
                            @if($user->getCareerLevel('career_level') != '')
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Career Level')}}</div>
                                <div class="col-md-6 col-xs-6"><span>{{$user->getCareerLevel('career_level')}}</span></div>
                            </li>
                            @endif
                            @if($user->current_salary)
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Current salary')}}</div>
                                <div class="col-md-6 col-xs-6"><span class="permanent">{{$user->current_salary}} {{$user->salary_currency}}</span></div>
                            </li>
                            @endif
                            @if($user->expected_salary)
                            <li class="row">
                                <div class="col-md-6 col-xs-6">{{__('Expected salary')}}</div>
                                <div class="col-md-6 col-xs-6"><span class="freelance">{{$user->expected_salary}} {{$user->salary_currency}}</span></div>
                            </li>
                            @endif        
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-boxed skill">
                    <div class="card-boxed-header">
                        <h3 class="title">{{__('Skills')}}</h3>
                    </div>
                    <div class="card-boxed-body">
                        <div class="side-list no-border">
                        <div id="skill_div"></div>
                        </div>
                    </div>
                </div>
                <div class="card-boxed language">
                    <div class="card-boxed-header">
                        <h3 class="title">{{__('Languages')}}</h3>
                    </div>
                    <div class="card-boxed-body">
                        <div class="side-list no-border">
                        <div id="language_div"></div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sendmessage" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="" id="send-form">
                @csrf
                <input type="hidden" name="seeker_id" id="seeker_id" value="{{$user->id}}">
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
    $(document).ready(function () {
    $(document).on('click', '#send_applicant_message', function () {
    var postData = $('#send-applicant-message-form').serialize();
    $.ajax({
    type: 'POST',
            url: "{{ route('contact.applicant.message.send') }}",
            data: postData,
            //dataType: 'json',
            success: function (data)
            {
            response = JSON.parse(data);
            var res = response.success;
            if (res == 'success')
            {
            var errorString = '<div role="alert" class="alert alert-success">' + response.message + '</div>';
            $('#alert_messages').html(errorString);
            $('#send-applicant-message-form').hide('slow');
            $(document).scrollTo('.alert', 2000);
            } else
            {
            var errorString = '<div class="alert alert-danger" role="alert"><ul>';
            response = JSON.parse(data);
            $.each(response, function (index, value)
            {
            errorString += '<li>' + value + '</li>';
            });
            errorString += '</ul></div>';
            $('#alert_messages').html(errorString);
            $(document).scrollTo('.alert', 2000);
            }
            },
    });
    });
    showEducation();
    showProjects();
    showExperience();
    showSkills();
    showLanguages();
    });
    function showProjects()
    {
    $.post("{{ route('show.applicant.profile.projects', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if(response == '') {
                    $('.portfolio').hide();
                } else {
                    $('#projects_div').html(response);
                }
            });
    }
    function showExperience()
    {
    $.post("{{ route('show.applicant.profile.experience', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if(response == '') {
                    $('.experience').hide();
                } else {
                    $('#experience_div').html(response);
                }
            });
    }
    function showEducation()
    {
    $.post("{{ route('show.applicant.profile.education', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if(response == '') {
                    $('.education').hide();
                } else {
                    $('#education_div').html(response);
                }
            });
    }
    function showLanguages()
    {
    $.post("{{ route('show.applicant.profile.languages', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if(response == '') {
                    $('.language').hide();
                } else {
                    $('#language_div').html(response);
                }
            });
    }
    function showSkills()
    {
    $.post("{{ route('show.applicant.profile.skills', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if(response == '') {
                    $('.skill').hide();
                } else {
                    $('#skill_div').html(response);
                }
            });
    }

    function send_message() {
        const el = document.createElement('div')
        el.innerHTML = "Please <a class='btn' href='{{route('login')}}' onclick='set_session()'>log in</a> as a Employer and try again."
        @if(null!==(Auth::guard('company')->user()))
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
                @if(null !== (Auth::guard('company')->user()))
                $.ajax({
                    url: "{{route('submit-message-seeker')}}",
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