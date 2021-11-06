
<a class="ps-cart__toggle" href="#">
        <span>
            <i>
                {{count(Cart::content())}}
            </i>
        </span>
    <i class="ps-icon-shopping-cart"></i></a>
<div class="ps-cart__listing">
    <div class="ps-cart__content">
        @php
            $total_quantity = null;
            $total_price = null;
        @endphp
        @forelse(Cart::content() as $cart)
            <div class="ps-cart-item">
                <a class="ps-cart-item__close" href="#"></a>
                <div class="ps-cart-item__thumbnail">
                    <a href="{{url('/cart-list')}}"></a>
                    {{--@forelse(@$cart->product->productimages as $product_image)
                        <img src="{{@$product_image->image_path}}" alt="">
                    @empty
                    @endforelse--}}
                </div>
                <div class="ps-cart-item__content"><a class="ps-cart-item__title"
                                                      href="{{url('product/'.$cart->id)}}">{{$cart->name}}</a>
                    <p><span>Quantity:<b style="color: white">{{@$cart->qty}}</b></span><span>Total: <b style="color: white">৳{{@$cart->qty * @$cart->price}}</b></span></p>
                </div>
            </div>
            @php
                $total_quantity = $cart->qty + $total_quantity;
                $quantity_price = $cart->qty * $cart->price;
                $total_price = $quantity_price + $total_price;
            @endphp
        @empty
        @endforelse
    </div>
    <div class="ps-cart__total">
        <p>Number of items:<span>{{$total_quantity}}</span></p>
        <p>Item Total:<span>৳{{$total_price}}</span></p>
    </div>
    <div class="ps-cart__footer"><a class="ps-btn" href="{{url('/cart-list/')}}">Check out<i
                class="ps-icon-arrow-left"></i></a></div>
</div>
