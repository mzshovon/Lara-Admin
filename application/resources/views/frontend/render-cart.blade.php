<div class="ps-cart-listing">
    <table class="table ps-cart__table">
        <thead>
        <tr>
            <th>All Products</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $total_quantity = null;
            $total_price = null;
        @endphp
        @forelse($cart_list as $cart)
            <tr>
                <td>
                    <a class="ps-product__preview" href="{{url('/product/'.@$cart->product->id)}}">
                        @forelse(@$product_images as $product_image)
                            @if($product_image->product_id == $cart->product_id)
                                <img class="mr-15" src="{{@$product_image->image_path}}" alt="" height="40px" width="60px">
                            @endif
                        @empty
                        @endforelse
                        {{@$cart->product->name}}
                    </a>
                </td>
                <td>৳{{@$cart->product->new_price}}</td>
                <td>
                    <div class="form-group--number">
                        <button class="minus"><span>-</span></button>
                        <input class="form-control" type="text" value="{{@$cart->quantity}}">
                        <button class="plus"><span>+</span></button>
                    </div>
                </td>
                <td>৳{{@$cart->quantity * @$cart->product->new_price}}</td>
                <td>
                    <div class="ps-remove" id="{{@$cart->id}}" onclick="cartDeleteFunction(this.id)"></div>
                </td>
            </tr>
            @php
                $total_quantity = $cart->quantity + $total_quantity;
                $quantity_price = $cart->quantity * $cart->product->new_price;
                $total_price = $quantity_price + $total_price;
            @endphp
        @empty
        @endforelse

        </tbody>
    </table>
    <div class="ps-cart__actions">
        <div class="ps-cart__promotion">
            <div class="form-group">
                <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                    <input class="form-control" type="text" placeholder="Promo Code">
                </div>
            </div>
            <div class="form-group">
                <a class="ps-btn ps-btn--gray" href="{{url('/')}}">Continue Shopping</a>
            </div>
        </div>
        <div class="ps-cart__total">
            <h3>Total Price: <span> {{@$total_price}} ৳</span>
            </h3><a class="ps-btn" href="checkout.html">Process to checkout<i class="ps-icon-next"></i></a>
        </div>
    </div>
</div>
