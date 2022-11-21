
<div class="row profilestat">

    <div class="col-lg-4 col-md-4 col-6">

        <div class="dashboard-stat">
            <div class="dashboard-stat-content">
            <h6 class="counter">{{Auth::user()->num_profile_views}}</h6>
            <strong>{{__('Profile Views')}}</strong> </div>
           
            <div class="dashboard-stat-icon"> <i class="ti-eye" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-6">   
        <div class="dashboard-stat">
            <a href="{{route('my.followings')}}">
            <div class="dashboard-stat-content">
        
                <h6 class="counter">{{Auth::user()->countFollowings()}}</h6>
                <strong>{{__('Followings')}}</strong>
            </div>
            <div class="dashboard-stat-icon"> 
                <i class="ti-user" aria-hidden="true"></i>
            </div>
            </a>
        </div>
      
    </div>

    <div class="col-lg-4 col-md-4 col-6">    
        <div class="dashboard-stat">
        <a href="{{url('my-profile#cvs')}}">
        <div class="dashboard-stat-content">
             <h6 class="counter">{{Auth::user()->countProfileCvs()}}</h6>
            <strong>{{__('My CV List')}}</strong></div>
            <div class="dashboard-stat-icon"> <i class="ti-file" aria-hidden="true"></i></div>
            </a>
         </div>
    </div>
</div>