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
                        <form class="form-inline">

                            <a href="{{ route('admin.invoice.index') }} " class="btn btn-dark btn-sm ml-1">
                                <i class="mdi mdi-keyboard-backspace"></i> {{ __('invoice.Back To Invoices') }}
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">{{ __('invoice.Invoices List') }}</h4>
                    <input type="hidden" data-fetch-route="{{ route('admin.invoice.show', $id ) }}" id="invoicesFetch">
                </div>
            </div>
        </div>
        <!-- end page title -->

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-3"> {{__('invoice.Invoices for')}} <strong>{{ $id }}</strong></h4>
                        <div class="table-responsive">
                            <table class="table table-centered dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('invoice.TENANT') }}</th>
                                    <th>{{ __('invoice.BILLING FOR') }}</th>
                                    <th>{{ __('invoice.AMOUNT DUE')}}</th>
                                    <th>{{ __('invoice.DUE DATE') }}</th>
                                    <th>{{ __('invoice.STATUS') }}</th>
                                    <th>{{ __('invoice.ACTION') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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

            var $data_route = $("#invoicesFetch").attr('data-fetch-route');

            $("#products-datatable").DataTable({

                processing: true,
                serverSide: true,
                ajax: $data_route,
                createdRow: function (row, data, dataIndex) {
                    $(row).find('td:eq(0)').addClass('font-weight-semibold');
                    $(row).find('td:eq(1)').addClass('font-weight-semibold');
                    $(row).find('td:eq(2)').addClass('font-weight-bold');
                    $(row).find('td:eq(3)').addClass(' font-weight-bold');
                    $(row).find('td:eq(4)').addClass(' font-weight-bold');
                    //$(row).find('td:eq(4)').addClass('text-center');
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'tenant', name: 'tenant', orderable: false},
                    {data: 'property', name: 'property', orderable: false},
                    {data: 'total_due', name: 'total_due', orderable: false},
                    {data: 'due_date', name: 'due_date', orderable: false},
                    {data: 'is_paid', name: 'is_paid', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false},


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
    </script> --}}
    <!-- third party js ends -->

@endpush
