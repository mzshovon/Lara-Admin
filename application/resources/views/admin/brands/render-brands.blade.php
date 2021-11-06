<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Name</th>
            <th>Department</th>
            <th>Description</th>
            <th>Status</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($brands_list->currentpage()-1)* $brands_list->perpage() + 1;
        $statusarr = array('1' => 'Active', '2' => 'Block');
        $statusarr_class = array('1' => 'success', '2' => 'warning');?>
        @forelse($brands_list as $brand)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$brand->name}}</td>
                <td>{{@$brand->departments->name}}</td>
                <td>{{@$brand->description}}</td>
                <td><span class="badge badge-{{@$statusarr_class[@$brand->status]}}">{{@$statusarr[@$brand->status]}}</span></td>
                <td class="text-center no-wrap">
{{--
                    <a href="{{url('admin/departments/details/'.$department->id)}}" class="btn btn-xs btn-outline-primary"><i class="la la-list"></i> Details</a>
--}}
                    <a href="{{url('admin/brands/edit/'.@$brand->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                    @if($brand->status ==1)
                        <a href="javascript:" class="btn btn-xs btn-outline-warning" id="{{@$brand->id}}"
                           onclick="statusFunction(this.id)"><i class="la la-ban"></i> Block</a>
                    @else
                        <a href="javascript:" class="btn btn-xs btn-outline-success" id="{{@$brand->id}}"
                           onclick="statusFunction(this.id)"><i class="la la-check-circle-o"></i>
                            Activate</a>
                    @endif
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$brand->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No Brand Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $brands_list->render( "pagination::bootstrap-4") }}
    </div>
</div>