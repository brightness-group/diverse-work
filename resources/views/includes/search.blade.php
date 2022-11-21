<!-- ======================= Start Banner ===================== -->
@php
    $sliderImage = count($sliders) > 0
           ? ImgUploader::print_slider_image_src('slider_images/'.$sliders->pluck('slider_image')->first() )
           : asset('diverswerk/assets/img/slider_bg.jpg');
    $jobs = MiscHelper::getOpenJobs();

    $industries = App\Industry::getUsingIndustries(4,false);
    $countries = App\Helpers\DataArrayHelper::langCountriesArray();
    $functionalAreas = App\Helpers\DataArrayHelper::langFunctionalAreasArray();

    $bg_video = asset('diverswerk/assets/video/pexels-cottonbro-5721605.mp4');
    
@endphp

<div class="banner-section viewport-header" style="background-image:url({{$sliderImage}});" data-overlay="8">

    <video playsinline autoplay muted loop poster="{{$sliderImage}}" id="bgvid">
        <source src="{{$bg_video}}" type="video/mp4">
    </video>

    <div class="container" style="position: absolute; z-index: 1">
        <div class="col-md-8 col-sm-10">
            <div class="caption cl-white home_two_slid">
                <h2>{{__('Search Between More Then')}} <span class="theme-cl">
                        {{!empty($jobs) && count($jobs)>0 ? count($jobs) : 0}}
                    </span> {{__('Open Jobs')}}.</h2>
                <p>{{__('Trending Jobs Keywords')}}:
                    @foreach($industries as $industry)
                        <span class="trending_key"><a href="{{ route('job.list', ['industry_id[]'=>$industry->industry_id]) }}">
                            {{$industry->industry}}</a></span>
                    @endforeach
                </p>
            </div>
            <form action="/jobs" method="get">
                <fieldset class="utf_home_form_one">
                    <div class="col-md-4 col-sm-4 padd-0">
                        <input type="text" class="form-control br-1" placeholder="{{__('Search Keywords...')}}" id="search" name="search">
                    </div>
                    <div class="col-md-3 col-sm-3 padd-0">
                        <select class="wide form-control br-1 long-list" style="display: none;" id="city_id" name="city_id[]">
                            <option data-display="{{__('Location')}}" value="" >{{ __('All') }}</option>
                            @foreach($cities as $key => $city)
                                <option value="{{$key}}">{{$city}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 padd-0">
                        <select class="wide form-control long-list" style="display: none;" id="functional_area_id" name="functional_area_id[]">
                            <option data-display="{{__('Category')}}" value="" >{{ __('Show All') }}</option>
                            @foreach($functionalAreas as $key => $functionalArea)
                                <option value="{{$key}}">{{$functionalArea}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 padd-0 m-clear">
                        <button type="submit" class="btn theme-btn cl-white seub-btn">{{__('Search')}}</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- ======================= End Banner ===================== -->


{{-- disabled the previous code code - set for further use in search functionality --}}
@if(1===2)
    @if((bool)$siteSetting->is_slider_active)
        <!-- Revolution slider start -->
        <div class="tp-banner-container">
            <div class="tp-banner" >
                <ul>
                @if(isset($sliders) && count($sliders))
                    @foreach($sliders as $slide)
                        <!--Slide-->
                            <li data-slotamount="7" data-transition="slotzoom-horizontal" data-masterspeed="1000" data-saveperformance="on"> <img alt="{{$slide->slider_heading}}" src="{{asset('/')}}images/slider/dummy.png" data-lazyload="{{ ImgUploader::print_image_src('/slider_images/'.$slide->slider_image) }}">
                                <div class="caption lft large-title tp-resizeme slidertext1" data-x="left" data-y="150" data-speed="600" data-start="1600">{{$slide->slider_heading}}</div>
                                <div class="caption lfb large-title tp-resizeme sliderpara" data-x="left" data-y="200" data-speed="600" data-start="2800">{!!$slide->slider_description!!}</div>
                                <div class="caption lfb large-title tp-resizeme slidertext5" data-x="left" data-y="280" data-speed="600" data-start="3500"><a href="{{$slide->slider_link}}">{{$slide->slider_link_text}}</a></div>
                            </li>
                            <!--Slide end-->
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <!-- Revolution slider end -->
        <!--Search Bar start-->
        <div class="searchbar searchblack">
            <div class="container">
                @include('includes.search_form')
            </div>
        </div>
        <!-- Search End -->
    @else
        <div class="searchwrap">
            <div class="container">
                <h3>{{__('One million success stories')}}. <span>{{__('Start yours today')}}.</span></h3>

            @include('includes.search_form')

            <!-- button start
        <div class="getstarted"><a href="{{url('/')}}"><i class="fa fa-user" aria-hidden="true"></i> {{__('Get Started Now')}}</a></div>
        button end -->

            </div>
        </div>
    @endif
@endif