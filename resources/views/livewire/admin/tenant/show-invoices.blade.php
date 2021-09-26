<div>
    <div class="table-responsive">
        <table class="table table-sm table-striped mb-0">
            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>{{__('tenant.Billing for')}}</th>
                <th>{{__('tenant.Amount Due')}}</th>
                <th>{{__('tenant.Due date')}}</th>
                <th>{{__('tenant.Status')}}</th>
                <th class="text-right">{{__('tenant.Action')}}</th>
            </tr>
            </thead>
            <tbody>

            @forelse ($invoices as $invoice)
                <tr>
                    <td class="font-weight-semibold"> {{ $loop->iteration + $invoices->firstItem() - 1 }}</td>
                    <td>
                        <p class="font-weight-semibold mt-0 mb-0 pt-0">{{ $invoice->type }}</p>
                        <p class="text-muted font-weight-normal mb-0 pb-0">{{ $invoice->invoicable->title ?? 'Delete property'}}</p>
                    </td>
                    <td class="font-weight-semibold"> {{setting('currency_symbol') }} {{number_format($invoice->included_bills + $invoice->rent, 2)}}
                    </td>
                    <td class="font-weight-semibold">
                        {{      \Carbon\Carbon::parse($invoice->created_at)->addDays(setting('invoice_due_in_days', 7))->format('M d, Y')}}
                    </td>
                    <td>
                        @switch($invoice->is_paid)
                            @case(1)
                            <span class="badge bg-soft-success text-success ">{{__('tenant.Paid')}}</span>
                            @break
                            @case(0)
                            <span class="badge bg-soft-danger text-danger">{{__('tenant.Pending')}}</span>
                            @break
                            @default

                        @endswitch
                    </td>
                    <td class="text-right">
                        <a href="{{ route('admin.invoice.edit',$invoice->id)}}"
                           class="btn btn-xs btn-primary waves-effect waves-light">{{__('tenant.Details')}}</a>
                    </td>
                </tr>
            @empty
                <div class="alert alert-warning" role="alert">
                    <i class="mdi mdi-alert-outline mr-2"></i>
                    {{__('tenant.No Invoices Alert')}}

                </div>
            @endforelse


            </tbody>
        </table>
    </div>

    <div class="text-center mt-2 mb-2">
        {{ $invoices->links()}}
    </div>
</div>
