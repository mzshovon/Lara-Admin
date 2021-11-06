@extends('frontend.layouts.app')
@section('content')
    <div class="ps-content pt-80 pb-80">
        <div class="ps-container">
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
                    @forelse(Cart::content() as $cart)
                        <tr>
                            <td>
                                <a class="ps-product__preview" href="{{url('/product/'.@$cart->id)}}">
                                    {{--@forelse(@$product_images as $product_image)
                                        @if($product_image->product_id == $cart->product_id)
                                            <img class="mr-15" src="{{@$product_image->image_path}}" alt=""
                                                 height="40px" width="60px">
                                        @endif
                                    @empty
                                    @endforelse--}}
                                    {{@$cart->name}}
                                </a>
                            </td>
                            <td>৳{{@$cart->price}}</td>
                            <td>
                                <div class="form-group--number">
                                    <form method="post" action="{{url('/cart-update')}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="rowId" value="{{@$cart->rowId}}">
                                        <input class="form-control" name="quantity" value="{{@$cart->qty}}"
                                               type="number" min="1" max="{{@$cart->product->qty}}">&nbsp;
                                        <button class="btn btn-success" onclick="cartUpdateFunction()"><i
                                                class="fa fa-save"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td>৳{{@$cart->qty * @$cart->price}}</td>
                            <td>
                                <form method="post" action="{{url('/cart-delete')}}" id="form-id">
                                    {{csrf_field()}}
                                    <input type="hidden" name="rowId" value="{{@$cart->rowId}}">

                                </form>
                                <div class="ps-remove" id="{{@$cart->rowId}}"
                                     onclick="cartDeleteFunction(this.id)"></div>
                            </td>
                        </tr>

                        @php
                            $total_quantity = $cart->qty + $total_quantity;
                            $quantity_price = $cart->qty * $cart->price;
                            $total_price = $quantity_price + $total_price;
                        @endphp
                    @empty
                    @endforelse

                    </tbody>
                </table>
                <div class="ps-cart__actions">
                    <div class="ps-cart__promotion">

                        <div class="form-group">
                            <a class="ps-btn ps-btn--gray" href="{{url('/')}}">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="ps-cart__total">
                        <h3>Total Price: <span id="total_price"> {{@$total_price}} ৳</span>
                        </h3><a class="ps-btn" href="{{url('/checkout')}}">Process to checkout<i
                                class="ps-icon-next"></i></a>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function writeCoupone() {
    let coupone_value = $('#coupons').val();
    $('#total_price').html('৳'+coupone_value);}
        var form = document.getElementById("form-id");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function cartDeleteFunction(id) {
            form.submit();
        }
        function cartUpdateFunction() {
            form.submit();
        }
        function cartSetDiscountFunction() {
            form.submit();
        }

    </script>
@endsection


