@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<div class="wrapper messageWrap">
    <!-- Inner Page Title start --> 
    @include('includes.inner_page_common_title', ['page_title'=>__('Company Messages')])
    <!-- Inner Page Title end --> 
    <div class="message-page">
        <div class="container">
            {{-- @include('includes.company_dashboard_menu') --}}
            <div class="col-lg-3">
                <div class="card job-opning-list left-bar">
                    
                    @if(count($seekers) > 0)
                        <?php foreach($seekers as $seeker){?>
                            <div class="card-list-wrp" id="adactive{{ $seeker->id}}">
                                <div class="card-list" data-gift="{{$seeker->id}}" id="company_id_{{$seeker->id}}"  onclick="show_messages({{ $seeker->id}})">
                                    <div class="card-list-header">
                                        <div class="card-list-profile-logo">
                                            <div class="profileimg">
                                                {{$seeker->printUserImage(100, 100)}}
                                            </div>
                                        </div>
                                        <div class="person-status">
                                            <h3 class="title"><a href="#">{{ $seeker->name}}</a><span>{{$seeker->countMessages(Auth::guard('company')->user()->id)}}</span></h3>
                                            @if($messageData[$seeker->id]->type == 'message' && $messageData[$seeker->id]->status == 'unviewed')
                                                <div class="date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $messageData[$seeker->id]->updated_at)->format('g:i a') }}</div>
                                                <p>{{ $messageData[$seeker->id]->message }}</p>
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
                @if(count($seekers) > 0)
                    <?php foreach($seekers as $seeker){ ?>

                        <div class="person-info" id="person-info-{{ $seeker->id}}" style="display: none;">
                            <div class="card job-opning-list">
                                <div class="card-list-wrp">
                                    <div class="card-list">
                                        <div class="card-list-header">
                                            <div class="card-list-profile-logo">
                                                <div class="profileimg">
                                                    {{$seeker->printUserImage(100, 100)}}
                                                </div>
                                            </div>
                                            <h3 class="title"><a href="#">{{ $seeker->name}}</a></h3>
                                            <span><i class="fa fa-map-marker" aria-hidden="true"></i>{{$seeker->street_address}}</span>
                                        </div>
                                        <div class="card-list-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item friend-message"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+{{$seeker->phone}}">{{$seeker->phone}}</a></li>
                                                <li class="list-group-item friend-message"><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailTo:{{$seeker->email}}">{{$seeker->email}}</a></li>
                                                @if( $seeker->date_of_birth )
                                                    <li class="list-group-item my-message"><i class="fa fa-calendar" aria-hidden="true"></i>
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $seeker->date_of_birth)->format('m.d.Y') }}</li>
                                                @endif    
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
                url: "{{route('company-change-message-status')}}",
                data: { 
                    'sender_id': id, 
                },
                });
          $.ajax({
            type: 'get',
            url: "{{route('append-message')}}",
            data: {
              '_token': $('input[name=_token]').val(),
              'seeker_id': id,
            },
            success: function(res) {
              $('#append_messages').html('');
              $('#append_messages').html(res);
              $(".messages").scrollTop(1000000000000);
              $('.messages').off('scroll');
              $('.card-list-wrp').removeClass('active');
              $("#adactive"+id).addClass('active');

              $(".person-info").hide();
              $("#person-info-"+id).show();
            }
          });
    
      }
      
        
</script>
@endpush