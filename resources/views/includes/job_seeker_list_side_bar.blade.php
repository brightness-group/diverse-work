<!-- Side Bar start -->
<div class="col-lg-3 col-md-3 col-sm-5 search-filter-sidebar">
    <div class="card-boxed padd-bot-0">
        <div class="card-boxed-body">
            <div class="search_widget_job">
                <div class="field_w_search">
                    <input type="hidden" name="search" value="{{Request::get('search', '')}}" class="form-control" placeholder="{{__('Enter Skills or job seeker details')}}" />
                </div>

                <div class="field_w_search">
                    <input class="typeahead form-control" type="text" name="city" id="city" value="{{$city}}" placeholder="All Locations" autocomplete="off">
                </div>                    
            </div>
        </div>
    </div>

    <div class="card-boxed padd-bot-0">
        <div class="card-boxed-body">
            <div class="row">
                <div class="field_w_search">
                    {!! Form::select('functional_area_id[]', ['' => __('Select Functional Area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')) !!}
                </div>                    
            </div>
        </div>
    </div>
    
    <!-- Candidates By Experience -->
    @if(isset($jobExperienceIdsArray) && count($jobExperienceIdsArray))
    <div class="card-boxed padd-bot-0">

        <div class="card-boxed-header br-0">
            <h4>{{ __('Experince') }} <a href="#experince1" data-toggle="collapse" class="collapsed"  aria-expanded="false"><i class="pull-right ti-plus blue-icon-circle" aria-hidden="true"></i></a></h4>
        </div>

        <div class="card-boxed-body collapse" id="experince1" aria-expanded="false" style="height: 0px;">
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
                        <span class="custom-checkbox"><input type="checkbox" name="job_experience_id[]" id="job_experience_{{$jobExperience->job_experience_id}}" value="{{$jobExperience->job_experience_id}}" {{$checked}}><label for="job_experience_{{$jobExperience->job_experience_id}}">{{$jobExperience->job_experience}}</label></span>
                   
                    </li>                    
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- Candidates By Experience end -->

    <!-- Candidates By Industry -->
    @if(isset($industryIdsArray) && count($industryIdsArray))
    <div class="card-boxed padd-bot-0">
        <div class="card-boxed-header br-0">
            <h4>{{ __('Industry') }} <a href="#industry" data-toggle="collapse" class="collapsed"  aria-expanded="false"><i class="pull-right ti-plus blue-icon-circle" aria-hidden="true"></i></a></h4>
        </div>

        <div class="card-boxed-body collapse" aria-expanded="false" id="industry">
            <div class="side-list no-border">
                <ul>
                    @foreach($industryIdsArray as $key=>$industry_id)
                    @php
                    $industry = App\Industry::where('industry_id','=',$industry_id)->lang()->active()->first();             
                    @endphp
                    @if(null !== $industry)
                    @php
                    $checked = (in_array($industry->industry_id, Request::get('industry_id', array())))? 'checked="checked"':'';
                    @endphp
                    <li>
                        <span class="custom-checkbox"><input type="checkbox" name="industry_id[]" id="industry_{{$industry->industry_id}}" value="{{$industry->industry_id}}" {{$checked}}><label for="industry_{{$industry->industry_id}}">{{$industry->industry}}</label></span>
                    </li>                    
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- Candidates By Industry end -->

    <!-- Candidates By Skill -->
    @if(isset($skillIdsArray) && count($skillIdsArray))
    <div class="card-boxed padd-bot-0">
        <div class="card-boxed-header br-0">
            <h4>{{ __('Skill') }} <a href="#skill" data-toggle="collapse" class="collapsed"  aria-expanded="false"><i class="pull-right ti-plus blue-icon-circle" aria-hidden="true"></i></a></h4>
        </div>

        <div class="card-boxed-body collapse" aria-expanded="false" id="skill">
            <div class="side-list no-border">
                <ul>
                    @foreach($skillIdsArray as $key=>$job_skill_id)
                    @php
                    $jobSkill = App\JobSkill::where('job_skill_id','=',$job_skill_id)->lang()->active()->first();             
                    @endphp
                    @if(null !== $jobSkill)
                    @php
                    $checked = (in_array($jobSkill->job_skill_id, Request::get('job_skill_id', array())))? 'checked="checked"':'';
                    @endphp
                    <li>
                        <span class="custom-checkbox"><input type="checkbox" name="job_skill_id[]" id="job_skill_{{$jobSkill->job_skill_id}}" value="{{$jobSkill->job_skill_id}}" {{$checked}}><label for="job_skill_{{$jobSkill->job_skill_id}}">{{$jobSkill->job_skill}}</label></span>
                    </li>                    
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- Candidates By Skill end -->

    <div class="searchform job-seeker">
        <div class="row">                   
            <div class="col-md-12">
                <button type="submit" class="btn theme-btn"><i class="fa fa-search" aria-hidden="true"></i> {{ __('Search Candidates') }}</button>
                <!-- Clear all filters -->
                <a href="/job-seekers"><font style="vertical-align: inherit;text-align: center;"><u>{{ __('Clear all filters') }}</u></font></a>
            </div>
        </div>
    </div>
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