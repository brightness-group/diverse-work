@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_common_title', ['page_title'=>__('Contact Us')])
<!-- Inner Page Title end -->
<div class="inner-page"> 
    <!-- About -->
    <div class="container">
        <div class="contact-wrap">
            <div class="title"> <span>{{__('We Are Here For Your Help')}}</span>
                <h2>{{__('GET IN TOUCH FAST')}}</h2>
            </div>            
                <!-- Contact Info -->
                <div class="contact-now">
				    <div class="row"> 
                      <!-- Google Map -->
                      <div class="col-md-12">
                        <div class="googlemap">
                            <iframe src="https://maps.google.it/maps?q={{urlencode(strip_tags($siteSetting->site_google_map))}}&output=embed" allowfullscreen width="100%" height="360" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                      </div>
                      <div class="col-md-8">
                      <div class="contact-form">

                        <div id="message"><br />@include('flash::message')</div>
                        <form method="post" action="{{ route('contact.us')}}" name="contactform" id="contactform">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6{{ $errors->has('full_name') ? ' has-error' : '' }}">                  
                                    {!! Form::text('full_name', null, array('id'=>'full_name', 'class'=>'form-control', 'placeholder'=>__('Full Name'), 'required'=>'required', 'class'=>'form-control', 'autofocus'=>'autofocus')) !!}                
                                    @if ($errors->has('full_name')) <span class="help-block"> <strong>{{ $errors->first('full_name') }}</strong> </span> @endif
                                </div>
                                <div class="col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">                  
                                    {!! Form::text('email', null, array('id'=>'email', 'class'=>'form-control', 'placeholder'=>__('Email'), 'required'=>'required')) !!}                
                                    @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                                </div>
                                <div class="col-md-6{{ $errors->has('phone') ? ' has-error' : '' }}">                  
                                    {!! Form::text('phone', null, array('id'=>'phone', 'class'=>'form-control', 'placeholder'=>__('Phone'))) !!}                
                                    @if ($errors->has('phone')) <span class="help-block"> <strong>{{ $errors->first('phone') }}</strong> </span> @endif
                                </div>
                                <div class="col-md-6{{ $errors->has('subject') ? ' has-error' : '' }}">                  
                                    {!! Form::text('subject', null, array('id'=>'subject', 'class'=>'form-control', 'placeholder'=>__('Subject'), 'required'=>'required')) !!}                
                                    @if ($errors->has('subject')) <span class="help-block"> <strong>{{ $errors->first('subject') }}</strong> </span> @endif
                                </div>
                                <div class="col-md-12{{ $errors->has('message_txt') ? ' has-error' : '' }}">                  
                                    {!! Form::textarea('message_txt', null, array('id'=>'message_txt', 'class'=>'form-control', 'placeholder'=>__('Message'), 'required'=>'required')) !!}                
                                    @if ($errors->has('message_txt')) <span class="help-block"> <strong>{{ $errors->first('message_txt') }}</strong> </span> @endif
                                </div>
                                <!-- <div class="col-md-12{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                    {!! app('captcha')->display() !!}
                                    @if ($errors->has('g-recaptcha-response')) <span class="help-block"> <strong>{{ $errors->first('g-recaptcha-response') }}</strong> </span> @endif
                                </div> -->
                                <div class="col-md-12">
                                    <button title="" class="button theme-btn" type="submit" id="submit">{{__('Submit Now')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                      </div>
                    
                    <div class="col-lg-4 column">
                        <div class="card contact-detail">                       
                            <div class="information">
                                <div class="inline"><span class="icon-style"><i class="ti-location-pin"></i></span> <p> {{ $siteSetting->site_street_address }}</p>  </div>
                            </div>                        
                        
                            <div class="information"> 
                                <div class="inline"><span class="icon-style"><i class="ti-email "></i></span> 
                                <p> <a href="mailto:{{ $siteSetting->mail_to_address }}"> {{ $siteSetting->mail_to_address }}</a></p>  
                            </div>
                            </div>                       
                        
                            <div class="information">
                                <div class="inline"><span class="icon-style"><i class="ti-mobile"></i></span> <p>
                                <a href="tel:{{ $siteSetting->site_phone_primary }}">{{ $siteSetting->site_phone_primary }}</a>
                                <a href="tel:{{ $siteSetting->site_phone_secondary }}">{{ $siteSetting->site_phone_secondary }}</a>
                                </p>
                                </div>
                              
                            </div>
                        
                        </div>
                    </div>
                   
                </div>
					
					 </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection