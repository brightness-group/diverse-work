@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<div class="wrapper messageWrap">

<!-- Inner Page Title start --> 
@include('includes.inner_page_common_title', ['page_title'=>__('My Messages')])
<!-- Inner Page Title end --> 
    <div class="message-page">
      <div class="container">
            <div class="col-lg-3">
                <div class="card job-opning-list left-bar">
                    
                    @if(count($companies) > 0)
                        <?php foreach($companies as $company){?>
                            <div class="card-list-wrp" id="adactive{{ $company->id}}">
                                <div class="card-list" data-gift="{{$company->id}}" id="company_id_{{$company->id}}"  onclick="show_messages({{ $company->id}})">
                                    <div class="card-list-header">
                                        <div class="card-list-profile-logo">
                                            <div class="profileimg">
                                                {{$company->printCompanyImage(100, 100)}}
                                            </div>
                                        </div>
                                        <div class="person-status">
                                            <h3 class="title"><a href="#">{{ $company->name}}</a><span>{{$company->countMessages(Auth::user()->id)}}</span></h3>
                                            @if($messageData[$company->id]->type == 'reply' && $messageData[$company->id]->status == 'unviewed')
                                                <div class="date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $messageData[$company->id]->updated_at)->format('g:i a') }}</div>
                                                <p>{{ $messageData[$company->id]->message }}</p>
                                            @endif    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    @else
                        <div class="card-list-wrp">{{ __('No Record Found') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6"  id="append_messages">
            </div>

            <div class="col-lg-3">
                @if(count($companies) > 0)
                    <?php foreach($companies as $company){ ?>

                        <div class="person-info" id="person-info-{{ $company->id}}" style="display: none;">
                            <div class="card job-opning-list">
                                <div class="card-list-wrp">
                                    <div class="card-list">
                                        <div class="card-list-header">
                                            <div class="card-list-profile-logo">
                                                <div class="profileimg">
                                                    {{$company->printCompanyImage(100, 100)}}
                                                </div>
                                            </div>
                                            <h3 class="title"><a href="#">{{ $company->name}}</a></h3>
                                            <span><i class="fa fa-map-marker" aria-hidden="true"></i>{{ $company->location }}</span>
                                        </div>
                                        <div class="card-list-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item friend-message"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+{{$company->phone}}">{{$company->phone}}</a></li>
                                                <li class="list-group-item friend-message"><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailTo:{{$company->email}}">{{$company->email}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                @endif
            </div>

        </div>
      </div> 
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
function show_messages(id)
{
    $.ajax({
            type: "GET",
            url: "{{route('seeker-change-message-status')}}",
            data: { 
                'sender_id': id, 
            },
            })
      $.ajax({
        type: 'get',
        url: "{{route('seeker-append-messages')}}",
        data: {
          '_token': $('input[name=_token]').val(),
          'company_id': id,
        },
        success: function(res) {
          $('#append_messages').html('');
          $('#append_messages').html(res);
          $(".messages").scrollTop(100000000000000000);
          $('.messages').off('scroll');
          $('.message-grid').removeClass('active');
          $("#adactive"+id).addClass('active');
          $(".person-info").hide();
          $("#person-info-"+id).show();
        }
      });

  }
  
    
</script>

@endpush
