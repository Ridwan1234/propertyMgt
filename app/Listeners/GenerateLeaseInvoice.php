<?php

namespace App\Listeners;

use App\Models\Invoice;
use App\Models\Lease;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateLeaseInvoice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

       $lease = Lease::with(['leasable'])
            ->withSum('bills','amount')
           ->findOrFail($event->lease->id);


        Invoice::insert(
            [
                'invoicable_id' => $lease->leasable_id,
                'invoicable_type' => $lease->leasable_type,
                'rent' => $lease->leasable->rent,
                'included_bills' => $lease->bills_sum_amount ?? 0.0,
                'commission' => $lease->leasable->commission,
                'tenant_id' => $lease->tenant_id,
                'landlord_id' => $lease->leasable->landlord_id,
                'lease_id' => $lease->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
