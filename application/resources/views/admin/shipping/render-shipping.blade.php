<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Region Name</th>
            <th>Shipping Cost</th>
            <th>Product Weight Range</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = (@$shipping_costs_list->currentpage()-1)* @$shipping_costs_list->perpage() + 1;?>
        @forelse($shipping_costs_list as $shipping_cost)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$shipping_cost->regions->name}}</td>
                <td>{{@$shipping_cost->cost}}</td>
                <td>{{@$shipping_cost->weight_range}}</td>
                <td class="text-center no-wrap">
                    <a href="{{url('admin/shipping/edit/'.@$shipping_cost->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$shipping_cost->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No Shipping Cost Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $shipping_costs_list->render( "pagination::bootstrap-4") }}
    </div>
</div>
