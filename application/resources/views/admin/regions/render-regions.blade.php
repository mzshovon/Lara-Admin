<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Region Name</th>
            <th>Region Code</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($regions_list->currentpage()-1)* $regions_list->perpage() + 1;?>
        @forelse($regions_list as $region)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$region->name}}</td>
                <td>{{@$region->code}}</td>
                <td class="text-center no-wrap">
                    <a href="{{url('admin/regions/edit/'.@$region->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$region->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No Region Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $regions_list->render( "pagination::bootstrap-4") }}
    </div>
</div>
