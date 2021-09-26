<div>
    <div class="row p-3">

        <div class="col-3">
            <button type="button" data-toggle="modal" data-target="#upload-modal"
                class="btn btn-success btn-block waves-effect waves-light ">
                <i class="mdi mdi-plus"></i>
                Upload New Document
            </button>
        </div>

        <div class="col-12">
            <div class="mt-3">
                <h5 class="mb-2">Attachments</h5>

                <div class="row mx-n1 no-gutters">


                    @forelse ($documents as $item)
                    <div class="col-xl-3 col-lg-6">
                        <div class="card m-1 shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i class="mdi mdi-folder font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col pl-0">
                                        <a href="{{ url($item->document )}}" target="_blank" class="text-muted font-weight-medium">
                                            Document {{ $loop->iteration }}
                                        </a>
                                        <p class="mb-0 font-13">
                                            {{  round(File::size( public_path($item->document)) / 1024 / 1024,2) }}
                                            MB
                                        </p>
                                    </div>

                                    <div class="col-auto">
                                        <!-- Button -->
                                        <a href="javascript:void(0);"
                                            onclick="confirm('Delete this document ?') || event.stopImmediatePropagation()"
                                            wire:click="deleteDocument({{ $item->id }})"
                                            class="btn btn-link btn-lg text-muted">
                                            <i class="dripicons-trash"></i>
                                        </a>
                                    </div>

                                </div> <!-- end row -->
                            </div> <!-- end .p-2-->
                        </div> <!-- end col -->
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>This tenancy does not have any files associated.Consider uploading some
                                now.
                            </strong>
                        </div>
                    </div>

                    @endforelse

                    <!-- end col-->




                </div> <!-- end row-->
            </div>

        </div>
    </div>
</div>
