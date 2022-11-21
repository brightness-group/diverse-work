<div class="row profilestat">
   <div class="col-md-4 col-6">
      <div class="dashboard-stat">
         <a href="{{route('posted.jobs')}}">
            <div class="dashboard-stat-content">
               <h6 class="counter">{{Auth::guard('company')->user()->countOpenJobs()}}</h6>
               <strong>{{__('Open Jobs')}}</strong>
            </div>
            <div class="dashboard-stat-icon"> 
               <i class="ti-briefcase" aria-hidden="true"></i>
            </div>
         </a>
      </div>
   </div>
   <div class="col-md-4 col-6">
      <div class="dashboard-stat">
         <a href="{{route('company.followers')}}">
            <div class="dashboard-stat-content">
               <h6 class="counter">{{Auth::guard('company')->user()->countFollowers()}}</h6>
               <strong>{{__('Followers')}}</strong>
            </div>
            <div class="dashboard-stat-icon"> 
               <i class="ti-user" aria-hidden="true"></i>
            </div>
         </a>
      </div>
   </div>
   <div class="col-md-4 col-6">
      <div class="dashboard-stat">
         <a href="javascript:void(0)">
            <div class="dashboard-stat-content">
               <h6 class="counter">{{Auth::guard('company')->user()->availed_jobs_quota}} / {{Auth::guard('company')->user()->jobs_quota}}</h6>
               <strong>{{__('Available Jobs Quota')}}</strong>
            </div>
            <div class="dashboard-stat-icon"> 
               <i class="ti-user" aria-hidden="true"></i>
            </div>
         </a>
      </div>
   </div>
   <!-- <div class="col-md-4 col-6">
      <div class="dashboard-stat">
         <a href="{{route('company.messages')}}">
            <div class="dashboard-stat-content">
               <h6 class="counter">{{Auth::guard('company')->user()->countCompanyMessages()}}</h6>
               <strong>{{__('Messages')}}</strong>
            </div>
            <div class="dashboard-stat-icon"> 
               <i class="ti-email" aria-hidden="true"></i>
            </div>
         </a>
      </div>
   </div> -->
</div>