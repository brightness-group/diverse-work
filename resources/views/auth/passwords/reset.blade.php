@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>'Reset Password'])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        
    <div class="useraccountwrap">
                <div class="userccount">

                    <h3 class="heading text-left">{{__('Reset Password')}}</h3>
                  
                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                               
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="{{__('Email Address')}}" value="{{ $email }}" required autofocus>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                             
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="{{__('Password')}}" required>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="{{__('Confirm Password')}}" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn ">
                                        {{__('Reset Password')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                   
                </div></div>
            
        
    </div>
</div>
@include('includes.footer')
@endsection