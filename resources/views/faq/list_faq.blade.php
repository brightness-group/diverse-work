@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Page Title End -->
<div class="wrapper">
<!-- Inner Page Title start -->
@include('includes.inner_page_common_title', ['page_title'=>__('Frequently asked questions')])
<!-- Inner Page Title end -->
    <div class="container"> 
        <!--Question-->
        <div class="faqs">
            <div class="faq-accordiant">
                @if(isset($faqs) && count($faqs))
                    @foreach($faqs as $faq)
                        <div class="card">
                            <div class="card-boxed-header">
                                <h4>{!! $faq->faq_question !!} <a href="#faq{{ $faq->id }}" data-toggle="collapse" class="collapsed" aria-expanded="false"><i class="pull-right ti-plus blue-icon-circle" aria-hidden="true"></i></a></h4>
                            </div>
                            <div class="card-boxed-body collapse" id="faq{{ $faq->id }}" aria-expanded="true" >
                                    <div class="side-list no-border">
                                        <ul>
                                            <li>{!! $faq->faq_answer !!}</li>
                                        </ul>
                                    </div>
                            </div>
                        </div>

                    @endforeach
                @endif                 
            </div>          
        </div>

    </div>
</div>
@include('includes.footer')
@endsection
@push('scripts') 
<script>
    $("document").ready(function(){
        // Add down arrow icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-boxed-header").find(".pull-right").addClass("ti-minus").removeClass("ti-plus");
        });
        
        // Toggle right and down arrow icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-boxed-header").find(".pull-right").removeClass("ti-plus").addClass("ti-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-boxed-header").find(".pull-right").removeClass("ti-minus").addClass("ti-plus");
        });
    });
</script>
@endpush