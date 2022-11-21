@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
<div id="titlebar" class="page-banner" >
    <div class="container">
       <div class="col-md-12">
           <span class="sub-title"><div class="breadCrumb"><a href="{{route('index')}}">{{__('Home')}}</a> / <a href="{{route('blogs')}}">{{__('Blog')}}</a> </div></span>
           <h2 class="title">{{$serach_result}}</h2>
       </div>
     
   </div>
</div>
<!-- Inner Page Title end -->

<section id="blog-content" class="blog-page-section">
    <div class="container">

        <!-- Blog start -->
        <div class="row">
            <div class="col-lg-9">
                <!-- Blog List start -->
                <div class="blogwrapper">
                    <div  class="blogList row">
                        @if(null!==($blogs) && count($blogs) > 0)

                        <?php
                        $count = 1;
                        ?>
                        @foreach($blogs as $blog)
                        <?php
                        $cate_ids = explode(",", $blog->cate_id);
                        $data = DB::table('blog_categories')->whereIn('id', $cate_ids)->get();
                        $cate_array = array();
                        foreach ($data as $cat) {
                            $cate_array[] = "<a href='" . url('/blog/category/') . "/" . $cat->slug . "'>$cat->heading</a>";
                        }
                        ?>
                       
                            <div class="col-lg-12">
                                <div class="bloginner">
                                    <div class="postimg">{{$blog->printBlogImage()}}</div>

                                    <div class="post-header">
                                    <h4 class="title"><a href="{{route('blog-detail',$blog->slug)}}">{{$blog->heading}}</a></h4>
                                
                                        <div class="postmeta">{{ __('Category') }} : {!!implode(', ',$cate_array)!!}
                                        </div>
                                    </div>
                                    <div class="blog-containt">
                                    <p>{!! \Illuminate\Support\Str::limit(strip_tags($blog->content), $limit = 150, $end = '...') !!}</p>
                                    </div>

                                </div>
                            </div>

                        
                        <?php $count++; ?>
                        @endforeach
                        @else
                        <div class="col-lg-12">
                            <div class="bloginner">
                                {{__('No blogs found')}}
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagiWrap">
                    <nav aria-label="Page navigation example">
                        @if(isset($blogs) && count($blogs))
                        {{ $blogs->appends(request()->query())->links() }} @endif
                    </nav>
                </div>
            </div>
			 <div class="col-lg-3">
				 
				 <div class="sidebar"> 
                    <!-- Search -->
                    <div class="card-boxed">
                            <div class="search-box">
                                <form action="{{route('blog-search')}}" method="GET" class="search-form">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <button type="submit" class="btn search-btn"><i class="ti-search "></i></button>
                                </form>
                            </div>
                        </div>
                    <!-- Categories -->
                    @if(null!==($categories))
                    <div class="card-boxed">
                    <div class="card-boxed-header">
                                <h4 class="title"><i class="ti-user padd-r-10"></i>{{ __('Categories') }}</h4>
                            </div>
                            <div class="card-boxed-body">
                                <div class="side-list no-border">
                        <ul class="categories">
                        @foreach($categories as $category)
                        <li><a href="{{url('/blog/category/').'/'.$category->slug}}">{{$category->heading}}</a></li>
                        @endforeach
                        </ul>
                                </div>
                            </div>
                    </div>
                    @endif
        </div>
			</div>
        </div>
		<div class="py-5"></div>
    </div>
</section>




@include('includes.footer')
@endsection
@push('styles')
<style>
.plus-minus-input {
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.plus-minus-input .input-group-field {
    text-align: center;
    margin-left: 0.5rem;
    margin-right: 0.5rem;
    padding: 0rem;
}

.plus-minus-input .input-group-field::-webkit-inner-spin-button,
.plus-minus-input .input-group-field ::-webkit-outer-spin-button {
    -webkit-appearance: none;
    appearance: none;
}

.plus-minus-input .input-group-button .circle {
    border-radius: 50%;
    padding: 0.25em 0.8em;
}
</style>
@endpush
@push('scripts')
@include('includes.immediate_available_btn')
<script>
</script>
@endpush