<div class="col-md-3 col-sm-5 search-filter-sidebar">
    <div class="card-boxed padd-bot-0">
        <div class="card-boxed-body">
            <div class="search_widget_job">
                <div class="field_w_search">
                    <a class="btn btn-job-alert theme-btn mb-1" href="javascript:;"><i class="fa fa-bell" ></i> {{__('Save Job Alert')}} </a>
                </div>
                <div class="field_w_search">
                    <input type="text" class="form-control" placeholder="{{__('Search Keywords')}}" id="search" name="search" value="{{Request::get('search', '')}}">
                </div>
                <div class="field_w_search">
                    <input class="typeahead form-control" type="text" name="city" id="city" value="{{$city}}" placeholder="{{__('All Locations')}}" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    <!-- Jobs By salary -->
    @if(isset($salaryOffered) && count($salaryOffered))
        <div class="card-boxed padd-bot-0">
            <div class="card-boxed-header">
                <h4>{{__('Offerd Salary')}}</h4>
            </div>
            <div class="card-boxed-body">
                <div class="side-list no-border">
                    <ul>
                        @foreach($salaryOffered as $key=>$salaryOffer)

                        @if(null !== $salaryOffer)
                        @php
                        $checked = (in_array($key, Request::get('salary_offered_id', array())))? 'checked="checked"':'';
                        @endphp
                        <li> <span class="custom-checkbox">
                                <input type="checkbox" name="salary_offered_id[]" id="salary_offered_{{$key}}" value="{{$key}}" {{$checked}}>
                                <label for="salary_offered_{{$key}}">{{__($salaryOffer)}}</label></span><span class="pull-right">{{ $salaryOfferedIdsArray[$key] }}</span>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <!-- Jobs By salary end -->

    <!-- Jobs By Job type -->
    @if(isset($jobTypeIdsArray) && count($jobTypeIdsArray))
        <div class="card-boxed padd-bot-0">
        <div class="card-boxed-header">
            <h4>{{__('Job Type')}}</h4>
        </div>
        <div class="card-boxed-body">
            <div class="side-list no-border">
                <ul>
                    @foreach($jobTypeIdsArray as $key=>$job_type_id)
                    @php
                    $jobType = App\JobType::where('job_type_id','=',$job_type_id)->lang()->active()->first();
                    @endphp
                    @if(null !== $jobType)
                    @php
                    $checked = (in_array($jobType->job_type_id, Request::get('job_type_id', array())))? 'checked="checked"':'';
                    @endphp
                    <li> <span class="custom-checkbox">
                            <input type="checkbox" name="job_type_id[]" id="job_type_{{$jobType->job_type_id}}" value="{{$jobType->job_type_id}}" {{$checked}}>
                            <label for="job_type_{{$jobType->job_type_id}}">{{$jobType->job_type}}</label>
                        </span><span class="pull-right">{{App\Job::countNumJobs('job_type_id', $jobType->job_type_id)}}</span>
                    </li>
                    @endif
                    @endforeach                    
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- Jobs By job type end -->

    <!-- Jobs By Functional area -->
    @if(isset($functionalAreaIdsArray) && count($functionalAreaIdsArray))
        <div class="card-boxed padd-bot-0">
            <div class="card-boxed-header">
                <h4>{{__('Functional Area')}}</h4>
            </div>
            <div class="card-boxed-body">
                <div class="side-list no-border">
                    <ul>
                        @foreach($functionalAreaIdsArray as $key=>$functional_area_id)
                            @php
                                $functionalArea = App\FunctionalArea::where('functional_area_id','=',$functional_area_id)->lang()->active()->first();
                            @endphp
                            @if(null !== $functionalArea)
                                @php
                                    $checked = (in_array($functionalArea->functional_area_id, Request::get('functional_area_id', array())))? 'checked="checked"':'';
                                @endphp
                                <li>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" name="functional_area_id[]" id="functional_area_{{$functionalArea->functional_area_id}}" value="{{$functionalArea->functional_area_id}}" {{$checked}}>
                                        <label for="job_type_{{$functionalArea->functional_area_id}}">{{$functionalArea->functional_area}}</label>
                                    </span>
                                    <span class="pull-right">{{App\Job::countNumJobs('functional_area_id', $functionalArea->functional_area_id)}}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <!-- Jobs By Functional area end -->

    <!-- Jobs By Designation -->
    @if(isset($careerLevelIdsArray) && count($careerLevelIdsArray))
        <div class="card-boxed padd-bot-0">
        <div class="card-boxed-header br-0">
            <h4>{{__('Designation')}} <a href="#designation" data-toggle="collapse" class="collapsed"
                    aria-expanded="false"><i class="pull-right ti-plus blue-icon-circle"
                        aria-hidden="true"></i></a></h4>
        </div>
        <div class="card-boxed-body collapse" id="designation" aria-expanded="false"
            style="height: 0px;">
            <div class="side-list no-border">
                <ul>
                    @foreach($careerLevelIdsArray as $key=>$career_level_id)
                    @php
                    $careerLevel = App\CareerLevel::where('career_level_id','=',$career_level_id)->lang()->active()->first();
                    @endphp
                    @if(null !== $careerLevel)
                    @php
                    $checked = (in_array($careerLevel->career_level_id, Request::get('career_level_id', array())))? 'checked="checked"':'';
                    @endphp
                    <li> <span class="custom-checkbox">
                            <input type="checkbox" name="career_level_id[]" id="career_level_{{$careerLevel->career_level_id}}" value="{{$careerLevel->career_level_id}}" {{$checked}}>
                            <label for="career_level_{{$careerLevel->career_level_id}}">{{$careerLevel->career_level}}</label>
                        </span><span class="pull-right">{{App\Job::countNumJobs('career_level_id', $careerLevel->career_level_id)}}</span>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- Jobs By Designation end -->

    <!-- Jobs By Experience -->
    @if(isset($jobExperienceIdsArray) && count($jobExperienceIdsArray))
        <div class="card-boxed padd-bot-0">
        <div class="card-boxed-header br-0">
            <h4>{{__('Experience')}} <a href="#experince" data-toggle="collapse"><i
                        class="pull-right ti-plus blue-icon-circle" aria-hidden="true"></i></a></h4>
        </div>

        <div class="card-boxed-body collapse" id="experince">
            <div class="side-list no-border">
                <ul>
                    @foreach($jobExperienceIdsArray as $key=>$job_experience_id)
                    @php
                    $jobExperience = App\JobExperience::where('job_experience_id','=',$job_experience_id)->lang()->active()->first();             
                    @endphp
                    @if(null !== $jobExperience)
                    @php
                    $checked = (in_array($jobExperience->job_experience_id, Request::get('job_experience_id', array())))? 'checked="checked"':'';
                    @endphp
                    <li>
                        <span class="custom-checkbox"><input type="checkbox" name="job_experience_id[]" id="job_experience_{{$jobExperience->job_experience_id}}" value="{{$jobExperience->job_experience_id}}" {{$checked}}><label for="job_experience_{{$jobExperience->job_experience_id}}">{{$jobExperience->job_experience}}</label>
                    </span><span class="pull-right">{{App\Job::countNumJobs('job_experience_id', $jobExperience->job_experience_id)}}</span>
                    </li>                    
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- Jobs By Experience end -->

    <!-- Jobs By Education -->
    @if(isset($degreeLevelIdsArray) && count($degreeLevelIdsArray))
        <div class="card-boxed padd-bot-0">
        <div class="card-boxed-header br-0">
            <h4>{{__('Education')}} <a href="#degree_level" data-toggle="collapse"><i
                        class="pull-right ti-plus blue-icon-circle" aria-hidden="true"></i></a></h4>
        </div>

        <div class="card-boxed-body collapse" id="degree_level">
            <div class="side-list no-border">
                <ul>
                    @foreach($degreeLevelIdsArray as $key=>$degree_level_id)
                    @php
                    $degreeLevel = App\DegreeLevel::where('degree_level_id','=',$degree_level_id)->lang()->active()->first();             
                    @endphp
                    @if(null !== $degreeLevel)
                    @php
                    $checked = (in_array($degreeLevel->degree_level_id, Request::get('degree_level_id', array())))? 'checked="checked"':'';
                    @endphp
                    <li>
                        <span class="custom-checkbox"><input type="checkbox" name="degree_level_id[]" id="degree_level_{{$degreeLevel->degree_level_id}}" value="{{$degreeLevel->degree_level_id}}" {{$checked}}><label for="degree_level_{{$degreeLevel->degree_level_id}}"> {{$degreeLevel->degree_level}} </label>
                    </span><span class="pull-right">{{App\Job::countNumJobs('degree_level_id', $degreeLevel->degree_level_id)}}</span>
                    </li>                    
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- Jobs By Education end -->

    <!-- Search job -->
    <button type="submit" class="btn theme-btn btn-radius btn-m" style="width:100%"><i class="fa fa-search" aria-hidden="true"></i> {{__('Search Jobs')}}</button> <br>
    <!-- Clear all filters -->
    <a href="/jobs"><font style="vertical-align: inherit;text-align: center;"><u>{{__('Clear all filters')}}</u></font></a>

</div>


  
<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>