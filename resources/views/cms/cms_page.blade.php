@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_common_title', ['page_title'=>$cmsContent->page_title])
<!-- Inner Page Title end -->
<div class="about-wraper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
             
                <p>{!! $cmsContent->page_content !!}</p>
            </div>
          
        </div>
        
    </div>  
</div>
@include('includes.footer')
@endsection