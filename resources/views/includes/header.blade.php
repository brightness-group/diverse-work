<header class="main-header">
    <nav class="navbar navbar-default navbar-mobile navbar-fixed white bootsnav">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i> </button>
                <a class="navbar-brand" href="{{url('/')}}">
                    <img class="logo-white" src="{{ !empty($siteSetting->site_logo) ? asset('/').'sitesetting_images/thumb/'.$siteSetting->site_logo
                                : asset('diverswerk/assets/img/Logo_White.png')}}"/>
                    <img class="logo-black" src="{{ !empty($siteSetting->alternate_site_logo)
                    ? asset('/').'sitesetting_images/thumb/'.$siteSetting->alternate_site_logo
                    : asset('diverswerk/assets/img/Logo_Black.png')}}"/>
                </a>

                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="dropdown {{ Request::url() == route('index') ? 'active' : '' }}">
                            <a href="{{url('/')}}">{{__('Home')}}</a>
                        </li>
                        <li><a href="{{route('job.list')}}">{{ __('Jobs') }}</a></li>
                        @if(Auth::guard('company')->check())
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle"
                                   data-toggle="dropdown">Employer</a>
                                <ul class="dropdown-menu animated fadeOutUp">
                                    <li><a href="{{route('company.home')}}">{{ __('Employer') }}</a></li>
                                    @if(Auth::guard('company')->check() && !empty(Auth::guard('company')->user()->slug))
                                        <li>
                                            <a href="{{ route('company.detail',Auth::guard('company')->user()->slug) }}">
                                                {{ __('Employer Detail') }}
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::guard('company')->check())
                                        <li><a href="{{ route('post.job') }}">{{ __('Add Job') }}</a></li>
                                    @endif
                                    <li><a href="{{route('posted.jobs')}}">{{ __('Manage Jobs') }}</a></li>
                                </ul>
                            </li>
                        @endif

                        @if(Auth::check())
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle"
                                   data-toggle="dropdown">{{ __('Candidate') }}</a>
                                <ul class="dropdown-menu animated fadeOutUp" style="display: none; opacity: 1;">
                                    <li><a href="{{route('my.profile')}}">{{ __('Employee') }}</a></li>
                                    <li><a href="{{route('my.profile')}}#add_edit_profile_summary">{{ __('Manage Resume') }}</a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="dropdown {{ Request::url() == route('blogs') ? 'active' : '' }}"><a href="{{ route('blogs') }}" class="nav-link">{{__('Blog')}}</a> </li>

                        {{--cms dynamic pages links based on show in top menu settings--}}
                        @foreach($show_in_top_menu as $top_menu)
                            @php
                                $cmsContent = App\CmsContent::getContentBySlug($top_menu->page_slug);
                            @endphp
                            <li class="dropdown {{ Request::url() == route('cms', $top_menu->page_slug) ? 'active' : '' }}">
                                <a href="{{ route('cms', $top_menu->page_slug) }}" class="nav-link">
                                    {{ $cmsContent->page_title }}
                                </a>
                            </li>
                        @endforeach
                        <li class="dropdown {{ Request::url() == route('faq') ? 'active' : '' }}">
                            <a href="{{ route('faq') }}">{{__('FAQ')}}</a>
                        </li>

                        <li class="dropdown {{ Request::url() == route('contact.us') ? 'active' : '' }}">
                            <a href="{{ route('contact.us') }}" class="nav-link">{{__('Contact')}}</a>
                        </li>
                    </ul>

                    {{-- company logout nav --}}
                    @if(Auth::guard('company')->check())
                        <ul class="nav navbar-nav navbar-right">
                            <li class="br-right">
                                <a class="btn-signup red-btn" href="{{ route('company.logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    {{__('Logout')}}
                                </a>
                            </li>
                            <form id="logout-form-header1" action="{{ route('company.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    @endif

                    {{-- candidate logout nav --}}
                    @if(Auth::check())
                        <ul class="nav navbar-nav navbar-right">
                            <li class="br-right">
                                <a class="btn-signup red-btn" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    {{__('Logout')}}
                                </a>
                            </li>
                            <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    @endif


                    {{-- no-auth nav --}}
                    @if(!Auth::user() && !Auth::guard('company')->user())
                        <ul class="nav navbar-nav navbar-right">
                            <li class="br-right">
                                <a class="btn-signup red-btn" href="{{route('login')}}" >
                                    <i class="login-icon ti-user"></i>
                                    {{ __('Login') }}
                                </a>
                            </li>
                            <li class="sign-up">
                                <a class="btn-signup red-btn" href="{{route('register')}}">
                                    <span class="ti-briefcase"></span>
                                    {{__('Register')}}
                                </a>
                            </li>
                        </ul>
                    @endif

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown userbtn"><a href="{{url('/')}}"><img src="{{asset('/')}}images/lang.png" alt="" class="userimg" /></a>
                            <ul class="dropdown-menu">
                                @foreach($siteLanguages as $siteLang)
                                <li><a href="javascript:;" onclick="event.preventDefault(); document.getElementById('locale-form-{{$siteLang->iso_code}}').submit();" class="nav-link">{{$siteLang->native}}</a>
                                    <form id="locale-form-{{$siteLang->iso_code}}" action="{{ route('set.locale') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="locale" value="{{$siteLang->iso_code}}"/>
                                        <input type="hidden" name="return_url" value="{{url()->full()}}"/>
                                        <input type="hidden" name="is_rtl" value="{{$siteLang->is_rtl}}"/>
                                    </form>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul> 
                </div>
            </div>
        </div>
    </nav>
</header>