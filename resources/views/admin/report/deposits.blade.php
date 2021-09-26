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
                <h4 class="page-title">All Deposits</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">

                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table dt-responsive nowrap w-100" id="products-datatable">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Deposit For</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Tenant</th>
                                    <th>Paid On</th>
                                    <th>Expires On</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="float-left mt-3">
                        <p class="font-weight-bold mb-1">Statuses:</p>
                        <p class="mb-0 pb-0"><span class="badge badge-pink mr-1 ">Vacant</span> Room has no tenant,its available.</p>
                        <p class="mb-0 pb-0"><span class="badge badge-success mr-1">Occupied</span> Room is currently leased.</p>
                        <p><span class="badge badge-secondary mr-1">Unavailable</span> Parent property has been leased.</p>
                        
                                          
                    </div> --}}
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
                ajax: '{!! route('admin.report.deposit') !!}',
                 createdRow: function (row, data, dataIndex) {
                                  
                      $(row).find('td:eq(6)').addClass('font-weight-semibold');                   
                      $(row).find('td:eq(5)').addClass('font-weight-semibold');                   
                      $(row).find('td:eq(4)').addClass('font-weight-semibold');                   
                      $(row).find('td:eq(3)').addClass('font-weight-semibold');                   
                      $(row).find('td:eq(2)').addClass('font-weight-semibold');                   
                      $(row).find('td:eq(1)').addClass('font-weight-semibold');                   
                      $(row).find('td:eq(0)').addClass('font-weight-semibold');                   
                 },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'title', name: 'title', searchable: true},
                    {data: 'type', name: 'type', orderable: true},
                    {data: 'deposit', name: 'deposit', orderable: true},
                    {data: 'tenant', name: 'tenant', orderable: true},
                    {data: 'start_date', name: 'start_date', orderable: true},                    
                    {data: 'end_date', name: 'end_date', orderable: true},


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