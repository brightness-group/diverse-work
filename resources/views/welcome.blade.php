@extends('layouts.app')
@section('content')

<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Search start -->
@include('includes.search')
<!-- Search End -->

{{-- job categories --}}
@include('includes.job-categories')

<!-- Latest Jobs start -->
@include('includes.latest_jobs')
<!-- Latest Jobs ends -->

@include('includes.footer')
@endsection
@push('scripts') 
<script>
    $(document).ready(function ($) {
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);
    });
</script>
@include('includes.country_state_city_js')
@endpush
