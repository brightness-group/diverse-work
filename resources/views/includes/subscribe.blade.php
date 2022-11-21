<section class="newsletter theme-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="heading light">
                    <h2>{{__('Subscribe Our Newsletter!')}}</h2>
                    <p>{{__('Keep up to date with the latest developments regarding our platform and make sure you do not miss anything!')}}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                <div class="newsletter-box text-center">
                    <form method="post" action="{{ route('subscribe.newsletter')}}" name="subscribe_newsletter_form" id="subscribe_newsletter_form">
                        {{ csrf_field() }}
                        <div class="input-group"> <span class="input-group-addon"><span class="ti-email theme-cl"></span></span>
                            <input type="text" class="form-control" placeholder="{{__('Enter your Email...')}}" name="email" id="email" required="required">
                        </div>
                        <button type="button" class="btn theme-btn btn-radius btn-m" id="send_subscription_form">{{__('Subscribe')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#send_subscription_form', function () {
            var postData = $('#subscribe_newsletter_form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('subscribe.newsletter') }}",
                data: postData,
                //dataType: 'json',
                success: function (data)
                {
                    response = JSON.parse(data);
                    var res = response.success;
                    if (res == 'success')
                    {
                        var errorString = '<div role="alert" class="alert alert-success">' + response.message + '</div>';
                        $('#alert_messages').html(errorString);
                        $('#subscribe_newsletter_form').hide('slow');
                        $(document).scrollTo('.alert', 2000);
                    } else
                    {
                        var errorString = '<div class="alert alert-danger" role="alert"><ul>';
                        response = JSON.parse(data);
                        $.each(response, function (index, value)
                        {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul></div>';
                        $('#alert_messages').html(errorString);
                        $(document).scrollTo('.alert', 2000);
                    }
                },
            });
        });
    });
</script>
@endpush