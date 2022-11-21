@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 

@include('flash::message')

<!-- JS files for auto-complete -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<div class="wrapper">
    <!-- Inner Page Title start --> 
    @include('includes.inner_page_common_title', ['page_title'=>__('Job Seekers')]) 
    <!-- Inner Page Title end -->
    <div class="container">
    <section class="padd-top-0 padd-bot-80">
        <form action="{{route('job.seeker.list')}}" method="get">
            <!-- Search Result and sidebar start -->
            <div class="row"> 
            @include('includes.company_dashboard_menu')
                          
                <div class="col-lg-6"> 
                    <!-- Search List -->
                    <div class="row mrg-bot-20">
                        <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
                            <h4 class="job_vacancie">{{!empty($jobSeekers) && count($jobSeekers)>0 ? $jobSeekers->total() : 0}} {{ __('Candidates') }}</h4>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="fl-right short_by_filter_list">
                                <div class="search-wide short_by_til">
                                    <h5>{{ __('Sort By') }}</h5>
                                </div>
                                <div class="search-wide full">
                                    <select class="wide form-control" style="display: none;" onchange="this.form.submit()" name="order_by" id="order_by">
                                        <option value="1" {{ ( '1' == $order_by) ? 'selected="selected" focus' : '' }}>{{ __('Newest') }}</option>
                                        <option value="2" {{ ( '2' == $order_by) ? 'selected="selected" focus' : '' }}>{{ __('Oldest') }}</option>
                                    </select>
                                    <div class="nice-select wide form-control" tabindex="0"><span class="current">{{ ( '2' == $order_by) ? 'Oldest' : 'Newest' }}</span>
                                        <ul class="list">
                                            <li data-value="1" class="option {{ ( '1' == $order_by) ? 'selected focus' : '' }}"  >{{ __('Newest') }}</li>
                                            <li data-value="2" class="option {{ ( '2' == $order_by) ? 'selected focus' : '' }}" >{{ __('Oldest') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="job-opning-list job-seeker">
                        @if(isset($jobSeekers) && count($jobSeekers))
                        @foreach($jobSeekers as $jobSeeker)
                        <div class="card-list-wrp posted-job">
                            <div class="card-list">
                                <div class="card-list-header">
                                    <div class="card-list-job-logo">
                                        <div class="jobimg">{{$jobSeeker->printUserImage(100, 100)}}</div>
                                    </div>
                                    <h3 class="title"><a href="{{route('user.profile', $jobSeeker->id)}}">{{$jobSeeker->getName()}}</a></h3>
                                </div>
                                <div class="card-list-body">
                                    <div class="row">
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <div class="location"> {{$jobSeeker->getLocation()}}</div>
                                            <div class="clearfix"></div>
                                            <p>{{\Illuminate\Support\Str::limit($jobSeeker->getProfileSummary('summary'),150,'...')}}</p>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="listbtn"><a href="{{route('user.profile', $jobSeeker->id)}}">{{__('View Profile')}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="clearfix"></div>
                    <!-- Pagination Start -->
                    <div class="utf_flexbox_area padd-0">
                        <ul class="pagination">

                            @if(isset($jobSeekers) && count($jobSeekers))

                            {{ $jobSeekers->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}

                            @endif

                        </ul>
                    </div>
                    <!-- Pagination end -->
                </div> 
                                
                @include('includes.job_seeker_list_side_bar')  
				
            </div>
        </form>
    </section>
    </div>
</div>
@include('includes.footer')
@endsection
@push('scripts') 
<script>
    $(document).ready(function ($) {
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);
    });
</script>
@endpush