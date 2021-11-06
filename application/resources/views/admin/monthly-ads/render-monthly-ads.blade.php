<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Ad Name</th>
            <th>Ad's Month</th>
            <th>Image</th>
            <th>Product</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($ads_list->currentpage()-1)* $ads_list->perpage() + 1;?>
        @forelse($ads_list as $ads)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$ads->ads_name}}</td>
                <td>{{@$ads->created_at->format('M')}}</td>
                <td><img src="{{@$ads->image_path}}" alt="Monthly Image" height="50" width="70px"></td>
                <td>{{@$ads->products->name}}</td>
                <td class="text-center no-wrap">
                    <a href="{{url('admin/monthly-ads/edit/'.@$ads->id)}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$ads->id}}" onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No Monthly Ads Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $ads_list->render( "pagination::bootstrap-4") }}
    </div>
</div>
