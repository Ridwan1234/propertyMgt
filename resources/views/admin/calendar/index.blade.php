@extends('layout.main')


@push('header-css')

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css" />
<style>
    .fc .fc-button {
        text-transform: capitalize;
    }
</style>

@endpush

@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                    @permission('event-create')

                    <button class="btn btn-lg font-16 btn-block btn-primary" id="btn-new-event" data-toggle="modal"
                        data-target="#add-event-modal"><i class="mdi mdi-plus-circle-outline"></i> Create New
                        Event</button>

                    @endpermission
                </div>
                <h3 class="page-title">Calendar Schedule</h3>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @if (session()->has('success'))
    <div class="col-12 mb-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            {!! $calendar->calendar() !!}
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- end row-->


    <!-- Edit Event MODAL -->
    <div class="modal fade" id="edit-event-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="modal-title">Event</h5>
                </div>
                @livewire('admin.calendar.edit-schedule')
            </div> <!-- end modal-content-->
        </div> <!-- end modal dialog-->
    </div>
    <!-- end modal-->

    <!-- Add New Event MODAL -->
    <div class="modal fade" id="add-event-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header py-2 px-4 border-bottom-0 d-block">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">Add New Event/Schedule</h4>
                </div>
                @livewire('admin.calendar.add-schedule')
            </div> <!-- end modal-content-->
        </div> <!-- end modal dialog-->
    </div>
    <!-- end modal-->

</div>

@endsection

@push('footer-scripts')
{!! $calendar->script() !!}

{{-- <script>
    Livewire.on('calendarClicked', eventId => {
    alert('Event has been clicked with id : ' + eventId);
})

</script> --}}
@endpush