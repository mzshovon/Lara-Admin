<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Reviewer name</th>
            <th>Reviewer email</th>
            <th>Rating</th>
            <th>Reviewe Details</th>
            <th>On product</th>
            <th>Review Given</th>

            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($reviews->currentpage() - 1) * $reviews->perpage() + 1;?>
        @forelse($reviews as $review)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$review->customer_name}}</td>
                <td>{{@$review->email}}</td>
                <td>{{@$review->rating}}</td>
                <td>{{@$review->review}}</td>
                <td>{{@$review->products->name}}</td>
                <td>{{date('M',strtotime($review->created_at))}}</td>
                <td class="text-center no-wrap">
                    <a href="{{url('admin/reviews/edit/'.@$review->id)}}" class="btn btn-xs btn-outline-info"><i
                            class="la la-edit"></i> Edit</a>
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$review->id}}"
                       onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No Reviews Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $reviews->render( "pagination::bootstrap-4") }}
    </div>
</div>
