@extends('frontend.layouts.app')
@section('content')
    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                </div>
            </div>
        </div>
    </div>
    <div class="ps-product--detail pt-60">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-lg-offset-1">
                    <div class="ps-product__thumbnail">
                        <div class="ps-product__preview">
                            <div class="ps-product__variants">
                                @forelse($product->productimages as $product_image)
                                    <div class="item"><img src="{{@$product_image->image_path}}" alt=""></div>
                                @empty
                                @endforelse
                            </div>

                        </div>
                        <div class="ps-product__image">
                            @forelse($product->productimages as $product_image)
                                <div class="item"><img class="zoom" src="{{@$product_image->image_path}}" alt=""
                                                       data-zoom-image="{{@$product_image->image_path}}"></div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="ps-product__thumbnail--mobile">
                        @php
                            $flag = 0;
                        @endphp

                        @forelse($product->productimages as $product_image)
                            @if($flag == 0)
                                <div class="ps-product__main-img"><img src="{{@$product_image->image_path}}" alt="">
                                </div>
                                @php
                                    $flag = 1;
                                @endphp
                            @endif
                        @empty
                        @endforelse

                        <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true"
                             data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false"
                             data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3"
                             data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on">
                            @forelse($product->productimages as $product_image)
                                <img src="{{@$product_image->image_path}}" alt="">
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="ps-product__info">
                        <h1>{{@$product->name}}</h1>
                        <p class="ps-product__category"><a href="#"> {{@$product->categories->name}}</a>,<a
                                href="#"> {{@$product->brands->name}}</a></p>
                        <h3 class="ps-product__price">৳ {{@$product->new_price}} @if($product->old_price > 0)
                                <del>৳ {{@$product->old_price}}</del>@endif</h3>
                        <div class="ps-product__block ps-product__quickview">
                            <h4>Short Description</h4>
                            <p>{{@$product->short_description}}</p>
                            <h5>Per Quantity Weight: @if(@$product->weight<1000) {{@$product->weight}} gm

                                @else
                                    {{@$product->weight/1000}} kg
                                @endif

                            </h5>
                        </div>
                        <br>
                        <br>
                        <h4>Enter Quantity of Product</h4>
                        <div class="ps-product__block ps-product__size">
                            <div class="form-group">
                                <input class="form-control quantity" id="quantity" type="number" value="1" min="1"
                                       max="{{@$product->quantity}}">
                            </div>
                        </div>
                        <div class="ps-product__shopping">
                            <button class="ps-btn mb-10" onclick="addCartFunction(this.id)" id="{{@$product->id}}">Add
                                to cart<i class="ps-icon-next"></i></button>
                            {{--<div class="ps-product__actions"><a class="mr-10" href="whishlist.html"><i class="ps-icon-heart"></i></a><a href="compare.html"><i class="ps-icon-share"></i></a></div>--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="ps-product__content mt-50">
                        <ul class="tab-list" role="tablist">
                            <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Overview</a>
                            </li>

                                <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a>
                                </li>

                            {{--                            <li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">PRODUCT TAG</a></li>--}}
                            {{--                            <li><a href="#tab_04" aria-controls="tab_04" role="tab" data-toggle="tab">ADDITIONAL</a></li>--}}
                        </ul>
                    </div>
                    <div class="tab-content mb-60">
                        <div class="tab-pane active" role="tabpanel" id="tab_01">
                            <p>{{@$product->long_description}}</p>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="tab_02">
                            @forelse($reviews as $review)
                                <div class="ps-review" style="margin-bottom: 40px;

    border-radius: 5px;
    padding: 20px;
-webkit-box-shadow: 2px 3px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 3px 5px 0px rgba(0,0,0,0.75);
box-shadow: 2px 3px 5px 0px rgba(90, 155, 199);
">

                                    <header>
                                        <div class="br-wrapper br-theme-fontawesome-stars">
                                            <div class="br-widget">
                                                @if (@$review->rating == 1)
                                                    <a  data-rating-value="1" data-rating-text="1"
                                                       class="br-selected br-current"></a>
                                                    <a  data-rating-value="2" data-rating-text="2"
                                                      ></a>
                                                    <a  data-rating-value="3" data-rating-text="3"></a>
                                                    <a  data-rating-value="4" data-rating-text="4"></a>
                                                    <a  data-rating-value="5" data-rating-text="5"></a>
                                                @elseif (@$review->rating == 2)
                                                    <a data-rating-value="1" data-rating-text="1"
                                                       class="br-selected"></a>
                                                    <a data-rating-value="2" data-rating-text="2"
                                                       class="br-selected br-current"></a>
                                                    <a data-rating-value="3" data-rating-text="3"></a>
                                                    <a  data-rating-value="4" data-rating-text="4"></a>
                                                    <a  data-rating-value="5" data-rating-text="5"></a>
                                                @elseif (@$review->rating == 3)
                                                    <a  data-rating-value="1" data-rating-text="1"
                                                       class="br-selected"></a>
                                                    <a  data-rating-value="2" data-rating-text="2"
                                                       class="br-selected"></a>
                                                    <a  data-rating-value="3" data-rating-text="3"
                                                       class="br-selected br-current"></a>
                                                    <a  data-rating-value="4" data-rating-text="4" ></a>
                                                    <a  data-rating-value="5" data-rating-text="5"></a>
                                                @elseif (@$review->rating == 4)
                                                    <a  data-rating-value="1" data-rating-text="1"
                                                       class="br-selected"></a>
                                                    <a  data-rating-value="2" data-rating-text="2"
                                                       class="br-selected"></a>
                                                    <a  data-rating-value="3" data-rating-text="3"
                                                       class="br-selected"></a>
                                                    <a  data-rating-value="4" data-rating-text="4"
                                                       class="br-selected br-current"></a>
                                                    <a  data-rating-value="5" data-rating-text="5"></a>
                                                @elseif (@$review->rating == 5)
                                                    <a  data-rating-value="1" data-rating-text="1"
                                                       class="br-selected"></a>
                                                    <a data-rating-value="2" data-rating-text="2"
                                                       class="br-selected"></a>
                                                    <a  data-rating-value="3" data-rating-text="3"
                                                       class="br-selected"></a>
                                                    <a  data-rating-value="4" data-rating-text="4"
                                                       class="br-selected"></a>
                                                    <a  data-rating-value="5" data-rating-text="5"
                                                       class="br-selected br-current"></a>
                                                @else
                                                    Nothing to show
                                                @endif
                                                <div class="br-current-rating">2</div>
                                            </div>
                                        </div>
                                        <p>By<a href=""> {{@$review->customer_name}}</a>
                                            - {{@\Carbon\Carbon::parse($review->created_at)->format('jS F, Y')}}</p>
                                    </header>
                                    <p>{{@$review->review}}</p>
                                </div>

                            @empty
                                <h1 style="text-align: center">No review available for {{@$product->name}}</h1>
                            @endforelse
                            <br>
                            <br>
                                @auth
                            <div><h4>Post your review about <strong>{{@strtoupper($product->name)}}</strong></h4></div>
                            <hr>
                            <form class="ps-product__review" action="{{url('reviews/')}}" method="post">
                                {{@csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                                        <div class="form-group">
                                            <label>Your name <span style="color: red">*</span></label>

                                            <input class="form-control" name="customer_name" placeholder="Your name…"
                                                   type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Your email <span style="color: red">*</span></label>

                                            <input class="form-control" name="email" placeholder="Your email…"
                                                   type="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Give your rating <span style="color: red">*</span></label>
                                            <div class="br-wrapper br-theme-fontawesome-stars"><select class="ps-rating" name="rating" required="" style="display: none;">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5" selected="">5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Your review message <span style="color: red">*</span></label>
                                                <input type="hidden" name="product_id" value="{{@$product->id}}">
                                                <textarea class="form-control" name="review" rows="6"
                                                          required></textarea>
                                            </div>
                                            <button class="ps-btn ps-btn--sm" type="submit">Proceed<i
                                                    class="ps-icon-next"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                    @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-section ps-section--top-sales ps-owl-root pt-80 pb-80">
            <div class="ps-container">
                <div class="ps-section__header mb-50">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                            <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a
                                    class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="ps-section__content pb-50">
                    <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true"
                         data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false"
                         data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3"
                         data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                        @forelse($products as $product)
                            <div class="grid-item">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail">
                                            @if($product->created_at > \Carbon\Carbon::now()->subDays(7))
                                                <div class="ps-badge"><span>New</span></div>
                                            @endif
                                            @if($product->old_price> 0)
                                                <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-{{@$product->pricecalculate(@$product->old_price, @$product->new_price)}}%</span>
                                                </div>
                                            @endif
                                            <a class="ps-shoe__favorite" href="{{url('/product/'.@$product->id)}}"><i
                                                    class="ps-icon-heart"></i></a>
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
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name"
                                                                            href="{{url('/product/'.@$product->id)}}">{{@$product->name}}</a>
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
        @endsection
        @section('scripts')
            <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(function () {
                    $('.quantity').keypress(function (event) {
                        event.preventDefault();
                        return false;
                    });
                });

                function addCartFunction(id) {
                    var quantity = document.getElementById("quantity").value;
                    $.ajax({
                        url: "{{URL::to('/cart-add')}}",
                        method: "POST",
                        data: {'id': id, 'quantity': quantity, _token: '{{csrf_token()}}'},
                        dataType: "json",
                        success: function (data) {
                            $('#refresh').html('');
                            $('#refresh').html(data);
                        }
                    });

                }
                function applyCoupon(id) {
                    var quantity = document.getElementById("quantity").value;
                    $.ajax({
                        url: "{{URL::to('/cart-add')}}",
                        method: "POST",
                        data: {'id': id, 'quantity': quantity, _token: '{{csrf_token()}}'},
                        dataType: "json",
                        success: function (data) {
                            $('#refresh').html('');
                            $('#refresh').html(data);
                        }
                    });

                }

            </script>
@endsection
