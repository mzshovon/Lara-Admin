<div class="table-responsive">
    <table id="example" class="display dataTable no-footer" style="min-width: 845px">
        <thead>
            <tr>
                <th>Menu Name</th>
                <th>Reference</th>
                <th>Status</th>
                <th>Route</th>
                <th>Created date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sidebar_menus_lists as $menu)
            <tr>
                <td>{{$menu->menu}}</td>
                <td>
                    @if ($menu->preference == 0)
                        <span class='badge light badge-primary'>Mother</span>
                    @else
                        <span class='badge light badge-success'>Child</span>
                    @endif
                </td>
                <td>
                    @if ($menu->status == 1)
                        <span class='badge light badge-success'>Active</span>
                    @else
                        <span class='badge light badge-warning'>Deactive</span>   
                    @endif
                </td>
                <td>{{$menu->route ? $menu->route: 'N/A'}}</td>
                <td>{{$menu->created_at->format('d M, Y')}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{url('admin/sidebar-menus/edit/'.$menu->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                        <button class="btn btn-danger shadow btn-xs sharp" onclick="deleteFunction({{$menu->id}})"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                ! No List Available For Sidebars View !
            </tr>
            @endforelse
        </tbody>
    </table>
</div>