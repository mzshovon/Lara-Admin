<div class="table-responsive">
    <table class="table table-striped contentMiddle">
        <thead>
        <tr>
            <th width="3%">#</th>
            <th>Slider title</th>
            <th>Created Month</th>
{{--            <th>Banner placement</th>--}}
            <th>Image</th>
            <th width="1%" class="text-center no-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $row_count = ($slider->currentpage() - 1) * $slider->perpage() + 1;?>
        @forelse($slider as $sliders)
            <tr>
                <td>{{$row_count++}}</td>
                <td>{{@$sliders->title}}</td>
                <td>{{date('M',strtotime($sliders->created_at))}}</td>
                <td><img src="{{url('/'.@$sliders->image)}}" alt="Monthly Image" height="50" width="70px"></td>

                <td class="text-center no-wrap">
                    <a href="{{url('admin/slider/edit/'.@$sliders->id)}}" class="btn btn-xs btn-outline-info"><i
                            class="la la-edit"></i> Edit</a>
                    <a href="javascript:" class="btn btn-xs btn-outline-danger user-delete" id="{{@$sliders->id}}"
                       onclick="deleteFunction(this.id)"><i class="la la-trash-o"></i> Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align: center"><h6>No Sliders Available</h6></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <div class="d-flex">
        <div class="mr-auto"></div>
        {{ $slider->render( "pagination::bootstrap-4") }}
    </div>
</div>
