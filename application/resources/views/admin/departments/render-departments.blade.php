<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($departments_list->currentpage()-1)* $departments_list->perpage() + 1;
        $statusarr = array('1' => 'Active', '2' => 'Block');
        $statusarr_class = array('1' => 'success', '2' => 'warning');?>
        @forelse($departments_list as $department)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$department->name}}</td>
                <td>{{@$department->description}}</td>
                <td><span class="badge badge-{{@$statusarr_class[@$department->status]}}">{{@$statusarr[@$department->status]}}</span></td>
                <td class="text-center no-wrap">
{{--
                    <a href="{{url('admin/departments/details/'.$department->id)}}" class="btn btn-xs btn-outline-primary"><i class="la la-list"></i> Details</a>
--}}
                    <a href="{{url('admin/departments/edit/'.$department->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                    @if($department->status ==1)
                        <a href="javascript:" class="btn btn-xs btn-outline-warning" id="{{$department->id}}"
                           onclick="statusFunction(this.id)"><i class="la la-ban"></i> Block</a>
                    @else
                        <a href="javascript:" class="btn btn-xs btn-outline-success" id="{{$department->id}}"
                           onclick="statusFunction(this.id)"><i class="la la-check-circle-o"></i>
                            Activate</a>
                    @endif
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$department->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No department Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $departments_list->render( "pagination::bootstrap-4") }}
    </div>
</div>