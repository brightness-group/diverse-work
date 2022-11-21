@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Login')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        @include('flash::message')
       
            <div class="useraccountwrap">
                <div class="userccount">
                    <div class="userbtns">
                        <ul class="nav nav-tabs">
                            <?php
                            $c_or_e = old('candidate_or_employer', 'candidate');
                            //<a class="nav-link {{($c_or_e == 'candidate')? 'active':''}}" data-toggle="tab" href="#candidate" aria-expanded="true">{{__('Candidate')}}</a>
                            ?>
                            <li class="nav-item {{($c_or_e == 'candidate')? 'active':''}}"><a class="nav-link" data-toggle="tab" href="#candidate" aria-expanded="true">{{__('Candidate')}}</a></li>
                            <li class="nav-item {{($c_or_e == 'employer')? 'active':''}}"><a class="nav-link" data-toggle="tab" href="#employer" aria-expanded="false">{{__('Employer')}}</a></li>
                        </ul>
                    </div>
					
					
                    <div class="tab-content">
                        <div id="candidate" class="formpanel tab-pane {{($c_or_e == 'candidate')? 'active':''}}">
                        
                         
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="candidate_or_employer" value="candidate" />
                                <div class="formpanel">
                                    <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input id="password" type="password" class="form-control" name="password" value="" required placeholder="{{__('Password')}}">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>            
                                    <input type="submit" class="btn" value="{{__('Login')}}">
                                </div>
                                <!-- login form  end--> 
                            </form>
                            <!-- sign up form -->

                            <div class="log-option"><span>OR</span></div>
                            <div class="socialLogin">
                                <!-- <h5>{{__('Login with Social')}}</h5> -->
                                <div class="row">
                                    <!-- <div class="col-md-6"><a href="{{ url('login/jobseeker/google')}}" title="" class="fb-log-btn log-btn"><i class="fa fa-google"></i> Google</a></div> -->
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8"><a href="{{ url('login/jobseeker/facebook')}}" title="" class="fb-log-btn log-btn"><i class="fa fa-facebook"></i> Facebook</a></div>
                                    <!-- <div class="col-md-6"><a href="{{ url('login/jobseeker/twitter')}}" title="" class="twitter-log-btn log-btn"><i class="fa fa-twitter"></i>Twitter</a></div> -->
                                </div>
                                
                              
                            </div>

                    <div class="newuser"><i class="login-icon ti-user" aria-hidden="true"></i> {{__('New User')}}? <a href="{{route('register')}}">{{__('Register Here')}}</a></div>
                    <div class="newuser"><i class="login-icon ti-lock" aria-hidden="true"></i> {{__('Forgot Your Password')}}? <a href="{{ route('password.request') }}">{{__('Click here')}}</a></div>
                    <!-- sign up form end-->
                        </div>
                        <div id="employer" class="formpanel tab-pane {{($c_or_e == 'employer')? 'active':''}}">
                            
                            <form class="form-horizontal" method="POST" action="{{ route('company.login') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="candidate_or_employer" value="employer" />
                                <div class="formpanel">
                                    <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input id="password" type="password" class="form-control" name="password" value="" required placeholder="{{__('Password')}}">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>            
                                    <input type="submit" class="btn" value="{{__('Login')}}">
                                </div>
                                <!-- login form  end--> 
                            </form>
                            <!-- sign up form -->
                            <div class="log-option"><span>OR</span></div>
                            <div class="socialLogin">
                                <!-- <h5>{{__('Login with Social')}}</h5> -->
                                <div class="row">
                                    <!-- <div class="col-md-6"><a href="{{ url('login/jobseeker/google')}}" title="" class="fb-log-btn log-btn"><i class="fa fa-google"></i> Google</a></div> -->
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8"><a href="{{ url('login/jobseeker/facebook')}}" title="" class="fb-log-btn log-btn"><i class="fa fa-facebook"></i> Facebook</a></div>
                                </div>
                            </div>
                    <div class="newuser"><i class="login-icon ti-user" aria-hidden="true"></i> {{__('New User')}}? <a href="{{route('register')}}">{{__('Register Here')}}</a></div>
                    <div class="newuser"><i class="login-icon ti-lock" aria-hidden="true"></i> {{__('Forgot Your Password')}}? <a href="{{ route('company.password.request') }}">{{__('Click here')}}</a></div>
                    <!-- sign up form end-->
                        </div>
                    </div>
                    <!-- login form -->

                     

                </div>
            </div>
        
    </div>
</div>
@include('includes.footer')
@endsection
