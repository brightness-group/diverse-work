<div class="card job-opning-list center-content">
    <div class="card-list-wrp">
        
        <div class="card-list">
            <div class="card-list-header">
                <div class="card-list-profile-logo">
                    <div class="profileimg">
                        {{$seeker->printUserImage(100, 100)}} 
                    </div>
                </div>
                <div class="main-profile">
                    <h3 class="title"><a href="#">{{$seeker->name}}</a></h3>
                </div>
            </div>
            <div class="list-group list-group-flush messages message{{$seeker->id}}">
                @if(null !== ($messages))
                <?php foreach($messages as $msg){?>
                <div class="<?php if($msg->type=='message'){?>chate-box-left<?php }else{?>chate-box-right<?php }?>">
                    <div class="list-group-item <?php if($msg->type=='message'){?>friend-message<?php }else{?>my-message<?php }?>">
                        <span><?php if($msg->type=='message'){?>{{$seeker->name}}<?php }else{?>{{$company->name}}<?php }?></span>{{$msg->message}}
                        <?php if($msg->type=='message'){?> 
                        {{$seeker->printUserImage(100, 100)}}
                        <?php }else{?>
                        {{$company->printCompanyImage()}} 
                        <?php }?>
                    </div>
                    <div class="date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $msg->updated_at)->format('l g:i a') }}</div>
                </div>
                <?php } ?>
                @endif
            </div>
        </div>

        <form class="form-submit-message">
            @csrf
            <input type="hidden" name="seeker_id" value="{{$seeker->id}}">
            <div class="form-group">
                <textarea class="form-control" rows="2" name="message" placeholder="{{ __('Type Your Message here') }}.."></textarea>
                <button type="submit" class="btn btn-primary" id="inputGroupPrepend3"><i class="fa fa-paper-plane-o"  aria-hidden="true"></i></button>
            </div>
        </form>

    </div>
</div>

<script>
    $(document).ready(function(){
    if ($(".form-submit-message").length > 0) {
          $(".form-submit-message").validate({
              validateHiddenInputs: true,
              ignore: "",
    
              rules: {
                  message: {
                      required: true,
                      maxlength: 5000
                  },
              },
              messages: {
    
                  message: {
                      required: "Message is required",
                  }
    
              },
              submitHandler: function(form) {
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url: "{{route('company.submit-message')}}",
                      type: "POST",
                      data: $('.form-submit-message').serialize(),
                      success: function(res) {
                        console.log(res);
                          $(".form-submit-message").trigger("reset");
                           $('.messages').html('');
                            $('.messages').html(res);
                            $(".messages").scrollTop(100000000000000);
                            $('.messages').off('scroll');
                      }
                  });
              }
          })
      }
    })
    
    
    
    clearInterval(chat_interval);
    var chat_interval=setInterval(function()
    {
    $.ajax({
          type: 'get',
          dataType: 'json',
          url: "{{route('append-only-message')}}",
          data: {
          '_token': $('input[name=_token]').val(),
          'seeker_id': "{{$seeker->id}}",
        },
        success: function(res) {
          $('.message'+res.seeker_id).html(res.html_data);
        }
      });
    }, 5000);
    
</script>