<div>

    @push('header-css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css"
        integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A=="
        crossorigin="anonymous" />

    @endpush

    <div class="modal-body">

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="control-label">Event Title</label>
                    <input class="form-control" type="text" wire:model.lazy="title" />
                    @error('title')
                    <span class="text-danger font-weight-semibold">
                        {{ $message}}
                    </span>
                    @enderror

                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="billing-town-city">Event Start Date</label>
                    <div class="input-group">
                        <input type="text" class="form-control tx-semibold" wire:model="startDate"
                            data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd/mm/yyyy"
                            data-date-autoclose="true" id="start_date" readonly
                            onchange="this.dispatchEvent(new InputEvent('input'))">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                    @error('startDate')
                    <span class="text-danger font-weight-semibold">
                        {{ $message}}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="billing-state">Event End Date</label>
                    <div class="input-group">
                        <input type="text" class="form-control tx-semibold" wire:model="endDate"
                            data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd/mm/yyyy"
                            data-date-autoclose="true" id="start_date" readonly
                            onchange="this.dispatchEvent(new InputEvent('input'))">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>

                    @error('endDate')
                    <span class="text-danger font-weight-semibold">
                        {{ $message}}
                    </span>
                    @enderror
                </div>
            </div>


        </div>
        <div class="row mt-2">
            <div class="col-6">
                @permission('event-delete')

                <button type="button" class="btn btn-danger"
                    onclick="confirm('Confirm deletion of this event ?') || event.stopImmediatePropagation()"
                    wire:click="deleteSchedule">Delete</button>
                @endpermission
            </div>
            <div class="col-6 text-right">
                <button type="button" class="btn btn-light mr-1" data-dismiss="modal">Close</button>

                @permission('event-update')
                <button class="btn btn-success " wire:click="updateSchedule" wire:attr="disabled">
                    <span class="spinner-border spinner-border-sm" wire:loading wire:target="updateSchedule"
                        role="status" aria-hidden="true"></span>
                    Save
                </button>

                @endpermission

            </div>
        </div>
    </div>

    @push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous">
    </script>



    <script>
        Livewire.on('openEditModal', function(){
            $('#edit-event-modal').modal('show');
        })
    </script>

    @endpush
</div>