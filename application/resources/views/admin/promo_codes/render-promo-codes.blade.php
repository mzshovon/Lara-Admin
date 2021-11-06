<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Code</th>
            <th>Percentage</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($promo_list->currentpage()-1)* $promo_list->perpage() + 1;?>
        @forelse($promo_list as $promo_array)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$promo_array->code}}</td>
                <td>{{@$promo_array->percent}}</td>
                <td class="text-center no-wrap">
                    <a href="{{url('admin/promos/edit/'.@$promo_array->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                    @if($promo_array->status ==1)
                        <a href="javascript:" class="btn btn-xs btn-outline-warning" id="{{@$promo_array->id}}"
                           onclick="statusFunction(this.id)"><i class="la la-ban"></i> Block</a>
                    @else
                        <a href="javascript:" class="btn btn-xs btn-outline-success" id="{{@$promo_array->id}}"
                           onclick="statusFunction(this.id)"><i class="la la-check-circle-o"></i>
                            Activate</a>
                    @endif
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$promo_array->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No promo code Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $promo_list->render( "pagination::bootstrap-4") }}
    </div>
</div>
