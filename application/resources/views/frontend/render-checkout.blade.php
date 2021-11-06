<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
    <div class="ps-checkout__order">
        <header>
            <h3>Your Order</h3>
        </header>
        <div class="content">
            <table class="table ps-checkout__products">
                <thead>
                <tr>
                    <th class="text-uppercase">Product</th>
                    <th class="text-uppercase">Total</th>
                </tr>
                </thead>
                @if ($status == 401)
                    <div class="alert alert-danger" role="alert">
                        Wrong promo code! Please try again!
                    </div>
                @elseif ($status == 200)
                    <div class="alert alert-success" role="alert">
                        Promo code applied successfully!
                    </div>
                @endif
                @php
                    $total_quantity = null;
                    $total_price = null;
                @endphp
                <tbody>
                @forelse(Cart::content() as $cart)


                    <tr>
                        <td>{{@$cart->name}} ({{@$cart->price}}x{{@$cart->qty}})</td>
                        <td>৳{{@$cart->qty * @$cart->price}}</td>
                    </tr>
                    @php
                        $total_quantity = $cart->qty + $total_quantity;
                        $quantity_price = $cart->qty * $cart->price;
                        $total_price = $quantity_price + $total_price;
                    @endphp
                @empty
                @endforelse
                </tbody>
                <tbody>
                <tr>
                    <td>Card Subtotal</td>
                    <td>৳{{Cart::subtotal()}}</td>
                </tr>
                @if(Session::get('shipping_cost'))
                    <tr>
                        <td>Shipping Cost</td>
                        <td>
                            ৳{{Session::get('shipping_cost')}}
                            <input type="hidden" class="shipping_charge" value="{{Session::get('shipping_cost')}}">
                        </td>
                    </tr>
                    @else
                    <input type="hidden" id="shipping_charge" value="0">
                @endif
                <tr>
                    <td>Order Total</td>
                    @php
                        $subtotal = str_replace(',','',Cart::subtotal());
                        $shipping_charge = Session::get('shipping_cost');
                        echo Session::get('shipping_cost');
                    @endphp
                    @if(Session::get('percentage'))
                        <td><span
                                id="subtotal">৳{{($subtotal + $shipping_charge - round(($subtotal) * Session::get('percentage')/100))}}</span>
                        </td>
                    @else
                        <td><span id="subtotal">৳{{$subtotal + $shipping_charge}}</span></td>
                    @endif
                </tr>
                <tr>
                    <td>Est. Arrival date:</td>
                    <td>
                        @php
                            $approximate_day = 4;
                            $now = \Carbon\Carbon::now();
                            echo $now->format('d').'-'.$now->format('jS F',$now->addDays($approximate_day));
                        @endphp
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <footer>
            <h3>Payment Method</h3>
            <div class="form-group paypal">
                <div class="ps-radio">
                    <input class="form-control" type="radio" id="rdo01" onclick="checkBkash()" name="payment">
                    <label for="rdo01"><img src="{{asset('/assets/img/BKash-Icon-Logo.wine.svg')}}"
                                            style="height: 23px;width: 20px"> Bkash</label>
                </div>
                <div class="ps-radio ps-radio--inline">
                    <input class="form-control" type="radio" name="payment" onclick="checkCod()" id="rdo02">
                    <label for="rdo02"><i class="fa fa-money" style="font-size: 15px;color: whitesmoke"></i> &nbsp;Cash
                        on delivery</label>
                </div>
                <a class="ps-btn ps-btn--fullwidth" href="#" id="bkash" onclick="submitFunction()">Place Order<i
                        class="ps-icon-next"></i>
                </a>
                <a class="ps-btn ps-btn--fullwidth" href="#" id="cod" onclick="submitCod()" style="display: none">Proceed
                    <i
                        class="ps-icon-next"></i>
                </a>
            </div>
        </footer>
    </div>
</div>
