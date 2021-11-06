<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Name</th>
            <th>Region</th>
            <th>Amount</th>
            <th>Total Product</th>
            <th>Status</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($orders_list->currentpage()-1)* $orders_list->perpage() + 1;
        $statusarr = array('1' => 'Pending', '2' => 'Complete', '3'=>'Cancel');
        $statusarr_class = array('1' => 'warning', '2' => 'success', '3'=>'danger');?>
        @forelse($orders_list as $order)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$order->users->name}}</td>
                <td>{{@$order->shippings->regions->name}}</td>
                <td>{{@$order->total_amount}}</td>
                <td>{{@$order->orderdetails->count()}}</td>
                <td><span class="badge badge-{{@$statusarr_class[@$order->order_status]}}">{{@$statusarr[@$order->order_status]}}</span></td>
                <td class="text-center no-wrap">
                    @if($order->order_status ==1)
                        <a href="javascript:" class="btn btn-xs btn-outline-success" id="{{@$order->id}}"
                           onclick="completeFunction(this.id)"><i class="la la-ban"></i> Complete</a>
                        <a href="javascript:" class="btn btn-xs btn-outline-danger" id="{{@$order->id}}"
                           onclick="cancelFunction(this.id)"><i class="la la-check-circle-o"></i>
                            Cancel</a>
                    @elseif($order->order_status == 2)
                        <a href="javascript:" class="btn btn-xs btn-outline-warning" id="{{@$order->id}}"
                           onclick="pendingFunction(this.id)"><i class="la la-check-circle-o"></i>
                            Pending</a>
                        <a href="javascript:" class="btn btn-xs btn-outline-danger" id="{{@$order->id}}"
                           onclick="cancelFunction(this.id)"><i class="la la-check-circle-o"></i>
                            Cancel</a>
                    @elseif($order->order_status == 3)
                        <a href="javascript:" class="btn btn-xs btn-outline-success" id="{{@$order->id}}"
                           onclick="completeFunction(this.id)"><i class="la la-ban"></i> Complete</a>
                        <a href="javascript:" class="btn btn-xs btn-outline-warning" id="{{@$order->id}}"
                           onclick="pendingFunction(this.id)"><i class="la la-check-circle-o"></i>
                            Pending</a>
                    @endif
                    <a href="{{url('admin/orders/details/'.@$order->id)}}" class="btn btn-xs btn-outline-primary"><i class="la la-list"></i> Details</a>
                    {{--<a href="{{url('admin/orders/edit/'.@$order->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>--}}
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$order->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No Order Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $orders_list->render( "pagination::bootstrap-4") }}
    </div>
</div>
