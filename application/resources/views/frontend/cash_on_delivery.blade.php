@extends('frontend.layouts.app')
@section('content')
    <div class="container" style="border: 1px solid #5a9bc7; border-radius: 8px;margin-top: 15px;-webkit-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.75);
box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.75); ">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Order Details</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Order Details</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->

        <div class="m-content">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-md-12 post-details">
                            <div class="row">
                                <div class="col-md-4">
                                    <table class="table table-striped">
                                        <h5>Order Information</h5>
                                        <tr>
                                            <td width="150">Total Amount</td>
                                            <td width="20" class="text-center">:</td>
                                            <td><b>{{@$orders->total_amount}} ৳</b></td>
                                        </tr>
                                        <tr>
                                            <td width="150">Order Date</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->created_at->format('d M, Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Order Status</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>
                                                <?php
                                                if(@$orders->order_status == 1)
                                                    echo "Pending";
                                                elseif(@$orders->order_status == 2)
                                                    echo "Complete";
                                                elseif(@$orders->order_status == 3)
                                                    echo "Cancel";
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-striped">
                                        <h5>User Information</h5>
                                        <tr>
                                            <td width="150">User Name</td>
                                            <td width="20" class="text-center">:</td>
                                            <td><b>{{@$orders->users->name}}</b></td>
                                        </tr>
                                        <tr>
                                            <td width="150">User Email</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->users->email}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">User Phone</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->users->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">User City</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->users->city}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <h5>Shipping Information</h5>
                                    <table class="table table-striped">
                                        <tr>
                                            <td width="150">Name</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->shippings->name}}</td>
                                        </tr>

                                        <tr>
                                            <td width="150">Email</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->shippings->email}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">phone</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->shippings->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Address</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->shippings->address}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Customer Notes</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->shippings->customer_notes}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Region</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->shippings->regions->name}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Region Post Code</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->shippings->regions->code}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <h5>Payment Information</h5>
                                    <table class="table table-striped">
                                        <tr>
                                            <td width="150">Reference No</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$orders->payments->reference}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <h5>ORDER'S PRODUCT LIST</h5>
                            <table class="table table-striped contentMiddle">
                                <thead>
                                <tr>
                                    <th width="3%">#</th>
                                    <th>Name</th>
                                    <th>Ordered Quantity</th>
                                    <th>Available Quantity</th>
                                    <th>Net Weight</th>
                                    <th>New Price</th>
                                    <th>Old Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $row_count = 1;?>
                                @forelse($orders->orderdetails as $orderdetail)
                                    <tr>
                                        <td>{{$row_count++}}</td>
                                        <td>{{@$orderdetail->products->name}}</td>
                                        <td>{{@$orderdetail->product_quantity}}</td>
                                        <td>{{@$orderdetail->products->quantity}}</td>
                                        <td>{{@$orderdetail->products->weight}}</td>
                                        <td>{{@$orderdetail->products->new_price}}</td>
                                        <td>{{@$orderdetail->products->old_price}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" style="text-align: center"><h6>No Order Available</h6></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <br>
@endsection


@section('scripts')
    <script>
        function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
        // To disable f5
        /* jQuery < 1.7 */
        $(document).bind("keydown", disableF5);
        /* OR jQuery >= 1.7 */
        $(document).on("keydown", disableF5);

        // To re-enable f5
        /* jQuery < 1.7 */
        $(document).unbind("keydown", disableF5);
        /* OR jQuery >= 1.7 */
        $(document).off("keydown", disableF5);
    </script>
@endsection
