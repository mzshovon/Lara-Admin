<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Orders</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($users_list->currentpage()-1)* $users_list->perpage() + 1;
        $statusarr = array('1' => 'Active', '2' => 'Block');
        $statusarr_class = array('1' => 'success', '2' => 'warning');?>
        @forelse($users_list as $user)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$user->name}}</td>
                <td>{{@$user->email}}</td>
                <td>{{@$user->phone}}</td>
                <td>{{@$user->orders->count()}}</td>
                <td class="text-center no-wrap">
                    <a href="{{url('admin/users/details/'.@$user->id)}}" class="btn btn-xs btn-outline-primary"><i class="la la-list"></i> Details</a>
                    <a href="{{url('admin/users/edit/'.@$user->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$user->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No User Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $users_list->render( "pagination::bootstrap-4") }}
    </div>
</div>
