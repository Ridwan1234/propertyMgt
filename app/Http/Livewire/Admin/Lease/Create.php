<?php

namespace App\Http\Livewire\Admin\Lease;

use App\Events\LeaseCreatedEvent;
use App\Events\PropertyLeasesEvent;
use App\Models\Lease;
use App\Models\Property;
use App\Models\PropertyUnit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $isUnitLease = false;
    public $propertyId;
    public $unitId;
    public $propertyUnits = [];

    public $startDate;
    public $endDate;
    public $leaseDocuments;
    public $leaseTerms;
    public $tenantId;
    public $landlordId;
    public $tenantIdentity;
    public $rent;

    public $fallBackRent;
    public $deposit;

    //Extra Bills
    public $includeGas = false;
    public $includeInternet = false;
    public $includeTax = false;
    public $includeElectricity = false;

    public $gasAmount;
    public $internetAmount;
    public $taxAmount;
    public $electricityAmount;

    public function render()
    {
        $properties = Property::vacant()->orWhere('status', 'unavailable')->orderBy('title')->pluck('id', 'title');
        $tenants = User::whereRoleIs('tenant')->orderBy('fname')->pluck('id', 'fname');
        return view('livewire.admin.lease.create', ['properties' => $properties, 'tenants' => $tenants]);
    }

    public function updatedTenantId()
    {


        $tenant = User::with('tenantProfile')->find($this->tenantId);

        $this->tenantIdentity = $tenant->tenantProfile->identity ?? '';
    }

    public function updatedPropertyId()
    {
        $this->propertyUnits = PropertyUnit::vacant()->where('property_id', $this->propertyId)
            ->orderBy('title')
            ->pluck('id', 'title');

        $property = Property::find($this->propertyId);

        $this->rent = $property->rent ?? '';
        $this->deposit = $property->deposit ?? null;
        $this->landlordId = $property->landlord_id ?? null;
        $this->fallBackRent = $property->rent ?? '';
    }

    public function updatedUnitId()
    {
        $unit = PropertyUnit::find($this->unitId);


        //update the property unit rent,if not available,fall back to the main property which is selected.
        $this->rent = $unit->rent ?? $this->fallBackRent;
        $this->deposit = $unit->deposit ?? null;


    }

    public function updatedIsUnitLease()
    {
        if (!$this->isUnitLease) {
            $this->rent = $this->fallBackRent;
        }

    }

    public function updatedLeaseDocuments()
    {
        $this->validate([
            'leaseDocuments.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,doc,|max:4096',
        ]);
    }

    public function createLease()
    {
        $this->validate(
            [
                'gasAmount' => Rule::requiredIf($this->includeGas),
                'taxAmount' => Rule::requiredIf($this->includeTax),
                'internetAmount' => Rule::requiredIf($this->includeInternet),
                'electricityAmount' => Rule::requiredIf($this->includeElectricity),
                'startDate' => 'required|date_format:d/m/Y',
                'endDate' => 'required|date_format:d/m/Y|after_or_equal:startDate',
                'tenantId' => 'required',
                'propertyId' => 'required',
                'leaseDocuments.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,doc, |max:4096',
                'unitId' => Rule::requiredIf($this->isUnitLease),

            ], [
                'tenantId.required' => 'Select available tenant to assign property/unit',
                'propertyId.required' => 'Please select a property to lease.',
                'unitId.required' => 'Please select property unit to lease,or unmark lease units above',
            ]
        );


        //which model are we saving,property or property unit
        $propertyToLease = $this->isUnitLease ? PropertyUnit::find($this->unitId) : Property::find($this->propertyId);

        if ($propertyToLease->status == 'unavailable') {
            return $this->alert('warning', 'Property Not Available', [
                'position' => 'center',
                'timer' => 6000,
                'toast' => false,
                'text' => 'The property you have selected is not available for lease at this time.Consider leasing its available property units.Tick the lease units check box above',
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);
        }

        // collect bills to store
        $billsToStore = [];
        if ($this->includeGas) {
            array_push($billsToStore, ['name' => 'gas', 'amount' => $this->gasAmount]);
        }
        if ($this->includeElectricity) {
            array_push($billsToStore, ['name' => 'electricity', 'amount' => $this->electricityAmount]);
        }
        if ($this->includeTax) {
            array_push($billsToStore, ['name' => 'tax', 'amount' => $this->taxAmount]);
        }
        if ($this->includeInternet) {
            array_push($billsToStore, ['name' => 'internet', 'amount' => $this->internetAmount]);
        }

        DB::beginTransaction();

        try {
            $lease = $propertyToLease->leases()->create([
                'start_date' => Carbon::createFromFormat('d/m/Y', $this->startDate)->toDateTime(),
                'end_date' => Carbon::createFromFormat('d/m/Y', $this->endDate)->toDateTime(),
                'terms' => $this->leaseTerms,
                'tenant_id' => $this->tenantId,
                'landlord_id' => $this->landlordId,
                'deposit' => $this->deposit ? $this->deposit : null,
            ]);

            //Upload property documents
            if (isset($this->leaseDocuments)) {
                foreach ($this->leaseDocuments as $document) {

                    $path = Storage::putFile('public/documents', $document);
                    $fileUrl = Storage::url($path);
                    $lease->leaseDocuments()->create(
                        ['document' => $fileUrl]
                    );


                }
            }

            // Store lease extra bills,tax,electricity,internet,gas
            if (!empty($billsToStore)) {
                $lease->bills()->createMany($billsToStore);
            }

            $propertyToLease->markAsOccupied();


            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
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
        // PropertyLeasesEvent::dispatch($lease);

        LeaseCreatedEvent::dispatch($lease->id);

        session()->flash('success', 'A new lease has been created.Invoice has also been generate.Proceed to invoices section to manually pay the it.');

        return redirect()->route('admin.lease.index');

//        return $this->alert(
//            'success',
//            'Lease has been created.'
//        );


    }


}
