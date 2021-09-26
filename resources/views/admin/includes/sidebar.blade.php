<div class="left-side-menu">

    <div class="h-100" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">{{__('menus.Navigation')}}</li>

                <li>
                    <a href="{{ route('admin.home') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>

                        <span> {{__('menus.Dashboard')}}</span>
                    </a>

                </li>

                @permission('landlord-read')
                <li>
                    <a href="#landlords" data-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> {{ __('menus.Landlords') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="landlords">
                        <ul class="nav-second-level">

                            @permission('landlord-create')
                            <li>
                                <a href="{{ route('admin.landlord.create')}}"> {{ __('menus.Register Landlord') }}</a>
                            </li>
                            @endpermission

                            <li>
                                <a href="{{ route('admin.landlord.index')}}"> {{ __('menus.View Landlords') }}</a>
                            </li>
                            {{-- <li>
                                <a href="">Assign Room</a>
                            </li>                             --}}
                        </ul>
                    </div>
                </li>
                @endpermission

                @permission('property-read')
                <li>
                    <a href="#properties" data-toggle="collapse">
                        <i class="mdi mdi-home-outline"></i>
                        <span> {{ __('menus.Properties') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="properties">
                        <ul class="nav-second-level">

                            @permission('property-create')
                            <li>
                                <a href="{{ route('admin.property.create')}}"> {{ __('menus.Create Property') }}</a>
                            </li>
                            @endpermission
                            <li>
                                <a href="{{ route('admin.property.index')}}"> {{ __('menus.View Properties') }}</a>
                            </li>
                            {{-- <li>
                                <a href="">Assign Room</a>
                            </li>                             --}}
                        </ul>
                    </div>
                </li>
                @endpermission

                @permission('unit-read')
                <li>
                    <a href="#rooms" data-toggle="collapse">
                        <i class="mdi mdi-folder-home-outline"></i>
                        <span> {{ __('menus.Property Units') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="rooms">
                        <ul class="nav-second-level">

                            @permission('unit-create')
                            <li>
                                <a
                                    href="{{ route('admin.property-unit.create')}}">{{ __('menus.Create Property Unit') }}</a>
                            </li>

                            @endpermission
                            <li>
                                <a
                                    href="{{ route('admin.property-unit.index')}}">{{ __('menus.View Properties Units') }}</a>
                            </li>
                            {{-- <li>
                                <a href="">Assign Room</a>
                            </li>                             --}}
                        </ul>
                    </div>
                </li>
                @endpermission

                @permission('tenant-read')
                <li>
                    <a href="#tenants" data-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> {{ __('menus.Tenants') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="tenants">
                        <ul class="nav-second-level">

                            @permission('tenant-create')
                            <li>
                                <a href="{{ route('admin.tenant.create')}}">{{__('menus.Register Tenant')}}</a>
                            </li>
                            @endpermission
                            <li>
                                <a href="{{ route('admin.tenant.index')}}">{{__('menus.View Tenants')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.tenant.deactivated')}}">{{__('Deactivated Tenants')}}</a>
                            </li>
                            {{-- <li>
                                <a href="">Assign Room</a>
                            </li>                             --}}
                        </ul>
                    </div>
                </li>
                @endpermission

                @permission('lease-read')
                <li>
                    <a href="#leases" data-toggle="collapse">
                        <i class="mdi mdi-book-account-outline"></i>
                        <span> {{ __('menus.Leases / Tenancy') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="leases">
                        <ul class="nav-second-level">

                            @permission('lease-create')
                            <li>
                                <a href="{{ route('admin.lease.create')}}">{{ __('menus.Create Lease') }}</a>
                            </li>
                            @endpermission
                            <li>
                                <a href="{{ route('admin.lease.index')}}">{{ __('menus.Show Leases') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.lease.expiring')}}">Expiring Leases</a>
                            </li>

                            @permission('lease_history-read')
                            <li>
                                <a
                                    href="{{ route('admin.lease-history.index')}}">{{ __('menus.Terminated Leases') }}</a>
                            </li>

                            @endpermission


                        </ul>
                    </div>
                </li>
                @endpermission

                @permission('inventory-read')
                <li>
                    <a href="#inventory" data-toggle="collapse">
                        <i class="mdi mdi-book-search-outline"></i>
                        <span> {{ __('menus.Inventory') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="inventory">
                        <ul class="nav-second-level">

                            @permission('inventory-create')
                            <li>
                                <a href="{{ route('admin.inventory.create')}}">
                                    {{ __('menus.Add Inventory') }}
                                </a>
                            </li>
                            @endpermission
                            <li>
                                <a href="{{ route('admin.inventory.index')}}">
                                    {{ __('menus.Show Inventories') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                @endpermission


                @permission('invoice-read')
                <li>
                    <a href="{{ route('admin.invoice.index')}}">
                        <i class="mdi mdi-account-key-outline"></i>

                        <span> {{ __('menus.Invoices') }} </span>
                    </a>

                </li>
                @endpermission


                @role('admin')
                <li>
                    <a href="#deposit" data-toggle="collapse">
                        <i class="mdi mdi-book-search-outline"></i>
                        <span> {{ __('menus.Reports') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="deposit">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.report.deposit')}}">{{ __('menus.Deposits') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.report.payment.landlord')}}">
                                    {{ __('menus.Landlord Payments') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.report.invoice.unpaid')}}">
                                    {{ __('menus.Unpaid Invoices') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                @endrole


                <li>
                    <a href="{{ route('admin.ticket.index')}}">
                        <i class="mdi mdi-lifebuoy"></i>
                        <span>{{__('menus.Support Tickets')}}</span>

                    </a>

                </li>


                @permission('event-read')

                <li>
                    <a href="{{ route('admin.calendar.index')}}">
                        <i class="mdi mdi-calendar"></i>
                        <span>
                            {{__('menus.Calendar Events')}}
                        </span>
                    </a>
                </li>

                @endpermission

                <li>
                    <a href="{{ route('admin.chat')}}">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> {{__('menus.Chat')}} </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.profile')}}">
                        <i class="mdi mdi-account-key-outline"></i>

                        <span> {{__('menus.My Profile')}} </span>
                    </a>

                </li>

                @role('admin')
                <li>
                    <a href="{{ route('admin.manage-user.index')}}">
                        <i class="mdi mdi-account-key-outline"></i>

                        <span> {{__('menus.Manage Users')}} </span>
                    </a>

                </li>
                <li>
                    <a href="{{ route('admin.settings')}}">
                        <i class="mdi mdi-cog-outline"></i>
                        <span>
                            {{__('menus.Application Settings')}} </span>
                    </a>

                </li>
                <li>
                    <a href="{{ route('admin.logs')}}" target="_blank">
                        <i class="mdi mdi-folder-information-outline"></i>
                        <span> {{__('menus.Application Logs')}} </span>
                    </a>

                </li>
                @endrole


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
