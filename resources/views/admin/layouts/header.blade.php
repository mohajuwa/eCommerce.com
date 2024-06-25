<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>


    <ul class="navbar-nav ml-auto">

        @php
        $getUnreadNotifications = App\Models\NotificationModel::getUnreadNotifications();
        @endphp
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>



        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{$getUnreadNotifications->count()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{$getUnreadNotifications->count()}} Notifications</span>
                <div class="dropdown-divider"></div>

                @foreach ($getUnreadNotifications as $noti )

                <div class="dropdown-divider"></div>
                <a href="{{url($noti->url)}}?noti_id={{$noti->id}}" class="dropdown-item">
                    <div>
                        {{$noti->message}}
                    </div>
                    <div class=" text-muted text-sm">{{date('d-m-Y h:i A',
                        strtotime($noti->created_at))}}</div>
                </a>

                <div class="dropdown-divider"></div>

                @endforeach

                <div class="dropdown-divider"></div>
                <a href="{{url('admin/notification')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>


    </ul>
</nav>

@include('admin.layouts.sidebar')