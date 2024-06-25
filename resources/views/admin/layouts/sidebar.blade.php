<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @php
    $getSystemSettingApp = App\Models\SystemSettingModel::getSingle();

    @endphp
    <div class="brand-link text-center  ">
        <img  src="{{ $getSystemSettingApp->getFevIcon() }}"  alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text ">{{ $getSystemSettingApp->website_name }}</span>
    </div>


    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('public/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/admin/list') }}"
                        class="nav-link @if (Request::segment(2) == 'admin') active @endif @if (Request::segment(2) == 'admin' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'admin' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/customer/list') }}"
                        class="nav-link @if (Request::segment(2) == 'customer') active @endif @if (Request::segment(2) == 'customer' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'customer' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/order/list') }}"
                        class="nav-link @if (Request::segment(2) == 'order') active @endif @if (Request::segment(2) == 'order' && Request::segment(3) == 'detail') bg-warning @endif  @if (Request::segment(2) == 'order' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/category/list') }}"
                        class="nav-link @if (Request::segment(2) == 'category') active @endif @if (Request::segment(2) == 'category' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'category' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-list-alt"></i>
                        <p>
                            Categorty
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/sub_category/list') }}"
                        class="nav-link @if (Request::segment(2) == 'sub_category') active @endif @if (Request::segment(2) == 'sub_category' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'sub_category' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-list-alt"></i>
                        <p>
                            Sub Categorty
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/product/list') }}"
                        class="nav-link @if (Request::segment(2) == 'product') active @endif @if (Request::segment(2) == 'product' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'product' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-shopping-bag"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/brand/list') }}"
                        class="nav-link @if (Request::segment(2) == 'brand') active @endif @if (Request::segment(2) == 'brand' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'brand' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-bars"></i>
                        <p>
                            Brand
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/color/list') }}"
                        class="nav-link @if (Request::segment(2) == 'color') active @endif @if (Request::segment(2) == 'color' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'color' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Color

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/discount_code/list') }}"
                        class="nav-link @if (Request::segment(2) == 'discount_code') active @endif @if (Request::segment(2) == 'discount_code' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'discount_code' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-gift"></i>
                        <p>
                            Coupon Code
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/shipping_charge/list') }}"
                        class="nav-link @if (Request::segment(2) == 'shipping_charge') active @endif @if (Request::segment(2) == 'shipping_charge' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'shipping_charge' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-car"></i>
                        <p>
                            Shipping Charge
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/slider/list') }}"
                        class="nav-link @if (Request::segment(2) == 'slider') active @endif @if (Request::segment(2) == 'slider' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'slider' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-copy"></i>
                        <p>
                            Slider
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/partner/list') }}"
                        class="nav-link @if (Request::segment(2) == 'partner') active @endif @if (Request::segment(2) == 'partner' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'partner' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-handshake"></i>
                        <p>
                            Partner Logo
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/contact_us') }}"
                        class="nav-link @if (Request::segment(2) == 'contact_us') active @endif @if (Request::segment(2) == 'contact_us' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'contact_us' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas  fa-phone"></i>
                        <p>
                            Contact us
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/page/list') }}"
                        class="nav-link @if (Request::segment(2) == 'page') active @endif @if (Request::segment(2) == 'page' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'page' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Page
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ url('admin/blog_category/list') }}"
                        class="nav-link @if (Request::segment(2) == 'blog_category') active @endif @if (Request::segment(2) == 'blog_category' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'blog_category' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Blog Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/blog/list') }}"
                        class="nav-link @if (Request::segment(2) == 'blog') active @endif @if (Request::segment(2) == 'blog' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'blog' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            Blog
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/system-setting') }}"
                        class="nav-link @if (Request::segment(2) == 'system-setting') active @endif @if (Request::segment(2) == 'system-setting' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'system-setting' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            System Settings
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/home-setting') }}"
                        class="nav-link @if (Request::segment(2) == 'home-setting') active @endif @if (Request::segment(2) == 'home-setting' && Request::segment(3) == 'add') bg-warning @endif  @if (Request::segment(2) == 'home-setting' && Request::segment(3) == 'edit') bg-secondary @endif">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Home Settings
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Layout Options
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/layout/top-nav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation + Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/boxed.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Boxed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar <small>+ Custom Area</small></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Navbar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-footer.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Footer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Collapsed Sidebar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Charts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ChartJS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Flot</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/inline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/uplot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>uPlot</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            UI Elements
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/UI/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/icons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Icons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/buttons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buttons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/sliders.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/modals.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modals & Alerts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/navbar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Navbar & Tabs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/timeline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Timeline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/ribbons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ribbons</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Forms
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Editors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/validation.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Validation</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Tables
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Tables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DataTables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/jsgrid.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>jsGrid</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item ">
                    <a href="{{ url('admin/logout') }}" class="nav-link  bg-danger">
                        <i class="nav-icon fas    fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>