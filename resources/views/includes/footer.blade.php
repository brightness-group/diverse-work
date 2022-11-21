
@include('includes.subscribe')

<!-- ================= footer start ========================= -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4">

                {{-- footer alternate side logo --}}
                <a class="footer-logo" href="{{url('/')}}">
                    <img src="{{ !empty($siteSetting->alternate_site_logo)
                            ? asset('/').'sitesetting_images/thumb/'.$siteSetting->alternate_site_logo
                            : asset('diverswerk/assets/img/Logo_Black.png')}}" />
                </a>
                <p>{{__(!empty($siteSetting->footer_short_desc) ? $siteSetting->footer_short_desc : '')}}</p>
                <!-- Social Box -->
                <div class="f-social-box">
                    <ul>
                        @if(!empty($siteSetting->facebook_address))
                        <li>
                            <a href="{{$siteSetting->facebook_address}}">
                                <i class="fa fa-facebook facebook-cl"></i>
                            </a>
                        </li>
                        @endif
                        @if(!empty($siteSetting->twitter_address))
                            <li>
                                <a href="{{$siteSetting->twitter_address}}">
                                    <i class="fa fa-google google-plus-cl"></i>
                                </a>
                            </li>
                        @endif
                        @if(!empty($siteSetting->twitter_address))
                            <li>
                                <a href="{{$siteSetting->twitter_address}}">
                                    <i class="fa fa-twitter twitter-cl"></i>
                                </a>
                            </li>
                        @endif
                        @if(!empty($siteSetting->instagram_address))
                            <li>
                                <a href="{{$siteSetting->instagram_address}}">
                                    <i class="fa fa-instagram instagram-cl"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>{{__('Job Categories')}}</h4>
                        <ul>
                            @php
                                $industries = App\Industry::getUsingIndustriesForFooter(5);
                            @endphp
                            @foreach($industries as $industry)
                                <li>
                                    <a href="{{ route('job.list', ['industry_id[]'=>$industry->industry_id]) }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        {{$industry->industry}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <h4>{{__('Job Type')}}</h4>
                        <ul>
                            @php
                                $jobTypes = App\JobType::getJobTypesForFooter(5);
                            @endphp
                            @foreach($jobTypes as $jobType)
                                <li>
                                    <a href="{{ route('job.list', ['job_type_id[]'=>$jobType->job_type_id]) }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        {{$jobType->job_type}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <h4>{{__('Resources')}}</h4>
                        <ul>
                            @if(Auth::check())
                                <li><a href="{{route('my.profile')}}"><i class="fa fa-angle-double-right"></i>
                                        {{__('My Account')}}</a></li>
                            @endif
                           @if(Auth::guard('company')->check())
                                <li><a href="{{route('company.profile')}}"><i class="fa fa-angle-double-right"></i>
                                        {{__('My Account')}}</a></li>
                            @endif
                                @guest()
                                <li><a href="{{route('my.profile')}}"><i class="fa fa-angle-double-right"></i>
                                        {{__('My Account')}}</a></li>
                                @endguest
                                <li><a href="{{route('faq')}}"><i class="fa fa-angle-double-right"></i>
                                        {{ __('FAQ') }}</a></li>
                                <li><a href="{{route('company.listing')}}"><i class="fa fa-angle-double-right"></i>
                                        {{__('Employers')}}</a></li>
                        </ul>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <h4>{{__('Quick Links')}}</h4>
                        <ul>
                            <li>
                                <a href="{{ route('job.list') }}">
                                    <i class="fa fa-angle-double-right"></i>
                                    {{__('Jobs Listing')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact.us') }}"><i class="fa fa-angle-double-right"></i>
                                    {{__('Contact Us')}}
                                </a>
                            </li>
                            @foreach($show_in_footer_menu as $footer_menu)
                                @php
                                    $cmsContent = App\CmsContent::getContentBySlug($footer_menu->page_slug);
                                @endphp

                                <li class="{{ Request::url() == route('cms', $footer_menu->page_slug) ? 'active' : '' }}">
                                    <a href="{{ route('cms', $footer_menu->page_slug) }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        {{__($cmsContent->page_title)}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyright text-center">
                    <p> {{__('Copyright')}} &copy; {{date('Y')}} {{__('All Rights Reserved')}}.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Signup Code -->
@include('includes.signup-modal')
<!-- End Signup -->