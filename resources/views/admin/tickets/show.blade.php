@extends('layout.main')


@push('header-css')


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
                    <h4 class="page-title">{{ __('ticket.Detail Ticket') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                @livewire('admin.ticket.show', ['ticketId' => $id])


            </div> <!-- end col -->
        </div>
        <!-- end row -->


        <!-- end row-->

    </div>

@endsection

@push('footer-scripts')



@endpush
