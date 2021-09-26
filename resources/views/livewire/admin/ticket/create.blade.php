<div>
    <div class="modal-body p-3">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">{{ __('ticket.Subject') }}</label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                           wire:model.defer="subject">
                    @error('subject')<span class="text-danger">{{ $message}} </span> @enderror
                </div>
            </div>

            
            <div class="col-md-8">
                <div class="form-group">
                    <label for="field-2" class="control-label">{{ __('ticket.Assign To') }}</label>
                    <select class="form-control" wire:model="assignedTo">
                        <option value="">Default Responder</option>

                        @forelse ($users as $user)
                            <option value="{{ $user->id}}">{{ $user->name }} | {{ __('ticket.Role:') }}
                                {{ $user->roles->first()->display_name}} </option>
                        @empty

                        @endforelse
                    </select>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="field-2" class="control-label">{{ __('ticket.Priority') }}</label>
                    <select class="form-control" wire:model="priority">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                    @error('priority')<span class="text-danger">{{ $message}} </span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group no-margin">
                    <label class="control-label">{{ __('ticket.Message / Task / Description') }}</label>
                    <textarea class="form-control  @error('message') is-invalid @enderror" rows="5"
                              placeholder="Ticket details here" wire:model.lazy="message"></textarea>

                    @error('message')<span class="text-danger">{{ $message}} </span> @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect"
                data-dismiss="modal">{{ __('ticket.Close') }}</button>

        <button class="btn btn-primary waves-effect waves-light" wire:click="createTicket" wire:attr="disabled">
            <span class="spinner-border spinner-border-sm" wire:loading wire:target="createTicket" role="status"
                  aria-hidden="true"></span>
            {{ __('ticket.Create Ticket') }}
        </button>

    </div>
</div>
