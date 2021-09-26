<div>
    <div class="row p-3">

        <div class="col-3">
            <button type="button" data-toggle="modal" data-target="#bill-modal"
                    class="btn btn-success btn-block waves-effect waves-light ">
                <i class="mdi mdi-plus"></i>
                {{ __('lease.Add New Bill') }}
            </button>
        </div>

        <div class="col-12">
            <div class="mt-3">


                <h5 class="mb-2">{{ __('lease.Lease Bills') }}</h5>

                <div class="table-responsive">
                    <table class="table table-borderless table-centered mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('lease.Bill Name') }}</th>
                            <th>{{ __('lease.Amount') }}</th>
                            <th style="width: 50px;"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse ($bills as $item)
                            <tr>

                                <td class="font-weight-bold">{{ $loop->iteration}}</td>
                                <td class="font-weight-bold">{{  Str::upper($item->name)}}</td>
                                <td class="font-weight-bold"> @setting('currency_symbol')
                                    {{ number_format($item->amount,2)}}</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-danger"
                                            onclick="confirm('Delete this bill ?') || event.stopImmediatePropagation()"
                                            wire:click="deleteBill({{$item->id}})">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>


                            </tr>
                        @empty

                            <div class="alert alert-primary" role="alert">
                                <strong>
                                    {{ __('lease.This lease agreement has all its bills settled by tenant. If you wish to include
                                    a bill,add
                                    it via button above.') }}
                                </strong>
                            </div>

                        @endforelse


                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>
</div>
