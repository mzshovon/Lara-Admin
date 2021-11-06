<div class="header--sidebar"></div>
<header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                    <p>Nikunju-2, Khilkhet, Dhaka, Bangladesh</p>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                    @guest
                    <div class="header__actions">
                        <a href="{{url('/login')}}">Login & Register</a>
                    </div>
                    @else
                        <div class="header__actions" >
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="text-align: center!important;">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <hr>
                                <a class="dropdown-item" href="{{ route('track_order') }}"
                            style="margin: 12px!important;">
                                    {{ __('Track your order') }}
                                </a>
                                <hr>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container-fluid">
            <div class="navigation__column left">
                <div class="header__logo"><a class="ps-logo" href="{{asset('/')}}"><img alt="" src="{{asset('/')}}assets/admin/Superstudio (1).png" style="height: 120px;width: 280px"></a>
                </div>
            </div>
            <div class="navigation__column center">
                <ul class="main-menu menu">
                    <li class="menu-item" ><a href="{{asset('/')}}">Home</a></li>
                    <li class="menu-item menu-item-has-children dropdown"><a href="#">All Departments</a>
                        <ul class="sub-menu">
                            @forelse($departments as $department)
                            <li class="menu-item menu-item-has-children dropdown"><a href="#">{{@$department->name}}</a>
                                <ul class="sub-menu">
                                    @forelse($department->categories as $category)
                                    <li class="menu-item"><a href="{{url('/category-products/'.@$category->id)}}">{{@$category->name}}</a></li>
                                    @empty
                                    <li class="menu-item"><a href="#">No Category Available</a></li>
                                    @endforelse
                                </ul>
                            </li>
                            @empty
                            <li class="menu-item"><a href="#">No Department Available</a></li>
                                @endforelse
                        </ul>
                    </li>
                    <li class="menu-item"><a href="{{url('/new-items')}}">New Items</a></li>
                    <li class="menu-item"><a href="{{url('/get-coupons')}}">Get Coupons</a></li>
{{--                    <li class="menu-item"><a href="{{url('/monthly-ad')}}">Monthly Ad</a></li>--}}

                </ul>
            </div>

            <div class="navigation__column right" >

                <form action="{{route('search_products')}}" class="ps-search--header" method="post">
                    {{csrf_field()}}

{{--                    <input class="form-control" name="product_name" placeholder="Search Product…" type="number" style="width: 90px!important;">--}}
                    <input class="form-control" name="product_name" placeholder="Search Product…" type="text" >
                    <button><i class="ps-icon-search"></i></button>

{{--                    <input class="form-control" name="product_name" placeholder="Search Product…" type="text">--}}
                </form>
                <div class="ps-cart" id="refresh">
                    @include('frontend.layouts.includes.cart')
                </div>

                <div class="menu-toggle"><span></span></div>

            </div>
        </div>
    </nav>
</header>
