@extends('layout.user')


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
                <h4 class="page-title">Leases / Tenancy</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->




    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100"
                            id="products-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Rent</th>
                                    <th>Bills</th>
                                    <th class="text-right" style="width: 75px;">Action</th>
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
                ajax: '{!! route('user.lease.index') !!}',
                 createdRow: function (row, data, dataIndex) {
                                    $(row).find('td:eq(2)').addClass('font-weight-semibold');                   
                                    $(row).find('td:eq(5)').addClass('font-weight-bold');                   
                                    $(row).find('td:eq(6)').addClass('font-weight-bold');                   
                      $(row).find('td:eq(7)').addClass('text-right');                   
                 },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'title', name: 'title', searchable: false},
                    {data: 'type', name: 'type', orderable: false},
                                       {data: 'start_date', name: 'start_date', orderable: false},
                    {data: 'end_date', name: 'end_date', orderable: false},                    
                    {data: 'rent', name: 'rent', orderable: false},                    
                    {data: 'bills_sum_amount', name: 'bills_sum_amount', orderable: false},                    
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
</script>


@endpush