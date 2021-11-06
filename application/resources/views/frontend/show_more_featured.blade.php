@extends('frontend.layouts.app')
@section('content')
    <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
        <div class="ps-container">
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
            <div class="mt-3">
                <div class="d-flex">
                    <div class="mr-auto"></div>
                    {{ $products->render( "pagination::bootstrap-4") }}
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
