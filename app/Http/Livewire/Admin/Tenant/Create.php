<?php

namespace App\Http\Livewire\Admin\Tenant;

use App\Mail\RegistrationMail;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyUnit;
use App\Models\Lease;
use App\Events\LeaseCreatedEvent;
use App\Events\PropertyLeasesEvent;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
use App\Notifications\SendWelcomeEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $isUnitLease = true;
    public $propertyId;
    public $unitId;
    public $propertyUnits = [];

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

    public $fallBackRent;
    public $fallBackCaution;
    public $fallBackService;

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

    public function render()
    {
      $properties = Property::vacant()->orWhere('status', 'unavailable')->orderBy('title')->pluck('id', 'title');
      return view('livewire.admin.tenant.create', ['properties' => $properties]);
    }

    public function updatedPropertyId()
    {
        $this->propertyUnits = PropertyUnit::vacant()->where('property_id', $this->propertyId)
            ->orderBy('title')
            ->pluck('id', 'title');

        $property = Property::find($this->propertyId);

        $this->rent = $property->rent ?? '';
        $this->service = $property->service ?? '';
        $this->caution = $property->caution ?? '';
        $this->landlordId = $property->landlord_id ?? null;
        $this->fallBackRent = $property->rent ?? '';
        $this->fallBackService = $property->service ?? '';
        $this->fallBackCaution = $property->caution ?? '';
    }

    public function updatedUnitId()
    {
        $unit = PropertyUnit::find($this->unitId);

        //update the property unit rent,if not available,fall back to the main property which is selected.
        $this->rent = $unit->rent ?? $this->fallBackRent;
        $this->service = $unit->service ?? $this->fallBackService;
        $this->caution = $unit->caution ?? $this->fallBackCaution;

        $this->outstanding = $this->paid - ($this->rent + $this->service);
    }

    public function updatedIsUnitLease()
    {
        if (!$this->isUnitLease) {
            $this->rent = $this->fallBackRent;
            $this->service = $this->fallBackService;
            $this->caution = $this->fallBackCaution;
        }

    }

    public function updatedLeaseDocuments()
    {
        $this->validate([
            'leaseDocuments.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,doc,|max:4096',
        ]);
    }

    public function createTenant()
    {
        $this->validate(
          [
              'fname' => 'required',
              'lname' => 'required',
              'email' => 'email|required|unique:users,email',
              'phone' => 'required',
              'paid' => 'nullable',
              'address' => 'required',
              'identityNo' => 'required',
              'identityDocument' => 'nullable|file|max:5000',
              'startDate' => 'required|date_format:d/m/Y',
              'endDate' => 'required|date_format:d/m/Y|after_or_equal:startDate',
              'propertyId' => 'required',
              'leaseDocuments.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,doc, |max:4096',
              'unitId' => Rule::requiredIf($this->isUnitLease),
          ], [
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

        // store document if its available in file
        $identityDocumentToStore = null;
        //Generate random password

        $tenantPassword = Str::random(8);


        DB::beginTransaction();

        try {
            //create main table
            $user = User::create([
                'fname' => $this->fname,
                'lname' => $this->lname,
                'email' => $this->email,
                'password' => Hash::make($tenantPassword),

            ]);

            $user->attachRole('tenant');
            //upload identity proof
            if (!empty($this->identityDocument)) {
                $path = Storage::putFile('public/documents', $this->identityDocument);
                $identityDocumentToStore = Storage::url($path);
            }
            //create tenant profile
            $user->tenantProfile()->create([
                'identity' => $this->identityNo,
                'identity_document' => $identityDocumentToStore,
                'phone' => $this->phone,
                'address' => $this->address,
                'occupation_status' => $this->occupationStatus,
                'occupation_details' => $this->occupationDetails,
                'emergency_contact_person' => $this->emergencyContactPerson,
                'emergency_contact_number' => $this->emergencyContactPhone,
                'outstanding' => $this->outstanding,
            ]);

            $details = [
                'fname' => $user->fname,
                'lname' => $user->lname,
                'email' => $user->email,
                'password' => $tenantPassword,
               ];

               $lease = $propertyToLease->leases()->create([
                   'start_date' => Carbon::createFromFormat('d/m/Y', $this->startDate)->toDateTime(),
                   'end_date' => Carbon::createFromFormat('d/m/Y', $this->endDate)->toDateTime(),
                   'terms' => $this->leaseTerms,
                   'tenant_id' => $user->id,
                   'landlord_id' => $this->landlordId,
                   'paid' => $this->paid,
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

               $propertyToLease->markAsOccupied();

            DB::commit();

        } catch (\Exception $exception) {

            Log::error($exception);
            DB::rollBack();
            return $this->alert('error', 'Problem Registering Tenant', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => $exception->getMessage(),
                'showCancelButton' => true,
                'showConfirmButton' => false,
            ]);
        }

        if (isset($details)){
            Mail::to($user->email)->send(new RegistrationMail($details));
        }

        session()->flash('success','New tenant with name '.$user->fname .'has been created');

        return redirect()->route('admin.tenant.index');

        //TODO Send welcome email


    }
}
