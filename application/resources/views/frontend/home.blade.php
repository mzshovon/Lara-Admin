@extends('frontend.layouts.app')
@section('content')
    <div class="ps-banner">
        <div class="rev_slider fullscreenbanner" id="home-banner" >
            <ul>
                @foreach($sliders as  $slider)

                <li class="ps-banner" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-2972"
                    data-rotate="0" data-slotamount="default" data-transition="random" ><img alt=""
                                                                                            class="rev-slidebg"
                                                                                            data-bgfit="cover"
                                                                                            data-bgparallax="5"
                                                                                            data-bgposition="center center"
                                                                                            data-bgrepeat="no-repeat"
                                                                                            data-no-retina
                                                                                            src="{{asset('/').@$slider->image}}" >



{{--                    <a class="tp-caption ps-btn"--}}
{{--                       data-frames="[{&quot;delay&quot;:1500,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]"--}}
{{--                       data-hoffset="['-60','15','15','15']" data-responsive_offset="on"--}}
{{--                       data-textAlign="['center','center','center','center']" data-type="text"--}}
{{--                       data-voffset="['120','140','200','200']" data-x="['left','left','left','left']"--}}
{{--                       data-y="['middle','middle','middle','middle']"--}}
{{--                       href="#feature"--}}
{{--                       id="layer31"--}}

{{--                    >Purchase--}}
{{--                        Now<i class="ps-icon-next"></i></a>--}}
                </li>
         @endforeach
            </ul>
        </div>
    </div>
    <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
        <div class="ps-container" id="feature">
           <div class="ps-section__header mb-50">
                <h3 class="ps-section__title" data-mask="featured">- Featured Categories
                    <a href="{{route('featured_categories')}}" class="btn btn-info btn-md">Show More <i class="fa fa-arrow-circle-right"></i> </a></h3>

{{--                <ul class="ps-masonry__filter">--}}
{{--                    <li class="current"><a data-filter="*" href="#">All <sup>8</sup></a></li>--}}
{{--                    <li><a data-filter=".nike" href="#">Nike <sup>1</sup></a></li>--}}
{{--                    <li><a data-filter=".adidas" href="#">Adidas <sup>1</sup></a></li>--}}
{{--                    <li><a data-filter=".men" href="#">Men <sup>1</sup></a></li>--}}
{{--                    <li><a data-filter=".women" href="#">Women <sup>1</sup></a></li>--}}
{{--                    <li><a data-filter=".kids" href="#">Kids <sup>4</sup></a></li>--}}
{{--                </ul>--}}
            </div>
{{--            <div class="ps-section__content pb-50">--}}
{{--                <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30"--}}
{{--                     data-radio="100%">--}}
{{--                    <div class="ps-masonry">--}}
{{--                        <div class="grid-sizer"></div>--}}
{{--                        @forelse($products as $product)--}}
{{--                            <div class="grid-item">--}}
{{--                                <div class="grid-item__content-wrapper">--}}
{{--                                    <div class="ps-shoe mb-30">--}}
{{--                                        <div class="ps-shoe__thumbnail">--}}
{{--                                            @if($product->created_at > \Carbon\Carbon::now()->subDays(7))--}}
{{--                                                <div class="ps-badge"><span>New</span></div>--}}
{{--                                            @endif--}}
{{--                                            @if(($product->old_price > 0) && ($product->old_price > $product->new_price))--}}
{{--                                                <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-{{@$product->pricecalculate(@$product->old_price, @$product->new_price)}}%</span></div>--}}
{{--                                            @endif--}}
{{--                                            <a class="ps-shoe__favorite" href="{{url('/product/'.@$product->id)}}"><i class="ps-icon-heart"></i></a>--}}
{{--                                            @php--}}
{{--                                                $image = \App\ProductImage::whereProductId(@$product->id)->first();--}}
{{--                                            @endphp--}}
{{--                                            <img alt="" src="{{@$image->image_path}}">--}}
{{--                                            <a class="ps-shoe__overlay" href="{{url('/product/'.@$product->id)}}"></a>--}}
{{--                                        </div>--}}
{{--                                        <div class="ps-shoe__content">--}}
{{--                                            <div class="ps-shoe__variants">--}}
{{--                                                <div class="ps-shoe__variant normal">--}}
{{--                                                    @forelse($product->productimages as $product_image)--}}
{{--                                                        <img alt="" src="{{@$product_image->image_path}}">--}}
{{--                                                    @empty--}}
{{--                                                    @endforelse--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{url('/product/'.@$product->id)}}">{{@$product->name}}</a>--}}
{{--                                                <p class="ps-shoe__categories">--}}
{{--                                                    <a href="#">{{@$product->category->name}}</a>,--}}
{{--                                                    <a href="#">{{@$product->brand->name}}</a>--}}
{{--                                                </p>--}}
{{--                                                <span class="ps-shoe__price">--}}
{{--                                                @if($product->old_price > 0)--}}
{{--                                                        <del>৳{{@$product->old_price}}</del>@endif ৳ {{@$product->new_price}}--}}
{{--                                            </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @empty--}}
{{--                        @endforelse--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
            <div class="ps-section__content pb-50">
                <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30"
                     data-radio="100%">
                    <div class="ps-masonry">
                        <div class="grid-sizer"></div>
                        @forelse($categories as $category)
                            <div class="grid-item">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail">
                                            <a class="ps-shoe__favorite" href="{{url('/category-products/'.@$category->id)}}"><i class="ps-icon-heart"></i></a>
                                            @php
                                                $image = \App\CategoryImage::where('cat_id',@$category->id)->first();
                                            @endphp
                                            <img alt="" src="{{@$image->image_path}}">
                                            <a class="ps-shoe__overlay" href="{{url('/category-products/'.@$category->id)}}"></a>
                                        </div>
                                        <div class="ps-shoe__content">
{{--                                            <div class="ps-shoe__variants">--}}
{{--                                                <div class="ps-shoe__variant normal">--}}
{{--                                                    @forelse($category->productimages as $product_image)--}}
{{--                                                        <img alt="" src="{{@$product_image->image_path}}">--}}
{{--                                                    @empty--}}
{{--                                                    @endforelse--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="ps-shoe__detail"  style="text-align: center!important;text-transform: uppercase"><a class="ps-shoe__name" href="{{url('/product/'.@$category->id)}}">{{@$category->name}}</a>
{{--                                                <p class="ps-shoe__categories">--}}
{{--                                                    <a href="#">{{@$category->name}}</a>,--}}
{{--                                                    <a href="#">{{@$category->name}}</a>--}}
{{--                                                </p>--}}
                                                <span class="ps-shoe__price">

                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="ps-section--features-product ps-section masonry-root pb-100">
        <div class="ps-container" id="feature">
            <div class="ps-section__header mb-50">
                <h3 class="ps-section__title" data-mask="featured products">- Featured Products &nbsp; &nbsp;
                    <a href="{{route('featured_products')}}" class="btn btn-info btn-md">Show More Products <i class="fa fa-arrow-circle-right"></i> </a></h3>

                {{--                <ul class="ps-masonry__filter">--}}
                {{--                    <li class="current"><a data-filter="*" href="#">All <sup>8</sup></a></li>--}}
                {{--                    <li><a data-filter=".nike" href="#">Nike <sup>1</sup></a></li>--}}
                {{--                    <li><a data-filter=".adidas" href="#">Adidas <sup>1</sup></a></li>--}}
                {{--                    <li><a data-filter=".men" href="#">Men <sup>1</sup></a></li>--}}
                {{--                    <li><a data-filter=".women" href="#">Women <sup>1</sup></a></li>--}}
                {{--                    <li><a data-filter=".kids" href="#">Kids <sup>4</sup></a></li>--}}
                {{--                </ul>--}}
            </div>
            <div class="ps-section__content pb-50">
                <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30"
                     data-radio="100%">
                    <div class="ps-masonry">
                        <div class="grid-sizer"></div>
                        @forelse($products as $product)
                            <div class="grid-item">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail">
                                            @if($product->created_at > \Carbon\Carbon::now()->subDays(7))
                                                <div class="ps-badge"><span>New</span></div>
                                            @endif
                                            @if(($product->old_price > 0) && ($product->old_price > $product->new_price))
                                                <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-{{@$product->pricecalculate(@$product->old_price, @$product->new_price)}}%</span></div>
                                            @endif
                                            <a class="ps-shoe__favorite" href="{{url('/product/'.@$product->id)}}"><i class="ps-icon-heart"></i></a>
                                            @php
                                                $image = \App\ProductImage::whereProductId(@$product->id)->first();
                                            @endphp
                                            <img alt="" src="{{@$image->image_path}}">
                                            <a class="ps-shoe__overlay" href="{{url('/product/'.@$product->id)}}"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal">
                                                    @forelse($product->productimages as $product_image)
                                                        <img alt="" src="{{@$product_image->image_path}}">
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{url('/product/'.@$product->id)}}">{{@$product->name}}</a>
                                                <p class="ps-shoe__categories">
                                                    <a href="#">{{@$product->category->name}}</a>,
                                                    <a href="#">{{@$product->brand->name}}</a>
                                                </p>
                                                <span class="ps-shoe__price">
                                                @if($product->old_price > 0)
                                                        <del>৳{{@$product->old_price}}</del>@endif ৳ {{@$product->new_price}}
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ps-section--offer">
        @foreach($banners as $banner=>$val)
            @if($val->sub_font==1)
                <div class="ps-column">

                    <a class="ps-offer" href="#"><img
                            alt="" src="{{asset('/').@$val->image}}" style="height: 305px; width: 960px"></a></div>
                {{--           @else--}}
                {{--        <div class="ps-column">--}}
                {{--            <a class="ps-offer" href="#"><img--}}
                {{--                        alt="" src="{{asset('/').@$val->image}}" style="height: 285px; width: 960px"></a></div>--}}
            @endif
        @endforeach


            @foreach($banners as $banner=>$val)
                @if($val->sub_font==2)
                    <div class="ps-column">

                        <a class="ps-offer" href="#"><img
                                alt="" src="{{asset('/').@$val->image}}" style="height: 305px; width: 960px"></a></div>
                    {{--           @else--}}
                    {{--        <div class="ps-column">--}}
                    {{--            <a class="ps-offer" href="#"><img--}}
                    {{--                        alt="" src="{{asset('/').@$val->image}}" style="height: 285px; width: 960px"></a></div>--}}
                @endif
            @endforeach
    </div>
    <div class="ps-section ps-section--top-sales ps-owl-root pt-80 pb-80">
        <div class="ps-container">
            <div class="ps-section__header mb-50">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                        <h3 class="ps-section__title" data-mask="BEST SALE">- Top Sales</h3>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a
                                    class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
                    </div>
                </div>
            </div>

            <div class="ps-section__content pb-50">

                <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-dots="false"
                     data-owl-duration="1000" data-owl-gap="30" data-owl-item="4" data-owl-item-lg="4"
                     data-owl-item-md="3" data-owl-item-sm="2" data-owl-item-xs="1" data-owl-loop="true"
                     data-owl-mousedrag="on" data-owl-nav="false" data-owl-speed="5000">
                    @forelse($top_sales as $top)
                    <div class="ps-shoes--carousel">
                        <div class="ps-shoe">
                            <div class="ps-shoe__thumbnail">
                                @if($top->created_at > \Carbon\Carbon::now()->subDays(7))
                                    <div class="ps-badge"><span>New</span></div>
                                @endif
                                    @if(($top->old_price > 0) && ($top->old_price > $top->new_price))
                                        <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-{{@$top->pricecalculate(@$top->old_price, @$top->new_price)}}%</span></div>
                                    @endif
                                    <a class="ps-shoe__favorite" href="{{url('/product/'.@$top->id)}}"><i class="ps-icon-heart"></i></a>

                                    @php
                                        $image = \App\ProductImage::whereProductId(@$top->id)->first();
                                    @endphp
                                    <img alt="" src="{{@$image->image_path}}">

                                    <a class="ps-shoe__overlay" href="{{url('/product/'.@$top->id)}}"></a>
                            </div>
                            <div class="ps-shoe__content">
                                <div class="ps-shoe__variants">
                                    <div class="ps-shoe__variant normal">
                                        @forelse($top->productimages as $product_image)
                                            <img alt="" src="{{@$product_image->image_path}}">
                                        @empty
                                        @endforelse
                                    </div>
{{--                                    <select class="ps-rating ps-shoe__rating">--}}
{{--                                        <option value="1">1</option>--}}
{{--                                        <option value="1">2</option>--}}
{{--                                        <option value="1">3</option>--}}
{{--                                        <option value="1">4</option>--}}
{{--                                        <option value="2">5</option>--}}
{{--                                    </select>--}}
                                </div>
                                <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{url('/product/'.@$top->id)}}">{{@$top->name}}</a>
                                    <p class="ps-shoe__categories">
                                        <a href="#">{{@$top->category->name}}</a>,
                                        <a href="#">{{@$top->brand->name}}</a>
                                    <p class="ps-shoe__categories">   <span class="ps-shoe__price">
                                                @if($top->old_price > 0)
                                                <del>৳{{@$top->old_price}}</del>@endif ৳ {{@$product->new_price}}
                                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>

            </div>
        </div>
    </div>
    @if (Session::has('message'))
        <script>
            swal('Success!', '{{ Session::get('message') }}', 'success');
        </script>
    @endif
@endsection

@section('scripts')
@endsection
