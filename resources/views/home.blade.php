@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<div class="wrapper">
<!-- Inner Page Title start --> 
@include('includes.inner_page_common_title', ['page_title'=>__('Dashboard')]) 
<!-- Inner Page Title end -->
    <div class="container">@include('flash::message')
        <div class="row"> @include('includes.user_dashboard_menu')
            <div class="col-lg-9">
				
		<div class="profileban">
			<div class="abtuser">
				<div class="row">
                <div class="col-md-12">
					<div class="card job-d-styel-1 no-stick">
					<div class="card-body">
						<div class="row">
							<div class="col-md-4 text-center user_profile_img"> 
                                {{auth()->user()->printUserImage()}}
                                <h4 class="meg-0">{{auth()->user()->name}}</h4>
                            </div>
						

                            <div class="col-md-8 user_job_detail">
                                @if(null !== (Auth::user()->getLocation()) && Auth::user()->getLocation() != '')
                                    <div class="col-sm-12 mrg-bot-10"> <i class="ti-location-pin padd-r-10"></i> {{Auth::user()->getLocation()}}</div>
                                @endif
                                @if(null !== (auth()->user()->phone) && auth()->user()->phone != '')
                                    <div class="col-sm-12 mrg-bot-10"> <i class="ti-mobile padd-r-10"></i> {{auth()->user()->phone}}</div>
                                @endif
                                    <div class="col-sm-12 mrg-bot-10"> <i class="ti-email padd-r-10"></i>{{auth()->user()->email}}</div>
                                    <div class="col-sm-12 mrg-bot-10">
                                        <div class="jobButtons">  
                                            <a href="{{ route('my.profile') }}" class="btn theme-btn btn-sm"><i class="ti-pencil" aria-hidden="true"></i>{{__('Edit Profile')}}</a>
                                        </div>
                                    </div>
				
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
				
				
				
				
				
				
				
				
				
				
				
				
				@include('includes.user_dashboard_stats')
                @if((bool)config('jobseeker.is_jobseeker_package_active'))
                @php        
                $packages = App\Package::where('package_for', 'like', 'job_seeker')->get();
                $package = Auth::user()->getPackage();
                if(null !== $package){
                $packages = App\Package::where('package_for', 'like', 'job_seeker')->where('id', '<>', $package->id)->where('package_price', '>=', $package->package_price)->get();
                }
                @endphp

                @if(null !== $package)
                @include('includes.user_package_msg')
                @include('includes.user_packages_upgrade')
                @else

                @if(null !== $packages)
                @include('includes.user_packages_new')
                @endif
                @endif
                @endif 
			
			
			 <div class="row">
                        <div class="col-lg-4">
                            <div class="card-list-wrp mt-1">
                                <div class="card-list">
                                    <div class="card-list-header">
                                        <h4 class="title"><i class="ti-briefcase" aria-hidden="true"></i> {{__('Recommended Jobs')}}</h4>
                                    </div>
                                    <div class="card-list-body">
                                        <div class="recomndjobs">
                                            @if(null!==($matchingJobs))
                                                @if (count($matchingJobs) > 0)
                                                    @foreach($matchingJobs as $match)
                                                    <div>
                                                        <h4><a href="{{route('job.detail', [$match->slug])}}">{{$match->title}}</a></h4>
                                                        <p>{{$match->getCompany()->name}}</p>
                                                    </div>
                                                    @endforeach
                                                
                                                @else
                                                {{__('No records')}}
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                   <div class="col-lg-8">
                   <div class="card-list-wrp mt-1">
                                <div class="card-list">
                                <div class="card-list-header">
                                        <h4 class="title"><i class="ti-user" aria-hidden="true"></i> {{__('My Followings')}}</h4>
                                    </div>
								
                                    <div class="card-list-body">

                                            <div class="row">
                                            <div class="col-md-9 col-sm-12 col-xs-12">
                                                @if(isset($followers) && null!==($followers))
                                                    @if (count($matchingJobs) > 0)
                                                        @foreach($followers as $follow) @php $company = DB::table('companies')->where('slug',$follow->company_slug)->where('is_active',1)->first(); @endphp
                                                        <div>
                                                            <p class="mb-0"> <i class="ti-home"></i>   {{$company->name}}</p>
                                                            <p> <i class="ti-location-pin"></i>  {{$company->location}}</p>
                                                            
                                                        </div>
                                                        @endforeach
                                                    @else
                                                    {{__('No records')}}
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12 text-right">
                                                @if(isset($followers) && null!==($followers))
                                                    @if(count($followers) > 0)
                                                    <!-- <a href="{{route('company.detail',$company->slug)}}" class="theme-btn btn-sm mb-1 d-block text-center">{{__('View Details')}}</a> -->
                                                    <a href="{{route('my.followings')}}" class="theme-btn btn-sm d-block text-center">{{ __('View All') }}</a>
                                                    @endif
                                                @endif
                                            </div>

                                            </div>

                                           
                                                    

                                                
                                    </div>
								</div>

                                </div>
							</div>
						</div>

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