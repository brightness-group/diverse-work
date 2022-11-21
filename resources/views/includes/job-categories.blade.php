@php
    $industries = App\Industry::getUsingIndustries(4,false);
    $icons = ['icon-bargraph','icon-tools','ti-briefcase','ti-ruler-pencil']
@endphp
<section class="service-box-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="heading">
                    <h2>{{__('Job Categories')}}</h2>
                    <p>{{__('Below we present the specific categories that are suitable for you. All categories can be consulted here.')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach($industries as $industry)
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('job.list', ['industry_id[]'=>$industry->industry_id]) }}" title="{{$industry->industry}}">
                            <div class="service-box-card">
                                <div class="service-box-desc">
                                    <div class="service-box-icon"> <i class="{{$icons[$loop->index]}}" aria-hidden="true"></i> </div>
                                    <div class="category-detail service-box-desc_text">
                                        <h4>{{$industry->industry}}</h4>
                                        {{-- counts disabled for now--}}
                                        {{--<p>122 Jobs</p>--}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                <div class="col-md-12 mrg-top-20 text-center">
                    <a href="{{route('job.list')}}" class="btn theme-btn btn-m">{{__('View All Categories')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>