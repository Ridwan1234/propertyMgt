<?php

namespace App\Http\Livewire\Admin\Tenant;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyUnit;
use App\Models\Lease;
use App\Events\LeaseCreatedEvent;
use App\Events\PropertyLeasesEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;
    public $tenantId;

    public $isUnitLease = false;
    public $propertyId;

    public $propertyName;
    public $unitName;

    public $leaseId;
    public $startDate;
    public $endDate;
    public $leaseDocuments;
    public $leaseTerms;
    public $landlordId;
    public $rent;
    public $caution;
    public $service;
    public $paid;

    public $outstanding;

    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $address;
    public $identityNo;
    public $identityDocument;
    public $occupationStatus;
    public $occupationDetails;
    public $emergencyContactPerson;
    public $emergencyContactPhone;
    public $currentIdentityDocument;

    public $tenantLeaseId;


    public function mount()
    {
        $tenant = User::with('tenantProfile')->findOrFail($this->tenantId);

        $this->fname = $tenant->fname;
        $this->lname = $tenant->lname;
        $this->email = $tenant->email;
        $this->phone = $tenant->tenantProfile->phone;
        $this->address = $tenant->tenantProfile->address;
        $this->identityNo = $tenant->tenantProfile->identity;
        $this->occupationStatus = $tenant->tenantProfile->occupation_status;
        $this->occupationDetails = $tenant->tenantProfile->occupation_details;
        $this->emergencyContactPerson = $tenant->tenantProfile->emergency_contact_person;
        $this->emergencyContactPhone = $tenant->tenantProfile->emergency_contact_number;
        $this->currentIdentityDocument = $tenant->tenantProfile->identity_document;
        // $this->tenantLeaseId = $tenant->tenantProfile->user_id;
        $this->tenantLeaseId = $tenant->tenantProfile->id;




        // $lease = Lease::findOrFail(2);

        $lease = Lease::findOrFail($this->tenantLeaseId);

        if ($lease->type='UNIT') {
          $this->isUnitLease = true;

          $this->unitName = $lease->leasable->title;

          $unit = $lease->leasable;

          $this->propertyId = $lease->leasable->property_id;

          $prop = Property::findOrFail($this->propertyId);

          $this->propertyName = $prop->title;

          $this->rent = $unit->rent ?? '';
          $this->service = $unit->service ?? '';
          $this->caution = $unit->caution ?? '';

        }else{
          $this->propertyName = $lease->leasable->title;

          $props = $lease->leasable;

          $this->rent = $props->rent ?? '';
          $this->service = $props->service ?? '';
          $this->caution = $props->caution ?? '';
        }


        $this->leaseTerms = $lease->terms;
        $this->paid = $lease->paid;
        $this->startDate = Carbon::parse($lease->start_date)->format('d/m/Y');
        $this->endDate = Carbon::parse($lease->end_date)->format('d/m/Y');

        $this->outstanding = $this->paid - ($this->rent + $this->service);

    }

    public function render()
    {
      return view('livewire.admin.tenant.edit');
    }

    public function updateTenant()
    {
        $this->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'email|required|unique:users,email,'.$this->tenantId,
            'paid' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'identityNo' => 'required',
            'identityDocument' => 'nullable|file|max:5000',
        ]);

        $tenant=User::with('tenantProfile')->findOrFail($this->tenantId);
        $lease = Lease::findOrFail($this->tenantLeaseId);

        try {

            $tenant->update([
                'fname'=>$this->fname,
                'lname'=>$this->lname,
                'email'=>$this->email,
            ]);

            $tenant->tenantProfile()->update([
                'identity' => $this->identityNo,
                //'identity_document' => $identityDocumentToStore,
                'phone' => $this->phone,
                'address' => $this->address,
                'occupation_status' => $this->occupationStatus,
                'occupation_details' => $this->occupationDetails,
                'emergency_contact_person' => $this->emergencyContactPerson,
                'emergency_contact_number' => $this->emergencyContactPhone,
                'outstanding' => $this->outstanding,
            ]);

            $lease->update([
                'start_date' => Carbon::createFromFormat('d/m/Y', $this->startDate)->toDateTime(),
                'end_date' => Carbon::createFromFormat('d/m/Y', $this->endDate)->toDateTime(),
                'terms' => $this->leaseTerms,
                'paid' => $this->paid ? $this->paid : null,
            ]);

            //update identity document
            if (!empty($this->identityDocument)) {
                $path = Storage::putFile('public/documents', $this->identityDocument);
                $filenameToStore = Storage::url($path);

                //get value of existing proof
                $fileNameToDelete = $this->currentIdentityDocument;
                //update current one
                $tenant->tenantProfile()->update(['identity_document' => $filenameToStore]);
                //Delete if previous file exists
                if (!empty($fileNameToDelete) and Storage::exists($fileNameToDelete)) {

                    unlink(public_path($fileNameToDelete));
                }
            }
            DB::commit();

        }
        catch (\Exception $ex){
            Log::error($ex);
            DB::rollBack();
            return $this->alert('error', 'Problem updating Tenant', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $ex->getMessage(),
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);

        }

        session()->flash('success','Tenant details have been updated');
        return redirect()->route('admin.tenant.show',$tenant->id);

    }
}
