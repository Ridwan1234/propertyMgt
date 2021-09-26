<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex flex-row-reverse mb-2">
                        <form class="form-inline">
                            <div class="form-group mx-sm-3">
                                <label for="status-select font-weight-bold" class="mr-2">Leases Expiring Within</label>
                                <select class="custom-select" id="status-select" wire:model="days">
                                    <option value="1">Today</option>
                                    <option value="7">Next 7 Days</option>
                                    <option value="30">Next 30 Days</option>
                                    <option value="90">Next 90 Days</option>

                                </select>
                            </div>
                        </form>
                    </div>


                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-centered dt-responsive nowrap w-100"
                            id="products-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('lease.Name') }}</th>
                                    <th>{{ __('lease.Type') }}</th>
                                    <th>{{ __('lease.Tenant') }}</th>
                                    <th>{{ __('lease.Start Date') }}</th>
                                    <th>{{ __('lease.End Date') }}</th>
                                    {{-- <th>{{ __('lease.Rent') }}</th>
                                    <th>{{ __('lease.Bills') }}</th> --}}
                                    <th class="text-right" style="width: 75px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                @forelse ($leases as $lease)

                                <tr>
                                    <td class="font-weight-semibold">{{ $loop->iteration}}</td>
                                    <td class="font-weight-semibold">{{ $lease->leasable->title }}</td>
                                    <td class="font-weight-semibold">{{  $lease->type }}</td>
                                    <td class="font-weight-semibold">{{ $lease->tenant->name ?? 'No Tenant' }}</td>
                                    <td class="font-weight-semibold">
                                        {{\Carbon\Carbon::parse($lease->start_date)->format('d M Y')}}
                                    </td>
                                    <td class="font-weight-semibold">
                                        {{\Carbon\Carbon::parse($lease->end_date)->format('d M Y')}}
                                    </td>
                                    <td class="font-weight-semibold">
                                        <a href="{{ route('admin.lease.show',$lease->id)}}"
                                            class="btn btn-xs btn-primary">Details
                                            
                                        </a>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-success fade show mt-2 mb-2" role="alert">
                                            <strong>There is no current leases expiring within the next {{ $days}}
                                                days.</strong>
        
                                        </div>
                                    </td>
                                </tr>
                                
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-2 mb-2">
                        {{ $leases->links()}}
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>