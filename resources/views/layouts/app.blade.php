<?php
if (!isset($seo)) {
    $seo = (object)array('seo_title' => $siteSetting->site_name, 'seo_description' => $siteSetting->site_name, 'seo_keywords' => $siteSetting->site_name, 'seo_other' => '');
}
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{ (session('localeDir', 'ltr'))}}" dir="{{ (session('localeDir', 'ltr'))}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__($seo->seo_title) }}</title>
    <meta name="Description" content="{!! $seo->seo_description !!}">
    <meta name="Keywords" content="{!! $seo->seo_keywords !!}">
    @if(config('app.env') != 'production')
    <meta name="robots" content="noindex, nofollow">
    @else
    {!! $seo->seo_other !!}
    @endif
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="{{asset('/')}}favicon.ico">

    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    @stack('styles')
</head>

<body>

    <div class="wrapper">
        @yield('content')
    </div>

    <!-- Jquery js-->
    <script src="{{asset('diverswerk/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('diverswerk/assets/js/bootstrap.min.js')}}"></script>

    @stack('scripts')

</body>
<script>
    $(document).ready(function() {
        // Add down arrow icon for collapse element which is open by default
        $(".collapse.show").each(function() {
            $(this).prev(".card-header").find(".fa").addClass("fa-angle-down").removeClass("fa-angle-right");
        });

        // Toggle right and down arrow icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function() {
            $(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
        }).on('hide.bs.collapse', function() {
            $(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
        });
    });
</script>

</html>