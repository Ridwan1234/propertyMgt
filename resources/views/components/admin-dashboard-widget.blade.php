<div>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                            <i class="fe-heart font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3 class="mt-1">{{ $totalLandlords}}</h3>
                            <p class="text-muted mb-1 text-truncate">{{__('home.Total Registered Landlords')}}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                            <i class="fe-shopping-cart font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">{{ $totalTenants}}</h3>
                            <p class="text-muted mb-1 text-truncate">{{__('home.Total Registered Tenants')}}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                            <i class="fe-bar-chart-line- font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">{{ $totalProperties}}</h3>
                            <p class="text-muted mb-1 text-truncate">{{__('home.Total Properties')}}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                            <i class="fe-eye font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">{{ $totalUnits}}</h3>
                            <p class="text-muted mb-1 text-truncate">{{__('home.Today Property Units')}}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
</div>
