<div class="col-lg-3">
	<div class="usernavwrap card-boxed">
        
    <div class="switchbox">
     
          
        <div class="txtlbl">{{__('Immediate Available')}}  <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{__('Are you immediate available')}}?" data-original-title="{{__('Are you immediate available')}}?" title="{{__('Are you immediate available')}}?"></i></div>
            
            <div class="custom-control custom-switch">
            <label class="label-switch switch-success"> @php
                $checked = (Auth::user()) ? (((bool)Auth::user()->is_immediate_available)? 'checked="checked"':'') :'';
                @endphp
                <input type="checkbox" name="is_immediate_available" id="is_immediate_available" class="switch-input switch switch-bootstrap status" {{$checked}} onchange="changeImmediateAvailableStatus({{Auth::user()->id}}, {{Auth::user()->is_immediate_available}});">
                <span class="switch-label lable" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> </label>
        </div>
      
        
        <div class="clearfix"></div>
    </div>
    <div class="side-list no-border">
                                  
    <ul class="usernavdash">
        <li class="{{ request()->is('home') ? 'active' : '' }}" ><a href="{{route('home')}}"><i class="ti-dashboard padd-r-10" aria-hidden="true"></i> {{__('Dashboard')}}</a>
        </li>
        <li class="{{ request()->is('my-profile') ? 'active' : '' }}" ><a href="{{ route('my.profile') }}"><i class="ti-pencil padd-r-10" aria-hidden="true"></i> {{__('Edit Profile')}}</a>
        </li>
        <li class="{{ request()->is('my-job-applications') ? 'active' : '' }}" ><a href="{{ route('my.job.applications') }}"><i class="fa fa-desktop" aria-hidden="true"></i> {{__('My Job Applications')}}</a>
        </li>
        <li class="{{ request()->is('my-favourite-jobs') ? 'active' : '' }}" ><a href="{{ route('my.favourite.jobs') }}"><i class="fa fa-heart" aria-hidden="true"></i> {{__('My Favourite Jobs')}}</a>
        </li>
        <li class="{{ request()->is('my-alerts') ? 'active' : '' }}" ><a href="{{ route('my-alerts') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i> {{__('My Job Alerts')}}</a>
        </li>
        <li><a href="{{url('my-profile#add_edit_profile_summary')}}"><i class="fa fa-file-text" aria-hidden="true"></i> {{__('Manage Resume')}}</a>
        </li>
        <li><a href="{{route('my.messages')}}"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{__('My Messages')}}</a>
        </li>
        <li class="{{ request()->is('my-followings') ? 'active' : '' }}" ><a href="{{route('my.followings')}}"><i class="fa fa-user-o" aria-hidden="true"></i> {{__('My Followings')}}</a>
        </li>
       
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off padd-r-10" aria-hidden="true"></i> {{__('Logout')}}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>

    </div>
		</div>
    <div class="row">
        <div class="col-md-12"></div>
    </div>
		
</div>