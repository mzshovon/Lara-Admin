<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Coupon Name</th>
            <th>Coupon Price</th>
            <th>Expire Date</th>
            <th>Image</th>
            <th>Product</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($coupons_list->currentpage()-1)* $coupons_list->perpage() + 1;?>
        @forelse($coupons_list as $coupon)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$coupon->coupon_name}}</td>
                <td>{{@$coupon->coupon_price}}</td>
                <td>{{Carbon\Carbon::createFromFormat('m/d/Y', $coupon->expire_date)->format('d M Y')}}</td>
                <td><img src="{{@$coupon->image_path}}" alt="Monthly Image" height="50" width="70px"></td>
                <td>{{@$coupon->products->name}}</td>
                <td class="text-center no-wrap">
                    <a href="{{url('admin/coupons/edit/'.@$coupon->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$coupon->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No Coupons Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $coupons_list->render( "pagination::bootstrap-4") }}
    </div>
</div>
