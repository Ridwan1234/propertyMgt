@extends('layout.main')


@push('header-css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <!-- third party css end -->


@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">{{ __('unit.All Property Units') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">

                                @permission('unit-create')
                                <a href="{{ route('admin.property-unit.create')}}" class="btn btn-danger mb-2"><i
                                        class="mdi mdi-plus-circle mr-2"></i> {{ __('unit.Add Room') }}</a>
                                @endpermission
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    {{-- <button type="button" class="btn btn-success mb-2 mr-1">Export</button> --}}

                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table dt-responsive nowrap w-100"
                                   id="products-datatable">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>{{ __('unit.Title') }}</th>
                                    <th>{{ __('Caution') }}</th>
                                    <th>{{ __('unit.Rent') }}</th>
                                    <th>{{ __('Service Charge') }}</th>
                                    <th>{{ __('unit.Status') }}</th>
                                    <th>{{ __('unit.Parent Property') }}</th>
                                    <th>{{ __('Property Type') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th class="text-right" style="width: 75px;">{{ __('tenant.Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        @php
                        use App\Models\PropertyUnit;
                        $rooms = PropertyUnit::with('property')->latest()->get();
                        $cautionTotal = setting('currency_symbol').' '.number_format($rooms->sum('caution'),2);
                        $rentTotal = setting('currency_symbol').' '.number_format($rooms->sum('rent'),2);
                        $serviceTotal = setting('currency_symbol').' '.number_format($rooms->sum('service'),2);
                        @endphp

                        <div class="mt-3 float-left ml-2" style="display: inline-flex;">
                          <div class="ml-2">
                            <h5>Caution Total: {{ $cautionTotal }}.</h5>
                          </div>
                          <div class="ml-2">
                            <h5>Rent Total: {{ $rentTotal }}.</h5>
                          </div>
                          <div class="ml-2">
                            <h5>Service Total: {{ $serviceTotal }}.</h5>
                          </div>
                        </div>



                        <div class="float-right mt-5">
                            <p class="font-weight-bold mb-1">{{ __('unit.Statuses') }}:</p>
                            <p class="mb-0 pb-0"><span class="badge badge-pink mr-1 ">Vacant</span>
                                {{ __('unit.Room has no tenant,its available.') }}
                            </p>
                            <p class="mb-0 pb-0"><span class="badge badge-success mr-1">Occupied</span>
                                {{ __('unit.Room is currently leased.') }}
                            </p>
                            <p><span class="badge badge-secondary mr-1">Unavailable</span>
                                {{ __('unit.Parent property has been leased.') }}
                            </p>


                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->


        <!-- end row-->

    </div>

@endsection

@push('footer-scripts')

    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            "use strict";
            $("#products-datatable").DataTable({

                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.property-unit.index') !!}',
                createdRow: function (row, data, dataIndex) {
                    //      $(row).find('td:eq(0)').addClass('tx-semibold');
                    //      $(row).find('td:eq(1)').addClass('tx-semibold');
                    //      $(row).find('td:eq(2)').addClass('tx-semibold');
                    //      $(row).find('td:eq(3)').addClass('text-center');
                    //      $(row).find('td:eq(4)').addClass('tx-medium');
                    // $(row).find('td:eq(2)').addClass('text-center');
                    // $(row).find('td:eq(6)').addClass('text-right');
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'title', name: 'title', searchable: false},
                    {data: 'caution', name: 'caution', orderable: false},
                    {data: 'rent', name: 'rent', orderable: true},
                    {data: 'service', name: 'service', orderable: true},
                    {data: 'status', name: 'status', orderable: true},
                    {data: 'property', name: 'property', orderable: true},
                    {data: 'apartment_type', name: 'apartment_type', orderable: true},
                    {data: 'total', name: 'total', orderable: true},
                    {data: 'actions', name: 'actions', orderable: false},
                ],

                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    },
                },

                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            })
        });



    </script>
    <!-- third party js ends -->

@endpush
