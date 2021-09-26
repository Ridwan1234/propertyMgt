<div>
    <div class="row p-2">
        <div class="col-6">
            <div class="border p-3 rounded mb-3 ">

                <div class="">
                    <label class=" font-16 font-weight-bold">
                        {{ __('property.Landlord') }}
                    </label>
                </div>

                <h5 class="mt-3">{{ $landlordName}}</h5>
                <p class="mb-2"><span class="font-weight-semibold mr-2">Address:</span> {{ $landlordAddress}}</p>
                <p class="mb-2"><span class="font-weight-semibold mr-2">Phone:</span> {{ $landlordPhone}}</p>

            </div>
        </div>
        <div class="col-6">
            <div class="border p-3 rounded mb-3 mb-md-0">


                <label class=" font-16 font-weight-bold">
                    {{ __('property.Transfer Ownership') }}
                </label>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('property.New Landlord') }}</label>
                            <select title="Country" class="form-control" wire:model="newLandlordId">
                                <option value="">{{ __('property.Select Landlord') }}</option>

                                @forelse ($landlords as $item=>$id)
                                    <option value="{{ $id}}">{{ $item}}</option>
                                @empty

                                @endforelse
                            </select>

                            @error('newLandlordId')
                            <span class="text-danger font-weight-bold">{{ $message}}</span>
                            @enderror


                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row-reverse mt-2">
                    <button class="btn btn-success" wire:click="transferProperty" wire:attr="disabled">
                <span class="spinner-border spinner-border-sm" wire:loading wire:target="transferProperty" role="status"
                      aria-hidden="true"></span>
                        {{ __('property.Finalize transfer') }}
                    </button>


                </div>


            </div>
        </div>
    </div>
</div>
