
<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif "
                href="{{ url('user/dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) == 'orders' || Request::segment(2) == 'detail') active @endif  "
                href="{{ url('user/orders') }}">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) == 'edit-profile') active @endif "
                href="{{ url('user/edit-profile') }}">Edit Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) == 'change-password') active @endif "
                href="{{ url('user/change-password') }}">Change Password</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) == 'account-details') active @endif "
                href="{{ url('user/account-details') }}">Account Details</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link text-danger" href="{{ url('admin/logout') }}">Logout</a>
        </li>
    </ul>
</aside>