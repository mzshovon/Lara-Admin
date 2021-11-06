@extends('frontend.layouts.app')
@section('content')
    <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
        <div class="ps-container" id="feature">
            <div class="ps-section__header mb-50">
                <h3 class="ps-section__title" data-mask="featured">- All Featured Categories
             </h3>

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
                                            <a class="ps-shoe__favorite" href="{{url('/category-products/'.@$category->cat_id)}}"><i class="ps-icon-heart"></i></a>
                                            <img alt="" src="{{@$category->image_path}}">
                                            <a class="ps-shoe__overlay" href="{{url('/category-products/'.@$category->cat_id)}}"></a>
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
    @if (Session::has('message'))
        <script>
            swal('Success!', '{{ Session::get('message') }}', 'success');
        </script>
    @endif
@endsection

@section('scripts')
@endsection
