<div>

    @push('header-css')
    <style>
        .img-wrap {
            position: relative;
            display: inline-block;
            font-size: 0;
        }

        .img-wrap .close {
            position: absolute;
            top: 2px;
            right: 2px;
            z-index: 100;
            background-color: #FFF;
            padding: 5px 2px 2px;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            opacity: .2;
            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
        }

        .img-wrap:hover .close {
            opacity: 1;
        }
    </style>

    @endpush


    <div class="row">
        <div class="col-md-12">
            <!-- project card -->
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <div class="custom-control custom-checkbox">
                            <form class="form-inline">

                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="status-select" class="mr-2">Inventory For : </label>
                                    <select class="custom-select" id="status-select" wire:model="inventoryForUnit">
                                        <option value="0">Property</option>
                                        <option value="1">Property Unit</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <h4 class="header-title ">Property Inventory</h4>
                    <p class="text-muted font-13 mb-5">
                        For property unit inventory creation, check the box on the right corner.
                    </p>

                    <div class="row mb-3">
                        <div class="{{ $inventoryForUnit ? 'col-md-6':'col-md-12' }}">
                            <div class="form-group">
                                <label>Select Main Property <span class="text-danger">*</span> </label>

                                <select class="form-control" id="example-select" wire:model="propertyId">

                                    <option class="font-weight-medium" label="Select Parent Property"></option>
                                    @forelse ($properties as $item=>$key)
                                    <option class="font-weight-medium" value="{{ $key}}">{{ $item}}</option>
                                    @empty

                                    @endforelse


                                </select>
                                @error('propertyId') <span class="text-danger font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($inventoryForUnit)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Property Unit</label>
                                <select class="form-control" id="example-select2" wire:model="unitId">

                                    <option class="font-weight-medium" label="Select Parent Property"></option>
                                    @forelse ($units as $item=>$key)
                                    <option class="font-weight-medium" value="{{ $key}}">{{ $item}}</option>
                                    @empty

                                    @endforelse


                                </select>
                                @error('unitId') <span class="text-danger font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif

                    </div>



                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description/Features <span class="text-danger">*</span></label>
                                <textarea wire:model.defer="description" class="form-control" id="example-textarea"
                                    rows="4" placeholder="Room features and description"></textarea>
                                @error('description') <span class="text-danger font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Upload Room Images</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="file-{{ $iteration}}"
                                        placeholder="Upload Room Images" multiple wire:model.lazy="photos"
                                        aria-label="Room Images" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <div class="spinner-border spinner-border-sm" wire:loading
                                                wire:target="photos" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @error('photos') <span class="text-danger font-weight-bold mt-0">{{ $message }}</span>
                            @enderror
                            @error('photos.*')
                            <span class="text-danger font-weight-bold mt-0">{{ $message }}</span>
                            @enderror



                            @if ($photos && !$errors->has('photos.*'))
                            @foreach($photos as $photo)
                            <div class="img-wrap mr-2 mb-2" wire:key="{{$loop->index}}">
                                <span wire:click="removePhoto({{ $loop->index }})" class="close">&times;</span>
                                <img src="{{ $photo->temporaryUrl() }}" alt="image" style="width:auto;"
                                    class="img-fluid avatar-xl rounded">
                            </div>
                            @endforeach

                            @endif
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-success waves-effect waves-light" wire:click="addInventory"
                            wire:attr="disabled">
                            <span class="spinner-border spinner-border-sm" wire:loading wire:target="addInventory"
                                role="status" aria-hidden="true"></span>
                            Create Inventory
                        </button>
                    </div>



                </div> <!-- end card-body-->

            </div> <!-- end card-->

        </div> <!-- end col -->

    </div>
</div>