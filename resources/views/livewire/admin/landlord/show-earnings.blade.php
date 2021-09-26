<div>
    <div class="table-responsive">
        <table class="table table-sm table-striped mb-0">
            <thead class="">
            <tr>

                <th>#</th>
                <th>{{ __('landlord.Month') }}</th>
                <th>{{__('tenant.Invoices')}}</th>
                <th>{{ __('landlord.Total Collected') }}</th>
                <th>{{ __('landlord.Company Commission') }}</th>
                <th>{{ __('landlord.Net Income') }}</th>
            </tr>
            </thead>
            <tbody>

            @forelse ($payments as $payment)


                <tr>
                    <td> {{ $loop->iteration + $payments->firstItem() - 1 }}</td>
                    <td class="font-weight-semibold"> {{ $payment->payment_month }} </td>

                    <td class="font-weight-semibold text-center">{{ $payment->payments_count }}</td>
                    <td class="font-weight-semibold">
                        {{ setting('currency_symbol') }} {{ number_format($payment->total_collected, 2) }}
                    </td>
                    <td class="font-weight-semibold">
                        {{ setting('currency_symbol') }} {{ number_format($payment->company_deduction, 2)}}
                    </td>
                    <td class="font-weight-semibold">
                        {{ setting('currency_symbol') }} {{number_format($payment->total_collected -
                        $payment->company_deduction, 2)}}
                    </td>

                </tr>
            @empty
                <div class="alert alert-warning" role="alert">
                    <i class="mdi mdi-alert-outline mr-2"></i>
                    {{ __('landlord.No Payment Notification') }}

                </div>
            @endforelse


            </tbody>
        </table>
    </div>

    <div class="text-center mt-2 mb-2">
        {{ $payments->links()}}
    </div>
</div>
