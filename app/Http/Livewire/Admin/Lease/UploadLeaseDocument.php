<?php

namespace App\Http\Livewire\Admin\Lease;

use App\Models\LeaseDocument;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadLeaseDocument extends Component
{
    use WithFileUploads;

    public $document;
    public $leaseId;
    public $iteration = 0;

    public function render()
    {
        return view('livewire.admin.lease.upload-lease-document');
    }

    public function addDocument()
    {
        $this->validate([
            'document' => 'required|mimes:jpg,jpeg,png,pdf,doc,doc|max:4096'
        ]);

        $path = Storage::putFile('public/documents', $this->document);
        $fileUrl = Storage::url($path);
        LeaseDocument::create([
            'lease_id' => $this->leaseId,
            'document' => $fileUrl,
        ]);
        $this->emit('closeUploadModal');
        $this->emit('documentAdded');
        $this->alert(
            'success',
            'Document has been uploaded.'
        );
        $this->iteration++;
    }

    public function increment()
    {
        $this->iteration++;
    }
}
