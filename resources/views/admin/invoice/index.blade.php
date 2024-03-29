@extends('layout.main')


@push('header-css')
<!-- third party css -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
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
                <h4 class="page-title"> {{ __('invoice.Invoices Listing By Month') }}</h4>
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

                    <div class="mt-2 mb-3">
                        <a href="{{ route('admin.generate-invoice.command') }}" class="btn btn-primary">
                            Generate Invoice For Month {{ now()->format('m Y')}}</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered dt-responsive nowrap w-100" id="products-datatable">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>{{ __('landlord.Month') }}</th>
                                    <th>{{ __('invoice.NO OF INVOICES') }}</th>
                                    <th>{{ __('invoice.TOTAL DUE') }}</th>
                                    <th class="text-center">{{ __('invoice.SHOW') }}</th>
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
            $("#products-datatable").DataTable({

                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.invoice.index') !!}',
                createdRow: function (row, data, dataIndex) {
                    $(row).find('td:eq(0)').addClass('font-weight-semibold');
                    $(row).find('td:eq(1)').addClass('font-weight-semibold');
                    $(row).find('td:eq(2)').addClass('font-weight-bold');
                    $(row).find('td:eq(3)').addClass(' font-weight-bold');
                    $(row).find('td:eq(4)').addClass('text-center');
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'invoicable_month', name: 'invoicable_month', searchable: false, orderable: false},
                    {data: 'invoices_count', name: 'invoices_count', orderable: false},
                    {data: 'invoices_total_due', name: 'invoices_total_due', orderable: false},
                    {data: 'show', name: 'show', orderable: false},


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