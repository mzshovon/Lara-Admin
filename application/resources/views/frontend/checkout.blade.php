@extends('frontend.layouts.app')
@section('content')
    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form" action="{{url('order-place')}}" method="post" id="checkout-form">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing">
                            <h3>Billing Detail</h3>
                            <div class="form-group form-group--inline">
                                <label>Name<span>*</span>
                                </label>
                                <input class="form-control" type="text" name="name" value="{{@Auth::user()->name}}"
                                       required>
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Email Address<span>*</span>
                                </label>
                                <input class="form-control" type="email" name="email" value="{{@Auth::user()->email}}"
                                       required>
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Phone<span>*</span>
                                </label>
                                <input class="form-control" type="text" name="phone" value="{{@Auth::user()->phone}}"
                                       required>
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Region<span>*</span>
                                </label>
                                <select class="form-control" name="region_id" onchange="shippingFunction(this.value)"
                                        required>
                                    <option>Select</option>
                                    @forelse($regions as $region)
                                        <option value="{{@$region->id}}">{{@$region->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <?php
                            $data['promo_code'] = \Illuminate\Support\Facades\DB::table('promo_code')->where('status', '=', '1')->first();
                            if ($data['promo_code']) {
                            ?>
                            <div class="form-group form-group--inline">
                                <label>Promo Code<span>*</span>
                                </label>
                                <input class="form-control" type="text" name="promo_code" required>
                                <button type="button" class="btn btn-primary" onclick="promoFunction()">Apply Coupon
                                </button>
                            </div>
                            <?php
                            } else {
                                }
                            ?>
                            <div class="form-group form-group--inline">
                                <label>Address<span>*</span>
                                </label>
                                <input class="form-control" type="text" name="address" required>
                            </div>

                            <h3 class="mt-40"> Addition information</h3>
                            <div class="form-group form-group--inline textarea">
                                <label>Order Notes</label>
                                <textarea class="form-control" rows="5" name="customer_notes"
                                          placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="checkout-update">
                        @include('frontend.render-checkout')
                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        .swal2-popup {
            font-size: 1.6rem !important;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">


        $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});

        function shippingFunction(value) {
            $.ajax({
                url: "{{URL::to('checkout-update/')}}",
                method: "POST",
                data: {'id': value, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
                dataType: "json",
                success: function (data) {
                    $('#checkout-update').html(data);
                }
            });
        }

        function promoFunction() {
            var promo_code = $("input[name=promo_code]").val();
            var shipping_charge = $(".shipping_charge").val();
            console.log(shipping_charge);
            $.ajax({
                url: "{{URL::to('checkout-update/')}}",
                method: "POST",
                data: {'promo_code': promo_code, 'shipping_charge':shipping_charge,  _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
                dataType: "json",
                success: function (data) {
                    $('#checkout-update').html(data);
                }
            });
        }

        var form = document.getElementById("checkout-form");
        function submitFunction() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                height: 600,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'info',
                title: 'Sorry! We are working on BKash. Please select cash on delivery'
            })
            // form.submit();
        }

        function submitCod() {
            form.submit();
        }
    </script>
@endsection


