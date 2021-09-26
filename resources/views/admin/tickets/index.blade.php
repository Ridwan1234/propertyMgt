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
                    <h4 class="page-title">{{ __('ticket.Tickets') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <x-admin-tickets-statistics/>
        <!-- end row -->


        <div class="row">
            <div class="col-12">

                <div class="card-box">
                    <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right"
                            data-toggle="modal" data-target="#ticket-modal">
                        <i class="mdi mdi-plus-circle"></i> {{ __('ticket.Add Ticket') }}
                    </button>
                    <h4 class="header-title mb-4">{{ __('ticket.Manage Tickets') }}</h4>

                    <table class="table m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                        <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>{{ __('ticket.Requested By') }}</th>
                            <th>{{ __('ticket.Subject') }}</th>
                            <th>{{ __('ticket.Assignee') }}</th>
                            <th>{{ __('ticket.Priority') }}</th>
                            <th>{{ __('ticket.Status') }}</th>
                            <th>{{ __('ticket.Created Date') }}</th>
                            <th class="hidden-sm">{{ __('tenant.Action') }}</th>
                        </tr>
                        </thead>

                        <tbody>


                        </tbody>

                    </table>


                </div>


            </div> <!-- end col -->
        </div>
        <!-- end row -->


        <!-- end row-->

    </div>



    <!-- sample modal content -->

    <div id="ticket-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">{{ __('ticket.Create New Ticket') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                @livewire('admin.ticket.create')
            </div>
        </div>
    </div><!-- /.modal -->

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
            $("#tickets-table").DataTable({

                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.ticket.index') !!}',
                createdRow: function (row, data, dataIndex) {
                    //      $(row).find('td:eq(0)').addClass('tx-semibold');
                    //      $(row).find('td:eq(1)').addClass('tx-semibold');
                    //      $(row).find('td:eq(2)').addClass('tx-semibold');
                    //      $(row).find('td:eq(3)').addClass('text-center');
                    //      $(row).find('td:eq(4)').addClass('tx-medium');
                    $(row).find('td:eq(7)').addClass('text-center');
                    $(row).find('td:eq(8)').addClass('text-right');
                },
                columns: [
                    {data: 'id', name: 'id', orderable: true, searchable: false},
                    {data: 'author', name: 'author', searchable: false},
                    {data: 'subject', name: 'subject', orderable: false},
                    {data: 'assignee', name: 'assignee', orderable: false},
                    {data: 'priority', name: 'priority', orderable: true},
                    {data: 'status', name: 'status', orderable: true},
                    {data: 'created_at', name: 'created_at', orderable: true},

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
    </script> --}}
    <!-- third party js ends -->

@endpush
