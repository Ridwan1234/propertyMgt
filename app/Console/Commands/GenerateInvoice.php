<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\Lease;
use Illuminate\Console\Command;

class GenerateInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate invoices due for the current month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $timeNow = now()->toDateTimeString();
        $nextInvoiceGenerationMonth = now()->addMonthNoOverflow();
       // $leases = Lease::with(['bills', 'leasable'])->whereMonth('invoice_generated_on', now())->get();

        Lease::with(['leasable'])
            ->withSum('bills','amount')
            ->whereMonth('invoice_generated_on', now())
            ->chunkById(200, function ($leases) use ($timeNow, $nextInvoiceGenerationMonth) {
                //TODO insert data to invoices table

                foreach ($leases as $lease) {
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
                            'created_at' => $timeNow,
                            'updated_at' => $timeNow,
                        ]
                    );
                }


                //update column for next invoice generation date
                $leases->each->update(['invoice_generated_on' => $nextInvoiceGenerationMonth]);

            }, $column = 'id');


        $this->info('Invoices has been generated!');

        return 0;
    }
}
