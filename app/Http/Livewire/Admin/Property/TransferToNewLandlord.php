<?php

namespace App\Http\Livewire\Admin\Property;

use App\Models\Property;
use App\Models\User;
use Livewire\Component;

class TransferToNewLandlord extends Component
{

    public $propertyId;
    public $landlordId;

    public $landlordName;
    public $landlordAddress;
    public $landlordPhone;
    public $newLandlordId;


    protected $listeners = [
        'confirmed',
        'cancelled',

    ];

    public function mount()
    {
        $this->fetchLandlordDetails($this->landlordId);
    }

    public function render()
    {
        $landlords = User::whereRoleIs('landlord')->where('id', '!=', $this->landlordId)->pluck('id', 'fname');

        return view('livewire.admin.property.transfer-to-new-landlord',
            ['landlords' => $landlords]
        );
    }

    public function transferProperty()
    {

        $this->validate(
            ['newLandlordId' => 'required'],
            ['newLandlordId.required' => 'Select new landlord to transfer property to']
        );
        $this->confirm('Do you love want to finalize transfer ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Nope',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        $property = Property::findOrFail($this->propertyId);

        $property->update(['landlord_id' => $this->newLandlordId]);
        $this->fetchLandlordDetails($this->newLandlordId);
        $this->alert(
            'success',
            'Property has been transferred to new landlord.'
        );
    }

    public function cancelled()
    {
        // Example code inside cancelled callback

        $this->alert('info', 'Understood');
    }

    protected function fetchLandlordDetails($whichId)
    {
        $landlord = User::with('landlordProfile')->find($whichId);

        if ($landlord) {
            $this->landlordName = $landlord->fname;
            $this->landlordAddress = $landlord->landlordProfile->address;
            $this->landlordPhone = $landlord->landlordProfile->phone;
        }
    }


}
