<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    {{-- <li><a href="page-analytics.html">Analytics</a></li>
                    <li><a href="page-review.html">Review</a></li>
                    <li><a href="page-order.html">Order</a></li>
                    <li><a href="page-order-list.html">Order List</a></li>
                    <li><a href="page-general-customers.html">General Customers</a></li> --}}
                </ul>
            </li>
            @forelse ($sidebar_menus as $menu)
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">{{$menu->menu}}</span>
                    </a>
                    @if ($menu->self_menu->count() > 0)
                        <ul aria-expanded="false">
                            @foreach ($menu->self_menu as $sub_menu)
                            <li><a href="{{$sub_menu->set_route==1 ? $sub_menu->route: ''}}">{{$sub_menu->menu}}</a></li> 
                            @endforeach
                        </ul>
                    @endif
                </li>
            @empty
            @endforelse
        </ul>
        <div class="add-menu-sidebar">
            <img src="images/icon1.png" alt=""/>
            <p>Organize your menus through button bellow</p>
            <a href="{{url('admin/sidebar-menus/add')}}" class="btn btn-primary btn-block light">+ Add Menus</a>
        </div>
        <div class="copyright">
            <p><strong>Lara-Admin Dashboard</strong> © 2021 All Rights Reserved</p>
        </div>
    </div>
</div>