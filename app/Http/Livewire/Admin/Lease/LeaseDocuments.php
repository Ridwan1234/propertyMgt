<?php

namespace App\Http\Livewire\Admin\Lease;

use App\Models\LeaseDocument;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class LeaseDocuments extends Component
{

    public $leaseId;
    public $documents;


    protected $listeners=['documentAdded'=>'refreshLeaseDocuments'];

    public function mount()
    {
        $this->documents = LeaseDocument::where('lease_id', $this->leaseId)->get();
    }

    public function render()
    {

        return view('livewire.admin.lease.lease-documents');
    }

    public function deleteDocument($id)
    {
       $doc=LeaseDocument::findOrFail($id);

        if (Storage::exists($doc->document)) {
            unlink(public_path($doc->document));
        }

        $doc->delete();

        $this->alert('success', 'Success', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  'Specified document has been removed',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->refreshLeaseDocuments();

    }

    public function refreshLeaseDocuments()
    {
        $this->documents= LeaseDocument::where('lease_id', $this->leaseId)->get();
    }
}
