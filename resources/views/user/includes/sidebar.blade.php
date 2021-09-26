<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('user.home')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>

                        <span> Dashboard </span>
                    </a>

                </li>


                @role('landlord')
                <li>
                    <a href="{{ route('user.property.index')}}">
                        <i class="mdi mdi-home-outline"></i>
                        <span>My Properties </span>
                    </a>
                </li>

                {{-- <li>
                    <a href="#" data-toggle="collapse">
                        <i class="mdi mdi-folder-home-outline"></i>
                        <span>My Property Units </span>

                    </a>
                </li> --}}

                <li>
                    <a href="{{ route('user.income')}}">
                        <i class="mdi mdi-book-search-outline"></i>
                        <span> My Income </span>

                    </a>

                </li>
                @endrole




                @role('tenant')
                <li>
                    <a href="{{ route('user.lease.index')}}">
                        <i class="mdi mdi-book-account-outline"></i>
                        <span> My Leases </span>

                    </a>

                </li>


                <li>
                    <a href="{{ route('user.invoice.index')}}">
                        <i class="mdi mdi-account-key-outline"></i>

                        <span>My Invoices </span>
                    </a>

                </li>
                @endrole










                <li>
                    <a href="{{ route('user.ticket.index')}}">
                        <i class="mdi mdi-lifebuoy"></i>
                        <span> Tickets </span>

                    </a>
                </li>

                <li>
                    <a href="{{ route('user.profile')}}">
                        <i class="mdi mdi-account-key-outline"></i>

                        <span> My Profile </span>
                    </a>

                </li>









            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>