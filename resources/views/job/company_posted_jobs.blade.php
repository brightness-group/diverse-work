@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<div class="wrapper">
<!-- Inner Page Title start -->
@include('includes.inner_page_common_title', ['page_title'=>__('Company Posted Jobs')])
<!-- Inner Page Title end -->
    <div class="container"> @include('flash::message')
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-12 col-sm-12 col-lg-9"> 
                <div class="card job-opning-list">
                   
                    @if(isset($jobs) && count($jobs))
                    @foreach($jobs as $job)
                    @php $company = $job->getCompany(); @endphp
                    @if(null !== $company)
                    <div class="card-list-wrp posted-job" id="job_li_{{$job->id}}">
                        <div class="card-list">
                            <div class="card-list-header">
                                <div class="card-list-job-logo">
                                    <div class="jobimg">{{$company->printCompanyImage()}}</div>
                                </div>
                                <h3 class="title"><a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}">{{$job->title}}</a></h3>
                                <span class="com-tagline"><a href="{{route('company.detail', $company->slug)}}" title="{{$company->name}}">{{$company->name}}</a></span>
                            </div>
                            <div class="card-list-body">
                                <div class="row">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <div class="location">
                                            <label class="fulltime" title="{{$job->getJobShift('job_shift')}}">{{$job->getJobShift('job_shift')}}</label>
                                            - <span>{{$job->getCity('city')}}</span>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p>{{\Illuminate\Support\Str::limit(strip_tags($job->description), 150, '...')}}</p>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="top-btn">
                                            <div class="listbtn"><a href="{{route('list.favourite.applied.users', [$job->id])}}" class="btn theme-btn btn-sm">{{__('List Short Listed Candidates')}}</a></div>
                                            <div class="listbtn"><a href="{{route('list.applied.users', [$job->id])}}" class="btn theme-btn btn-sm">{{__('List Candidates')}}</a></div>
                                        </div>
                                        <div class="bottom-btn">
                                            <div class="listbtn"><a href="{{route('edit.front.job', [$job->id])}}" class="btn theme-btn btn-sm">{{__('Edit')}}</a></div>
                                            <div class="listbtn"><a href="javascript:;" onclick="deleteJob({{$job->id}});" class="btn theme-btn btn-sm">{{__('Delete')}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif
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
<script type="text/javascript">
    function deleteJob(id) {
    var msg = 'Are you sure?';
    if (confirm(msg)) {
    $.post("{{ route('delete.front.job') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
            .done(function (response) {
            if (response == 'ok')
            {
            $('#job_li_' + id).remove();
            } else
            {
            alert('Request Failed!');
            }
            });
    }
    }
</script>
@endpush