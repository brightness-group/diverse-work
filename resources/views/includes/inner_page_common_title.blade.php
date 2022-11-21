@php
    $sliderImage = asset('diverswerk/assets/img/slider_bg.jpg');
    if(Request::is('cms/about-us')){
    	$bg_video = asset('diverswerk/assets/video/pexels-cottonbro-5722215.mp4');	
	}
    else if(Request::is('faq')){
    	$bg_video = asset('diverswerk/assets/video/pexels-cottonbro-5722224.mp4');
	}
    else if(Request::is('blog')){
    	$bg_video = asset('diverswerk/assets/video/pexels-karolina-grabowska-8538876.mp4');
	}else{
		$bg_video = asset('diverswerk/assets/video/pexels-karolina-grabowska-8540026.mp4');
	}    
@endphp
<style type="text/css">
	.page-banner .image{
        position: relative;
    }

    .page-banner .image:after {
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background: linear-gradient(to right, #323232 20%, rgba(50, 50, 50, 0.95) 50%, rgba(50, 50, 50, 0.1) 80%, rgba(50, 50, 50, 0) 100%);
    }
    
	video {
	    width: 100%; /* width needs to be set to 100% */
	    height: 400px; /* height needs to be set to 100% */
	    object-fit: cover;
	    left: 0;
	    top: 0;
	}
</style>

<div id="titlebar" class="page-banner" >
    <div class="image">
    	<video playsinline autoplay muted loop poster="{{$sliderImage}}" id="bgvid">
		    <source src="{{$bg_video}}" type="video/mp4">
		</video>
	</div>
    
    <div class="container">
       <div class="banner-text">
           <span class="sub-title"><div class="breadCrumb"><a href="{{route('index')}}">{{__('Home')}}</a> / <span>{{__($page_title)}}</span></div></span>
           <h2 class="title">{{$page_title}}</h2>
       </div>
     
   </div>
</div>