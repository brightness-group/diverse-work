<div class="col-lg-3"> 
<div class="usernavwrap card-boxed">
<div class="side-list no-border">
    <ul class="usernavdash">
        <li class="{{ request()->is('company-home') ? 'active' : '' }}" ><a href="{{route('company.home')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a></li>
        <li class="{{ request()->is('company-profile') ? 'active' : '' }}" ><a href="{{ route('company.profile') }}"><i class="ti-pencil" aria-hidden="true"></i> {{__('Edit Profile')}}</a></li>
        <li class="{{ request()->is('company/{slug}') ? 'active' : '' }}" ><a href="{{ route('company.detail', Auth::guard('company')->user()->slug) }}"><i class="ti-user" aria-hidden="true"></i> {{__('Company Public Profile')}}</a></li>
        <li class="{{ request()->is('post-job') ? 'active' : '' }}" ><a href="{{ route('post.job') }}"><i class="ti-desktop" aria-hidden="true"></i> {{__('Post Job')}}</a></li>
        <li class="{{ request()->is('posted-jobs') ? 'active' : '' }}" ><a href="{{ route('posted.jobs') }}"><i class="ti-briefcase" aria-hidden="true"></i> {{__('Company Jobs')}}</a></li>
        <li class="{{ request()->is('job-seekers') ? 'active' : '' }}" ><a href="{{ route('job.seeker.list') }}"><i class="ti-search" aria-hidden="true"></i> {{__('Search Candidates')}}</a></li>
        <li class="{{ request()->is('company-followers') ? 'active' : '' }}" ><a href="{{route('company.followers')}}"><i class="ti-id-badge" aria-hidden="true"></i> {{__('Company Followers')}}</a></li>
        <li><a href="{{route('company.messages')}}"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{__('Company Messages')}}</a>
        </li>
        <li><a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off " aria-hidden="true"></i> {{__('Logout')}}</a>
            <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
        </li>
    </ul>
	</div>
</div>
</div>