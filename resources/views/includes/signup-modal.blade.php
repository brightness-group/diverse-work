<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="myModalLabel1">
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-advance theme-bg" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="tab" href="#employer" role="tab"> <i class="ti-user"></i> {{ __('Job Seeker') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#candidate" role="tab"> <i class="ti-user"></i> {{ __('Job Provider') }}
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs -->
                <!-- Tab panels -->
                <div class="tab-content">
                    <!-- Employer Panel 1-->
                    <div class="tab-pane fade in active" id="employer" role="tabpanel">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group form-inline-style"> <span class="custom-checkbox">
                      <input type="checkbox" id="4">
                      <label for="4"></label>
{{ __('Remember Me') }} </span> <a href="javascript:void(0);" title="Forget" class="fl-right fl-none-sm">{{ __('Forgot Password?') }}</a>
      </div>
      <div class="form-group text-center">
          <button type="button" class="btn theme-btn full-width btn-m">{{ __('Login') }}</button>
      </div>
  </form>
  <div class="log-option"><span>OR</span></div>
  <div class="row">
      <div class="col-md-6"><a href="javascript:void(0);" title="" class="fb-log-btn log-btn"><i
                      class="fa fa-facebook"></i> Facebook</a></div>
      <div class="col-md-6"><a href="javascript:void(0);" title=""
                               class="gplus-log-btn log-btn"><i class="fa fa-google"></i>
              Google</a></div>
  </div>
</div>
<!--/.Panel 1-->

<!-- Candidate Panel 2-->
<div class="tab-pane fade" id="candidate" role="tabpanel">
  <form>
      <div class="form-group">
          <input type="text" class="form-control" placeholder="Email Address">
      </div>
      <div class="form-group">
          <input type="password" class="form-control" placeholder="Password">
      </div>
      <div class="form-group form-inline-style"> <span class="custom-checkbox">
<input type="checkbox" id="44">
<label for="44"></label>
{{ __('Remember Me') }} </span> <a href="javascript:void(0);" title="Forget" class="fl-right">{{ __('Forgot Password?') }}</a>
      </div>
      <div class="form-group text-center">
          <button type="button" class="btn theme-btn full-width btn-m">{{ __('Login') }}</button>
      </div>
  </form>
  <div class="log-option"><span>OR</span></div>
  <div class="row">
      <div class="col-md-6"><a href="javascript:void(0);" title="" class="fb-log-btn log-btn"><i
                      class="fa fa-facebook"></i> Facebook</a></div>
      <div class="col-md-6"><a href="javascript:void(0);" title=""
                               class="gplus-log-btn log-btn"><i class="fa fa-google"></i>
              Google</a></div>
  </div>
</div>
</div>
<!-- Tab panels -->
</div>
</div>
</div>
</div>