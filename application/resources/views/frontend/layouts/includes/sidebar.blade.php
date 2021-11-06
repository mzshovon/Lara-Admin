<button class="m-aside-left-close  m-aside-left-close--skin-lilght " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>

<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu"
         class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light "
         m-menu-vertical="1"
         m-menu-scrollable="1"
         m-menu-dropdown-timeout="500"
         style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item  {{@$dashboard}}" aria-haspopup="true">
                <a href="{{url('/admin')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Dashboard</span>
                            <span class="m-menu__link-badge">
                                {{--<span class="m-badge m-badge--danger">2</span>--}}
                            </span>
                        </span>
                    </span>
                </a>
            </li>

            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Components</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>

            {{--<li class="m-menu__item  {{@$posts}}" aria-haspopup="true">
                <a href="{{url('/posts')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-file-1"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Posts</span>
                        </span>
                    </span>
                </a>
            </li>--}}

            <li class="m-menu__item  m-menu__item--submenu {{@$users}}" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Users</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{@$add_user}}" aria-haspopup="true">
                            <a href="{{url('admin/users/add')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New User</span>
                            </a>
                        </li>
                        <li class="m-menu__item {{@$user_list}}" aria-haspopup="true">
                            <a href="{{url('admin/users')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">User List</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item  m-menu__item--submenu {{@$departments}}" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Departments</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{@$add_department}}" aria-haspopup="true">
                            <a href="{{url('admin/departments/add')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New Department</span>
                            </a>
                        </li>
                        <li class="m-menu__item {{@$department_list}}" aria-haspopup="true">
                            <a href="{{url('admin/departments')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Department List</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item  m-menu__item--submenu {{@$categories}}" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Categories</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{@$add_category}}" aria-haspopup="true">
                            <a href="{{url('admin/categories/add')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New Category</span>
                            </a>
                        </li>
                        <li class="m-menu__item {{@$category_list}}" aria-haspopup="true">
                            <a href="{{url('admin/categories')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Category List</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item  m-menu__item--submenu {{@$brands}}" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Brands</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{@$add_brand}}" aria-haspopup="true">
                            <a href="{{url('admin/brands/add')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New Brand</span>
                            </a>
                        </li>
                        <li class="m-menu__item {{@$brand_list}}" aria-haspopup="true">
                            <a href="{{url('admin/brands')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Brand List</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item  m-menu__item--submenu {{@$products}}" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Products</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{@$add_product}}" aria-haspopup="true">
                            <a href="{{url('admin/products/add')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New Product</span>
                            </a>
                        </li>
                        <li class="m-menu__item {{@$product_list}}" aria-haspopup="true">
                            <a href="{{url('admin/products')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Product List</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            {{--<li class="m-menu__item  m-menu__item--submenu {{@$ads}}" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon la la-list-alt"></i>
                    <span class="m-menu__link-text">Ads</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{@$add_ad}}" aria-haspopup="true">
                            <a href="{{url('admin/ads/add')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Add New Ad</span>
                            </a>
                        </li>
                        <li class="m-menu__item {{@$ad_list}}" aria-haspopup="true">
                            <a href="{{url('admin/ads')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Ad List</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item  {{@$feedback}}" aria-haspopup="true">
                <a href="{{url('admin/feedbacks')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-comment"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Feedback</span>
                        </span>
                    </span>
                </a>
            </li>

            <li class="m-menu__item  {{@$contactMessages}}" aria-haspopup="true">
                <a href="{{url('#contact-messages')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-email"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Contact Messages</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{@$settings}}" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-cogwheel"></i>
                    <span class="m-menu__link-text">Settings</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{url('#candidates/candidate-list')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">General Settings</span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{url('#candidates/favourite-list')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">About</span></a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{url('#candidates/favourite-list')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Terms &amp; Condition</span></a>
                        </li>
                    </ul>
                </div>
            </li>--}}
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>