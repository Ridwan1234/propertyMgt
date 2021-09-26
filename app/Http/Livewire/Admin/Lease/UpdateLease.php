<?php

namespace App\Http\Livewire\Admin\Lease;

use App\Models\Lease;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class UpdateLease extends Component
{

    public $leaseId;
    public $startDate;
    public $endDate;
    public $leaseTerms;
    public $deposit;

    public function mount()
    {
        $lease = Lease::findOrFail($this->leaseId);

        $this->leaseTerms = $lease->terms;
        $this->deposit = $lease->deposit;
        $this->startDate = Carbon::parse($lease->start_date)->format('d/m/Y');
        $this->endDate = Carbon::parse($lease->end_date)->format('d/m/Y');

    }


    public function render()
    {
        return view('livewire.admin.lease.update-lease');
    }

    public function updateLease()
    {
        $this->validate([
            'startDate' => 'required|date_format:d/m/Y',
            'endDate' => 'required|date_format:d/m/Y|after:startDate',
            'deposit' => 'nullable|numeric'
        ]);

        $lease = Lease::findOrFail($this->leaseId);

        try {
            $lease->update([
                'start_date' => Carbon::createFromFormat('d/m/Y', $this->startDate)->toDateTime(),
                'end_date' => Carbon::createFromFormat('d/m/Y', $this->endDate)->toDateTime(),
                'terms' => $this->leaseTerms,
                'deposit' => $this->deposit ? $this->deposit : null,
            ]);
        }
        catch (\Exception $exception){
            Log::error($exception);
            return $this->alert('error', 'Problem Creating Lease', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $exception->getMessage(),
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);
        }

        session()->flash('success','Lease details has been updated');

        return redirect()->route('admin.lease.show',$lease->id);

    }
}
