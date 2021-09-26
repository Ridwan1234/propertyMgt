<div>


    <div class="card d-block">
        <div class="card-body">

            <div class="float-right">

                @if (auth()->user()->hasRole(['admin','staff']))
                <div class="form-row">
                    <div class="col-auto">
                        <a href="{{ route('admin.ticket.index')}}" class="btn btn-sm btn-link"><i
                                class="mdi mdi-keyboard-backspace"></i> Back</a>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light"
                            wire:click="triggerDelete">Delete Ticket</button>
                    </div>
                </div>
                @else

                <a href="{{ route('user.ticket.index')}}" class="btn btn-sm btn-link"><i
                        class="mdi mdi-keyboard-backspace"></i> Back</a>

                @endif


                <div class="form-row">
                    <div class="col-auto">

                        @role('admin,staff,agent')
                        <a href="{{ route('admin.ticket.index')}}" class="btn btn-sm btn-link"><i
                                class="mdi mdi-keyboard-backspace"></i> Back</a>
                        @endrole

                        @role('tenant,landlord,user')
                        <a href="{{ route('user.ticket.index')}}" class="btn btn-sm btn-link"><i
                                class="mdi mdi-keyboard-backspace"></i> Back</a>
                        @endrole

                    </div>
                    <div class="col-auto">

                        @role('admin,staff,agent')
                        <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light"
                            wire:click="triggerDelete">Delete Ticket</button>
                        @endrole


                    </div>
                </div>
            </div> <!-- end dropdown-->

            <h4 class="mb-3 mt-0 font-18">{{ $subject }}</h4>

            <div class="clerfix"></div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Reported by -->
                    <label class="mt-2 mb-0">Reported By :</label>
                    <h5 class="font-weight-bold text-muted"> {{ $reportedBy}} </h5>

                    <!-- end Reported by -->
                </div> <!-- end col -->

                <div class="col-md-6">
                    <!-- assignee -->
                    <label class="mt-2 mb-1">Assigned To :</label>



                    @if (auth()->user()->hasRole(['admin','staff']))
                    <select class="form-control" wire:model="assigneeId">
                        <option value="">No Assignee</option>
                        @forelse ($users as $user)
                        <option value="{{$user->id}}">{{ $user->name}} | <small class="text-muted">
                                {{$user->roles->first()->display_name}}</small></option>
                        @empty

                        @endforelse


                    </select>
                    @else

                    <h5 class="font-weight-bold text-muted"> {{ $assignedTo}} </h5>
                    @endif


                    <!-- end assignee -->
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-md-6">
                    <!-- assignee -->
                    <label class="mt-2 mb-1">Created On :</label>
                    <h5 class="font-weight-bold text-muted"> {{ $createdOn}} </h5>

                    <!-- end assignee -->
                </div> <!-- end col -->

            </div> <!-- end row -->

            <div class="row">
                <div class="col-md-6">
                    <!-- Status -->
                    <label class="mt-2 mb-1">Status :</label>
                    <div class="form-row">
                        <div class="col-auto">
                            <select class="custom-select custom-select-sm form" wire:model="status">
                                <option value="open">Open</option>
                                <option value="closed">Close</option>
                            </select>
                        </div>
                    </div>
                    <!-- end Status -->
                </div> <!-- end col -->

                <div class="col-md-6">
                    <!-- Priority -->
                    <label class="mt-2 mb-1">Priority :</label>

                    @if (auth()->user()->hasRole(['admin','staff','agent']))
                    <div class="form-row">
                        <div class="col-auto">
                            <select class="custom-select custom-select-sm form" wire:model="priority">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                    @else

                    <p class="badge badge-blue p-1"> {{ $priority}}</p>
                    @endif



                    <!-- end Priority -->
                </div> <!-- end col -->
            </div> <!-- end row -->

            <label class="mt-4 mb-1">Overview :</label>

            <p class="text-muted mb-0">
                {{ $message}}
            </p>

        </div> <!-- end card-body-->

    </div> <!-- end card-->

    <div class="card">
        <div class="card-body">

            <div class="float-right">
                <select class="custom-select custom-select-sm " wire:model="sortOrder">
                    <option value="asc">Recent</option>
                    <option value="desc">Old</option>
                </select>
            </div> <!-- end dropdown-->

            <h4 class="mb-4 mt-0 font-16">Discussion ({{ count($comments) }})</h4>

            <div class="clerfix"></div>


            @forelse ($comments as $comment)
            <div class="media mb-3">
                <img class="mr-2 rounded-circle" src="{{ asset('assets/images/users/1.jpg')}}"
                    alt="Generic placeholder image" height="32" width="32">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{ $comment->responder->name }}
                        <small class="text-muted float-right">
                            {{ $comment->created_at->diffForHumans()}}
                        </small>
                    </h5>
                    {{ $comment->message}}



                </div>
            </div>
            @empty

            @endforelse

            <div class="border rounded mt-4">

                <textarea rows="3" class="form-control border-0 resize-none @error('reply')is-invalid @enderror"
                    placeholder="Your message..." wire:model="reply"></textarea>
                <div class="p-2 bg-light d-flex justify-content-end align-items-center">
                    {{-- <div>
                            <a href="#" class="btn btn-sm px-1 btn-light"><i class='mdi mdi-upload'></i></a>
                            <a href="#" class="btn btn-sm px-1 btn-light"><i class='mdi mdi-at'></i></a>
                        </div> --}}
                    <button type="submit" class="btn btn-sm btn-success" wire:click="replyTicket"
                        wire:loading.attr="disabled">
                        <span wire:loading wire:target="replyTicket" class="spinner-border spinner-border-sm"
                            role="status" aria-hidden="true"></span>
                        Send Reply
                    </button>
                </div>

            </div> <!-- end .border-->

        </div> <!-- end card-body-->
    </div>
    <!-- end card-->


</div>
