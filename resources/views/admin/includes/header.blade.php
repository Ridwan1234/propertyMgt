<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">


            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                   href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('assets/images/users/default.png')}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{ auth()->user()->name}} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->

                    <a href="{{ route('admin.profile')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>{{ __('menus.My Account') }}</span>
                    </a>

                    @role('admin')
                    <a href="{{ route('admin.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>{{ __('menus.Settings') }}</span>
                    </a>
                    @endrole
                    <!-- item-->


                    <div class="dropdown-divider"></div>


                    <a class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                        <i class="fe-log-out"></i>
                        <span>{{ __('menus.Logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo.svg')}}" alt="" height="54">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo.svg')}}" alt="" height="76">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a href="" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo.svg')}}" alt="" height="54">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo.svg')}}" alt="" height="76">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>


        </ul>
        <div class="clearfix"></div>
    </div>
</div>
