
<!-- ================= Job start ========================= -->
@if(isset($latestJobs) && count($latestJobs))
    <section class="padd-top-80 padd-bot-80">
    <div class="container">
        <h2 class="text-center mrg-bot-30 ">{{__('Recent Jobs')}}</h2>
        <div class="tab-content">
            <div class="tab-pane fade in show active" id="recent" role="tabpanel">
                <div class="row">

                @foreach($latestJobs as $latestJob)
                    <?php $company = $latestJob->getCompany(); ?>
                    @if(null !== $company)
                            <div class="col-md-3 col-sm-6">
                                <div class="service-box-card-2">
                                    <?php 
                                    $jobTypeClass = '';
                                    if ($latestJob->job_type_id == 3) {
                                        $jobTypeClass = \App\Job::FULLTYPE;
                                    } else if ($latestJob->job_type_id == 4 || $latestJob->job_type_id == 1 || $latestJob->job_type_id == 2) {
                                        $jobTypeClass = \App\Job::PARTTYPE;
                                    } else if ($latestJob->job_type_id == 5 ) {
                                        $jobTypeClass = \App\Job::INTERNSHIPTYPE;
                                    }
                                    ?>
                                    <span class="job-type {{ $jobTypeClass }}">{{$latestJob->getJobType('job_type')}}</span>
                                    <div class="u-content">
                                        <div class="avatar box-80">
                                            <a href="{{route('job.detail', [$latestJob->slug])}}" title="{{$latestJob->title}}">
                                                {{--{{$company->printCompanyImage()}}
                                                <img class="img-responsive" src="" alt="">--}}
                                            </a>
                                        </div>
                                        <h5><a href="{{route('job.detail', [$latestJob->slug])}}">{{$latestJob->title}}</a></h5>
                                        <p class="text-muted">{{$latestJob->getCity('city')}}, {{$latestJob->getState('state')}}  </p>
                                    </div>
                                    @if($latestJob->isJobExpired())
                                        <span class="jbexpire"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Job is expired')}}</span>
                                    @elseif(Auth::check() && Auth::user()->isAppliedOnJob($latestJob->id))
                                        <div class="utf_apply_job_btn_item">
                                            <a href="javascript:;" class="btn apply applied"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Already Applied')}}</a>
                                        </div>
                                    @else
                                    <div class="utf_apply_job_btn_item">
                                        <a href="{{route('apply.job', $latestJob->slug)}}" class="btn job-browse-btn btn-radius br-light">{{ __('Apply Now') }}</a>
                                    </div>
                                    @endif

                                </div>
                            </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12 mrg-top-20 text-center">
            <a href="{{route('job.list')}}" class="btn theme-btn btn-m">{{__('Browse All Jobs')}}</a>
        </div>
    </div>
</section>
@endif
@if(1===2)
    <div class="section">
        <div class="container">
            <!-- title start -->
            <div class="titleTop">
                <h3>{{__('Latest')}} <span>{{__('Jobs')}}</span></h3>
            </div>
            <!-- title end -->

            <ul class="jobslist newjbox row">
            @if(isset($latestJobs) && count($latestJobs))
                @foreach($latestJobs as $latestJob)
                    <?php $company = $latestJob->getCompany(); ?>
                    @if(null !== $company)
                        <!--Job start-->
                            <li class="col-md-4">
                                <div class="jobint">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <a href="{{route('job.detail', [$latestJob->slug])}}"
                                               title="{{$latestJob->title}}">
                                                {{$company->printCompanyImage()}}
                                            </a>
                                        </div>
                                        <div class="col-md-9 col-sm-9">
                                            <h4><a href="{{route('job.detail', [$latestJob->slug])}}"
                                                   title="{{$latestJob->title}}">{{$latestJob->title}}</a></h4>
                                            <div class="company"><a href="{{route('company.detail', $company->slug)}}"
                                                                    title="{{$company->name}}">{{$company->name}}</a> -
                                                <span>{{$latestJob->getCity('city')}}</span></div>
                                            <div class="jobloc">
                                                <label class="fulltime"
                                                       title="{{$latestJob->getJobType('job_type')}}">{{$latestJob->getJobType('job_type')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!--Job end-->
                        @endif
                    @endforeach
                @endif
            </ul>
            <!--view button-->
            <div class="viewallbtn"><a href="{{route('job.list')}}">{{__('View All Latest Jobs')}}</a></div>
            <!--view button end-->
        </div>
    </div>
@endif